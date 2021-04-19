<?php

namespace App\Controller;

use App\Repository\EquipementsRepository;
use App\Repository\FooterDescriptionRepository;
use App\Service\ResponseService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipementsController extends AbstractController
{
    private $responseService;
    private $paginator;
    private $footerDescriptionRepository;
    private $equipementsRepository;


    public function __construct(ResponseService $responseService, PaginatorInterface $paginator, FooterDescriptionRepository $footerDescriptionRepository, EquipementsRepository $equipementsRepository){
        $this->responseService = $responseService;
        $this->paginator = $paginator;
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->equipementsRepository = $equipementsRepository;
    }


    /**
     * @Route("/equipements/{categorie}", name="equipementsCategorie",  methods={"GET", "POST"})
     * ▬▬▬▬ Equipement / {categorie} ▬▬▬▬ Affichage Equipements {Categorie / Nom Recherché} + Pagination + Recherche Ajax
     * @param Request $request
     * @return Response
     */
    public function equipementsCategorie(Request $request): Response
    {
        //AVEC AJAX
        if ($request->isXmlHttpRequest()){
            $request->get('categorie') === 'all' ? $categorie = "" : $categorie = $request->get('categorie');
            $equipements = $this->paginator->paginate($this->equipementsRepository->affichage($categorie, $request->get('parametres')), $request->query->getInt('page', 1), 20);

            return $this->responseService->responseJson([
                    'status' => 'Done',
                    'affichage' => $this->renderView('Equipements/rechercheAjax.html.twig', [
                        'equipements' => $equipements,
                        'recherche' => $request->get('parametres'),
                        'nbrResultats' => $equipements->getTotalItemCount(),
                        'categorie' => $categorie == "" ? $categorie = "all" : '',
                    ])
                ]);
        }

        //SANS AJAX
        $request->get('categorie') === 'équipements' ? $categorie = '' : $categorie = $request->get('categorie');
        $request->get('recherche') === null ?  $equipement_recherche= '' : $equipement_recherche = $request->get('recherche');
        $request->get('categorieEquipement') ? $categorie= $request->get('categorieEquipement') : '';
        $categorie === 'all' ? $categorie = '' : '';
        $equipements = $this->paginator->paginate($this->equipementsRepository->affichage($categorie, $equipement_recherche), $request->query->getInt('page', 1), 20);

        return $this->render('Equipements/LayoutEquipement.html.twig', [
            'title' => 'Les '.($categorie === '' ? 'équipements' : $categorie),
            'categorie' => $categorie === '' ? $categorie = "all" : $categorie,
            'equipements' => $equipements,
            'descriptions' => $this->footerDescriptionRepository->affichage('Equipements'),
            'recherche' => $equipement_recherche,
            'nbrResultats' => $equipements->getTotalItemCount(),
        ]);

    }


    /**
     * @Route("/equipementscaracteristiques/{id}{categorie}", name="equipementsCaracteristiques", methods={"GET", "POST"})
     * ▬▬▬▬ Equipement Détail ▬▬▬▬
     * @param Request $request
     * @return Response
     */
    public function equipementsCaracteristiques(Request $request): Response
    {
        return $this->render('Equipements/equipementsCaracteristiques.html.twig', [
            'title' => 'Les Equipements',
            'route' => 'equipements',
            'equipements' => $this->equipementsRepository->affichageById($request->get('id')),
            'descriptions' => $this->footerDescriptionRepository->affichage('Equipements'),
            'categorie' => $request->get('categorie'),
        ]);
    }
}
