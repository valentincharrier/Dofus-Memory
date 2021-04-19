<?php


namespace App\Service;


use App\Repository\ArchimonstresRepository;
use App\Repository\FooterDescriptionRepository;
use App\Repository\UserMonsterRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OcreService extends AbstractController
{
    private $entityManager;
    private $userRepository;
    private $paginator;
    private $footerDescriptionRepository;
    private $archimonstresRepository;
    private $userMonsterRepository;
    private $responseService;


    public function __construct(EntityManagerInterface $entityManager, ResponseService $responseService, UserRepository $userRepository, PaginatorInterface $paginator, FooterDescriptionRepository $footerDescriptionRepository, ArchimonstresRepository $archimonstresRepository, UserMonsterRepository $userMonsterRepository){

        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->paginator = $paginator;
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->archimonstresRepository = $archimonstresRepository;
        $this->userMonsterRepository = $userMonsterRepository;
        $this->responseService = $responseService;
    }


    /**
     * ▬▬▬▬ Get Result Capture Ocre ▬▬▬▬ Initialise @Var + Get archimonstres + Get archimonstres captures by user
     * @param $request
     * @param $user
     * @return array
     */
    public function getResult($request, $user){

        if(isset($_POST['rechercher']) | isset($_GET['nomMonstre'])) {
            $idUser = $user->getId();
            $nomMonstre = $request->get('nomMonstre');
            $etape = $request->get('etape');
            $type = $request->get('type');
            $zone = $request->get('zone');
            $captures = $request->get('captures');
        }else{
            $idUser = $user->getId();
            $nomMonstre = '';
            $etape = 0;
            $type = '';
            $zone = '';
            $captures = '';
        }


        switch ($captures) {
            case "":
                $Filtrage = $this->paginator->paginate($this->archimonstresRepository->affichageDesArchimonstres($nomMonstre, $etape, $type, $zone, $captures), $request->query->getInt('page', 1), 20);
                $nbrResultats = $Filtrage->getTotalItemCount();
                break;
            case 0:
                $monstresCapturer = $this->paginator->paginate($this->archimonstresRepository->affichageDesArchimonstresCaptures($idUser, $nomMonstre, $etape, $type, $zone, $captures), $request->query->getInt('page', 1), 20);
                $Filtrage = $this->paginator->paginate($this->archimonstresRepository->affichageDesArchimonstres($nomMonstre, $etape, $type, $zone, $captures), $request->query->getInt('page', 1), 20);
                $nbrResultats = $Filtrage->getTotalItemCount();
                $nbrResultats -= count($monstresCapturer);
                break;
            case 1:
//                CAPTURER !!
                $Filtrage = $this->paginator->paginate($this->archimonstresRepository->affichageDesArchimonstresCaptures($idUser, $nomMonstre, $etape, $type, $zone, $captures), $request->query->getInt('page', 1), 20);
                $nbrResultats = $Filtrage->getTotalItemCount();
                break;
            default:
                $Filtrage = $this->paginator->paginate($this->archimonstresRepository->affichageDesArchimonstres($nomMonstre, $etape, $type, $zone, $captures), $request->query->getInt('page', 1), 20);
                $nbrResultats = $Filtrage->getTotalItemCount();
                break;
        }

        //Monstres connu de l'user
        $monstresUserConnu = $this->archimonstresRepository->monstreUserConnu($idUser, $nomMonstre);
        $monstresConus = array();

        foreach ($monstresUserConnu as $monstreUserConnu ){
            $userMonsters = $monstreUserConnu->getUserMonsters()->unwrap()->toArray();
            foreach ($userMonsters as $userMonster) {
                $userMonster->getIdUser()->getId() == $idUser ? $nbrCaptures = $userMonster->getNbrCaptures() : '';
            }
            //On rajoute en fin de tableau la cle et la valeur [id => nbrCapture]
            $monstresConus[$monstreUserConnu->getId()] = $nbrCaptures;
        }
        if($request->get('reset') != null){ $nbrResultats = 632; }

        return $data= [
                'idUser' => $idUser,
                'Filtrage' => $Filtrage,
                'monstresConus' => $monstresConus,
                'nomMonstre' => $nomMonstre,
                'etape' => $etape,
                'type' => $type,
                'zone' => $zone,
                'captures' => $captures,
                'nbrResultats' => $nbrResultats
            ];


    }


    /**
     * ▬▬▬▬ Update Capture Monster ▬▬▬▬ Add Monster OR Remove/Delete Monster
     * @param $request
     * @param $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateCapture($request, $user){
        $idUser = $user->getId();
        $idMonster = $request->get('id');
        $signeAddRemove =  $request->get('signe');
        $dejaCapture = false;
        $nbrCaptureOk = 0;

        foreach ($this->userMonsterRepository->getMonsterCapturer($idUser) as $monstreCapturer){
            if($monstreCapturer->getIdMonster()->getId() === intval($idMonster)){
                switch ($signeAddRemove){
                    case '+':
                        $nbrCaptureOk = $monstreCapturer->getNbrCaptures() + 1;
                        break;

                    case '-':
                        if( $monstreCapturer->getNbrCaptures() > 1){
                            $nbrCaptureOk = $monstreCapturer->getNbrCaptures() - 1;
                        }else{
                            $this->userMonsterRepository->deleteCapture($idUser, $idMonster);
                        }
                        break;
                }
                $this->userMonsterRepository->updateCapture($idUser, $idMonster, $nbrCaptureOk);
                $dejaCapture = true;
            }
        }

        if($dejaCapture === false && $signeAddRemove != '-'){
            $this->userMonsterRepository->addCapture($idUser, $idMonster, 1);
            $this->entityManager->persist($this->userRepository->find($idUser)->setMonstresDejaCapture($this->userRepository->find($idUser)->getMonstresDejaCapture() + 1));
            $this->entityManager->flush();
            $nbrCaptureOk = 1;
        }

        $monstresDejaCapture = $this->userRepository->find($idUser)->getMonstresDejaCapture();

        //        Mise au format % pour affichage dans la banière principal du site des monstres déja capturés
        $monstresDejaCapturePourcentage = number_format(($monstresDejaCapture/632*100), 2, ',', ' ');


        return $this->responseService->responseJson([
            'status' => 'Done',
            'card' => $this->renderView('Quetes/EternelleMoisson/affichageNbrCaptures.html.twig', [
                'id' => $idMonster,
                'nbrCaptures' => $nbrCaptureOk,
            ]),
            'nbrCaptures' => $nbrCaptureOk,
            'monstresDejaCapture' => $monstresDejaCapture,
            'monstresDejaCapturePourcentage' => $monstresDejaCapturePourcentage
        ]);
    }
}


