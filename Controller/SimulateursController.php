<?php

namespace App\Controller;

use App\Repository\ExperiencesRepository;
use App\Repository\FooterDescriptionRepository;
use App\Repository\ParcheminRessourcesRepository;
use App\Service\ResponseService;
use App\Service\SimulateurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SimulateursController extends AbstractController
{
    private $experiencesRepository;
    private $footerDescriptionRepository;
    private $responseService;
    private $parcheminRessourcesRepository;
    private $simulateurService;

    public function __construct(ResponseService $responseService, FooterDescriptionRepository $footerDescriptionRepository,  ExperiencesRepository $experiencesRepository, ParcheminRessourcesRepository $parcheminRessourcesRepository, SimulateurService $simulateurService){
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->experiencesRepository = $experiencesRepository;
        $this->responseService = $responseService;
        $this->parcheminRessourcesRepository = $parcheminRessourcesRepository;
        $this->simulateurService = $simulateurService;

    }

    /**
     * @Route("/simulateurs", name="simulateurs")
     * ▬▬▬▬ Simulateurs Acceuil ▬▬▬▬
     * @return Response
     */
    public function simulateurs(): Response
    {
        return $this->render('Simulateurs/index.html.twig', [
            'title' => 'Les Simulateurs Dofus',
            'descriptions' => $this->footerDescriptionRepository->affichage('Les Simulateurs'),
        ]);
    }


    /**
     * @Route("/simulateurs/coupscritique", name="simulateursCoupsCritique", methods={"GET", "POST"})
     * ▬▬▬▬ Simulateur Coups Critiques ▬▬▬▬ Calcul CC Ajax
     * @return Response
     */
    public function simulateursCoupsCritique(Request $request): Response
    {

        if ($request->isXmlHttpRequest()){

            $Result = 0;
            $request->get('sort') === '' ? $CCsort = 0 : $CCsort = $request->get('sort');
            $request->get('pano') === '' ? $CCpanoplie = 0 : $CCpanoplie = $request->get('pano');
            $request->get('boost') === '' ? $CCboost = 0 : $CCboost = $request->get('boost');
            $request->get('agi') === '' ? $Agilite = 0 : $Agilite = $request->get('agi');

            $Result = floor(min(($CCsort - $CCpanoplie - $CCboost), ($CCsort - $CCpanoplie - $CCboost) * ((exp(1) * 1.10000000) / log($Agilite + 12))));
            $Result <= 2 ? $Result = 2 : $Result = $Result;
            $CCsort ==  0 && $CCboost == 0 && $CCpanoplie == 0 && $Agilite == 0 ? $Result = 0 : $Result = $Result;

            return $this->responseService->responseJson([
                    'status' => 'Done',
                    'sort' => $CCsort,
                    'pano' => $CCpanoplie,
                    'boost' => $CCboost,
                    'agi' => $Agilite,
                    'resultat' => $Result
                ]);
        }

        return $this->render('Simulateurs/CoupsCritiques/coupscritiques.html.twig', [
            'title' => 'Les Coups Critiques',
            'descriptions' => $this->footerDescriptionRepository->affichage('Les Coups Critiques'),
            'CCsort' => '',
            'CCpanoplie' => '',
            'CCboost' => '',
            'Agilite' => '',
            'result' => '',
        ]);
    }


    /**
     * @Route("/simulateurs/experiences", name="simulateursExperiences")
     * ▬▬▬▬ Simulateur Expériences ▬▬▬▬ Calcul expérience Métier et Personnage Ajax
     * @param Request $request
     * @return Response
     */
    public function simulateursExperiences(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $experiencesRestante = $this->experiencesRepository->recupXP(intval($request->get('lvlVise')), $request->get('choix'));
            $experiencesRestante = number_format($experiencesRestante[0]->getExperience() - intval($request->get('xpAquise')), 0,"."," ") ;
            $experiencesRestante < 0 ? $experiencesRestante = 0 : '';

            return $this->responseService->responseJson([
                'status' => 'Done',
                'experience' => '<input disabled value="'.$experiencesRestante.'"/>'
            ]);
        }

        return $this->render('Simulateurs/Experiences/experiences.html.twig', [
            'title' => 'Simulateur Expériences',
            'descriptions' => $this->footerDescriptionRepository->affichage('Simulateurs Experiences'),
        ]);
    }


    /**
     * @Route("/simulateurs/parchemins", name="simulateursParchemins")
     * ▬▬▬▬ Simulateur de ressources pour parchemin ▬▬▬▬ Renvoie ressources utiles pour crafter
     * @param Request $request
     * @return false|Response
     */
    public function simulateursParchemins(Request $request)
    {

        if($request->isXmlHttpRequest()){
            $choix = $request->get('choix');
            is_numeric($request->get('de_minimum')) ? $de_minimum = $request->get('de_minimum') : $de_minimum = 0;
            is_numeric($request->get('a_maximum')) ? $a_maximum = $request->get('a_maximum') : $a_maximum = 0 ;
            if($a_maximum - $de_minimum <= 0){return false;}else{$ratio = $a_maximum - $de_minimum;}
            $de_minimum >= 80 && $a_maximum >= 80 && $ratio % 2 !== 0 ?  $de_minimum -= 1 : false;

            $petit = 0;
            $moyen = 0;
            $grand = 0;
            $puissant = 0;

            for($de_minimum; $de_minimum < $a_maximum; $de_minimum++){
                $de_minimum < 25 ? $petit++ : false;
                $de_minimum < 50 && $de_minimum >= 25 ? $moyen++ : false;
                $de_minimum < 79 && $de_minimum >= 50 ? $grand++ : false;
                if($de_minimum < 100 && $de_minimum >= 79){ $puissant++; $de_minimum++; }
            }

            $ressources = $this->parcheminRessourcesRepository->getParcheminRessources($choix);
            $ressourcesADropper = [];

            foreach ( $ressources  as $ressource){
                $ressource->getTaille()->getTaille() === 25 && $petit > 0 ? $ressourcesADropper = $this->simulateurService->addRessourcesADropper($ressource, $petit, $ressourcesADropper) : false;
                $ressource->getTaille()->getTaille() === 50 && $moyen > 0 ?  $ressourcesADropper = $this->simulateurService->addRessourcesADropper($ressource, $moyen, $ressourcesADropper) : false;
                $ressource->getTaille()->getTaille() === 80 && $grand > 0 ?  $ressourcesADropper = $this->simulateurService->addRessourcesADropper($ressource, $grand, $ressourcesADropper) : false;
                $ressource->getTaille()->getTaille() === 100 && $puissant > 0 ?  $ressourcesADropper = $this->simulateurService->addRessourcesADropper($ressource, $puissant, $ressourcesADropper) : false;
                $ressource->getTaille()->getTaille() === 1000000  ? $ressourcesADropper = $this->simulateurService->addRessourcesADropper($ressource, $ratio, $ressourcesADropper) : false;
            }


            return $this->responseService->responseJson([
                'status' => 'Done',
                'affichage' => $this->renderView('Simulateurs/Parchemins/ajaxSearchRessources.html.twig', [
                    'ressources' => $ressourcesADropper,
                    'petit' => $petit,
                    'moyen' => $moyen,
                    'grand' => $grand,
                    'puissant' => $puissant,
                    'element' => $choix,
                ])
            ]);
        }


        return $this->render('Simulateurs/Parchemins/parchemins.html.twig', [
            'title' => 'Ressources Parchemins',
            'descriptions' => $this->footerDescriptionRepository->affichage('Ressources Parchemins'),
            'de_minimum' => isset($de_minimum) ? $de_minimum : '',
            'a_maximum' => isset($a_maximum) ? $a_maximum : '',
        ]);
    }



}
