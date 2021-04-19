<?php

namespace App\Controller;

use App\Repository\ArchimonstresRepository;
use App\Repository\FooterDescriptionRepository;
use App\Repository\UserMonsterRepository;
use App\Repository\UserRepository;
use App\Service\OcreService;
use App\Service\ResponseService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class EternelleMoissonController extends AbstractController
{
    private $userRepository;
    private $paginator;
    private $footerDescriptionRepository;
    private $archimonstresRepository;
    private $userMonsterRepository;
    private $ocreService;
    private $responseService;


    public function __construct(ResponseService $responseService, OcreService $ocreService, UserRepository $userRepository, PaginatorInterface $paginator, FooterDescriptionRepository $footerDescriptionRepository, ArchimonstresRepository $archimonstresRepository, UserMonsterRepository $userMonsterRepository){

        $this->userRepository = $userRepository;
        $this->paginator = $paginator;
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->archimonstresRepository = $archimonstresRepository;
        $this->userMonsterRepository = $userMonsterRepository;
        $this->ocreService = $ocreService;
        $this->responseService = $responseService;
    }


    /**
     *  @Route("/eternellemoisson", name="eternelleMoisson")
     * ▬▬▬▬ Quête Ocre ▬▬▬▬
     * @param Request $request
     * @param UserInterface $user
     * @return Response
     */
    public function eternelleMoisson(Request $request, UserInterface $user): Response
    {
        $data = $this->ocreService->getResult($request, $user);

        return $this->render('Quetes/EternelleMoisson/eternelleMoisson.html.twig', [
            'title' => 'Eternelle Moisson',
            'descriptions' => $this->footerDescriptionRepository->affichage('Quête Eternelle Moisson'),
            'informationsUser' => $this->userRepository->find($user->getId()),
            'idUser' => $data['idUser'],
            'archimonstres' => $data['Filtrage'],
            'monstresUserConnu' => $data['monstresConus'],
            'nomMonstre' =>$data['nomMonstre'],
            'etape' => $data['etape'],
            'type' => $data['type'],
            'zone' => $data['zone'],
            'captures' => $data['captures'],
            'nbrResultats' => $data['nbrResultats'],
        ]);
    }


    /**
     * @Route("/eternellemoissonajax", name="eternelleMoissonAjax")
     * ▬▬▬▬ Update Capture Ajax ▬▬▬▬
     * @param Request $request
     * @param UserInterface $user
     * @return Response
     */
        public function eternelleMoissonAjax(Request $request, UserInterface $user): Response
        {
            return $this->ocreService->updateCapture($request, $user);
        }
}
