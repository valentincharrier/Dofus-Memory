<?php

namespace App\Controller;

use App\Repository\FooterDescriptionRepository;
use App\Repository\DonjonsRepository;
use App\Service\ResponseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ListeDesDonjonsPhpController extends AbstractController
{
    private $donjonsRepository;
    private $footerDescriptionRepository;
    private $responseService;


    public function __construct(ResponseService $responseService, DonjonsRepository $donjonsRepository, FooterDescriptionRepository $footerDescriptionRepository){
        $this->donjonsRepository = $donjonsRepository;
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->responseService = $responseService;
    }

    /**
     * @Route("/liste_donjons", name="liste_donjons", methods={"GET", "POST"})
     * ▬▬▬▬ Liste des Donjons ▬▬▬▬ Get Donjons + SearchDonjons Ajax
     * @param Request $request
     * @return Response
     */
    public function listeDesDonjons(Request $request): Response
    {
        if($request->isXmlHttpRequest()) {
            $donjonsTrouve = $this->donjonsRepository->rechercheDonjon($request->get('mot'));
            return $this->responseService->responseJson([
                'status' => 'Done',
                'donjonsTrouve' => $donjonsTrouve,
                'donjons' => $this->renderView('Donjons/ListeDesDonjons/dj-search.html.twig', [
                    'controller_name' => 'ListeDesDonjonsPhpController',
                    'donjons' => $donjonsTrouve,
                    'nbrResultats' => count($donjonsTrouve),
                ])
            ]);

        }

        isset($_POST['nomdonjon']) ? $donjons = $this->donjonsRepository->rechercheDonjon($request->get('nomdonjon')) : $donjons = $this->donjonsRepository->rechercheDonjon('');

        return $this->render('Donjons/ListeDesDonjons/liste_des_donjons.html.twig', [
            'controller_name' => 'ListeDesDonjonsPhpController',
            'title' => 'Liste des Donjons',
            'descriptions' => $this->footerDescriptionRepository-> affichage('Liste des Donjons'),
            'donjons' => $donjons,
            'nbrResultats' => count($donjons),
        ]);
    }


}
