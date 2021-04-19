<?php

namespace App\Controller;

use App\Repository\AmuletteRepository;
use App\Repository\DescriptionFooterRepository;
use App\Repository\FooterDescriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * ▬▬▬▬ Page Acceuil ▬▬▬▬
     * @param FooterDescriptionRepository $footerDescriptionRepository
     * @return Response
     */
    public function home(FooterDescriptionRepository $footerDescriptionRepository): Response
    {
        return $this->render('Home/index.html.twig', [
            'title' => 'Dofus Memory',
            'descriptions'=> $footerDescriptionRepository->affichage('Home')
        ]);
    }
}
