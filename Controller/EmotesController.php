<?php

namespace App\Controller;

use App\Repository\EmotesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DonjonsCardsDoubleRepository;
use App\Repository\FooterDescriptionRepository;


class EmotesController extends AbstractController
{

    private $footerDescriptionRepository;
    private $emotesRepository;
    private $donjonsCardsDoubleRepository;



    public function __construct(FooterDescriptionRepository $footerDescriptionRepository, EmotesRepository $emotesRepository, DonjonsCardsDoubleRepository $donjonsCardsDoubleRepository){
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->emotesRepository = $emotesRepository;
        $this->donjonsCardsDoubleRepository = $donjonsCardsDoubleRepository;

    }


    /**
     * @Route("/emotes", name="emotes")
     * ▬▬▬▬ Emotes Acceuil ▬▬▬▬
     * @return Response
     */
    public function emotes(): Response
    {
        return $this->render('Emotes/index.html.twig', [
            'title' => 'Les Emotes',
            'descriptions' => $this->footerDescriptionRepository->affichage('Emotes'),
        ]);
    }


    /**
     * @Route("/emotes/montrer-son-arme", name="montrerSonArme")
     * ▬▬▬▬ Montrer Son Arme ▬▬▬▬
     * @return Response
     */
    public function montrerSonArme(): Response
    {
        return $this->render('Emotes/MontrerSonArme/montrerSonArme.html.twig', [
            'title' => 'Montrer son Arme',
            'emotes' => $this->emotesRepository->recherche('Montrer Son Arme'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Montrer Son Arme'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Montrer Son Arme'),
        ]);
    }


    /**
     * @Route("/emotes/pierre-feuille-ciseaux", name="pierreFeuilleCiseaux")
     * ▬▬▬▬ Pierre Feuille Ciseaux ▬▬▬▬
     * @return Response
     */
    public function pierreFeuilleCiseaux(): Response
    {
        return $this->render('Emotes/PierreFeuilleCiseaux/pierreFeuilleCiseaux.html.twig', [
            'title' => 'Pierre Feuille Ciseaux',
            'emotes' => $this->emotesRepository->recherche('Pierre Feuille Ciseaux'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Pierre Feuille Ciseaux'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Pierre Feuille Ciseaux'),
        ]);
    }


    /**
     * @Route("/emotes/pointer-du-doigt", name="pointerDuDoigt")
     * ▬▬▬▬ Pointer du Doigt ▬▬▬▬
     * @return Response
     */
    public function pointerDuDoigt(): Response
    {
        return $this->render('Emotes/PoiterDuDoigt/pointerDuDoigt.html.twig', [
            'title' => 'Pointer Du Doigt',
            'emotes' => $this->emotesRepository->recherche('Pointer Du Doigt'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Pointer Du Doigt'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Pointer Du Doigt'),
        ]);
    }


    /**
     * @Route("/emotes/sallonger", name="sallonger")
     * ▬▬▬▬ S'allonger ▬▬▬▬
     * @return Response
     */
    public function sallonger(): Response
    {
        return $this->render('Emotes/Sallonger/sallonger.html.twig', [
            'title' => 'Sallonger',
            'emotes' => $this->emotesRepository->recherche('Sallonger'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Sallonger'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Sallonger'),
        ]);
    }


    /**
     * @Route("/emotes/saluer", name="saluer")
     * ▬▬▬▬ Saluer ▬▬▬▬
     * @return Response
     */
    public function saluer(): Response
    {
        return $this->render('Emotes/Saluer/saluer.html.twig', [
            'title' => 'Saluer',
            'emotes' => $this->emotesRepository->recherche('Saluer'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Saluer'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Saluer'),
        ]);
    }


    /**
     * @Route("/emotes/sasseoir", name="sasseoir")
     * ▬▬▬▬ S'asseoir ▬▬▬▬
     * @return Response
     */
    public function sasseoir(): Response
    {
        return $this->render('Emotes/Sasseoir/sasseoir.html.twig', [
            'title' => 'Sasseoir',
            'emotes' => $this->emotesRepository->recherche('Sasseoir'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Sasseoir'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Sasseoir'),
        ]);
    }


    /**
     * @Route("/emotes/vent-de-panique", name="ventDePanique")
     * ▬▬▬▬ Vent de Panique ▬▬▬▬
     * @return Response
     */
    public function ventDePanique(): Response
    {
        return $this->render('Emotes/Sasseoir/sasseoir.html.twig', [
            'title' => 'Vent De Panique',
            'emotes' => $this->emotesRepository->recherche('Vent De Panique'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Vent De Panique'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Vent De Panique'),
        ]);
    }


}
