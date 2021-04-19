<?php

namespace App\Controller;

use App\Repository\FamilierRepository;
use App\Repository\FooterDescriptionRepository;
use App\Service\ResponseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FamiliersController extends AbstractController
{
    private $familierRepository;
    private $footerDescriptionRepository;
    private $responseService;


    public function __construct(ResponseService $responseService, FamilierRepository $familierRepository, FooterDescriptionRepository $footerDescriptionRepository){
        $this->familierRepository = $familierRepository;
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->responseService = $responseService;
    }

    /**
     * @Route("/familiers", name="familiers")
     * ▬▬▬▬ Familiers Dofus ▬▬▬▬
     * @param Request $request
     * @return Response
     */
    public function familiers(Request $request): Response
    {
        return $this->render('Familiers/familiers.html.twig', [
            'title' => 'Familiers',
            'descriptions' => $this->footerDescriptionRepository->affichage('Les Familiers'),
            'equipements' => $request->get('recherche') != '' ? $this->familierRepository->affichage($request->get('recherche')) : $this->familierRepository->affichage('')
        ]);
    }


    /**
     * @Route("/ajax-familiers", name="ajaxFamiliers")
     * ▬▬▬▬ Familiers Dofus Ajax ▬▬▬▬
     * @param Request $request
     * @return Response
     */
    public function ajaxFamiliers(Request $request): Response
    {
        $data = $this->familierRepository->filtrageFamilier($request->get('parametres'));

        return $this->responseService->responseJson([
                'status' => 'Done',
                'affichage' => $this->renderView('Familiers/searchFamiliers.html.twig', [
                    'equipements' => $data,
                    'nbrResult' => count($data)
                ])
            ]);
    }

}
