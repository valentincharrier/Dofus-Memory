<?php

namespace App\Controller;

use App\Repository\FooterDescriptionRepository;
use App\Repository\RunesRepository;
use App\Service\ResponseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForgemagieController extends AbstractController
{
    private $footerDescriptionRepository;
    private $runesRepository;
    private $responseService;


    public function __construct(ResponseService $responseService, FooterDescriptionRepository $footerDescriptionRepository, RunesRepository $runesRepository){
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->runesRepository = $runesRepository;
        $this->responseService = $responseService;
    }


    /**
     * @Route("/forgemagie", name="forgemagie")
     * ▬▬▬▬ Forgemagie Acceuil ▬▬▬▬
     * @return Response
     */
    public function forgemagie(): Response
    {
        return $this->render('Forgemagie/index.html.twig', [
            'title' => 'Forgemagie',
            'descriptions' => $this->footerDescriptionRepository->affichage('Forgemagie'),
        ]);
    }


    /**
     * @Route("/forgemagie/poidsdesrunes", name="forgemagiePoidsDesRunes", methods={"GET", "POST"})
     * ▬▬▬▬ Poids des Runes  ▬▬▬▬ GetRunes + SearchRunes Ajax
     * @param Request $request
     * @return Response
     */
    public function forgemagiePoidsDesRunes(Request $request): Response
    {
        if ($request->isXmlHttpRequest()){
            $runeChercher = $this->runesRepository->rechercher($request->get('parametres'));

            return $this->responseService->responseJson([
                    'status' => 'Done',
                    'affichage' => $this->renderView('Forgemagie/PoidsDesRunes/runes-search.html.twig', [

                        'runes' => $runeChercher,
                        'nbrResultats' => count($runeChercher),
                    ])
            ]);
        }

        $runes = $this->runesRepository->findAll();
        return $this->render('Forgemagie/PoidsDesRunes/poidsDesRunes.html.twig', [
            
            'title' => 'Poids des Runes',
            'runes' => $runes,
            'descriptions' => $this->footerDescriptionRepository->affichage('Poids des Runes'),
            'nbrResultats' => count($runes),
        ]);
    }
}
