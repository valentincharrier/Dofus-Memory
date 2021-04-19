<?php

namespace App\Controller;

use App\Entity\TutosDonjons;
use App\Repository\DescriptionFooterRepository;
use App\Repository\DonjonsCardsDoubleRepository;
use App\Repository\DonjonsRepository;
use App\Repository\FooterDescriptionRepository;
use App\Repository\TutosDonjonsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DonjonsController extends AbstractController
{
    private $footerDescriptionRepository;
    private $donjonsCardsDoubleRepository;
    private $donjonsRepository;

    public function __construct(FooterDescriptionRepository $footerDescriptionRepository, DonjonsCardsDoubleRepository $donjonsCardsDoubleRepository, DonjonsRepository $donjonsRepository){
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->donjonsCardsDoubleRepository = $donjonsCardsDoubleRepository;
        $this->donjonsRepository = $donjonsRepository;
    }


    /**
     * @Route("/donjons/fantome-chacha", name="fantome-chacha")
     * ▬▬▬▬ Donjon des Familiers ▬▬▬▬
     * @return Response
     */
    public function familiers(): Response
    {
        $slides = [
            'photos/donjons/familier/Chemin-1.jpg',
            'photos/donjons/familier/Chemin-3.jpg',
            'photos/donjons/familier/Chemin-2.jpg',
            'photos/donjons/familier/Chemin-4.jpg',
            'photos/donjons/familier/Chemin-5.jpg',
            'photos/donjons/familier/Chemin-6.jpg',
            'photos/donjons/familier/Chemin-7.jpg',
            'photos/donjons/familier/Chemin-8.jpg',
            'photos/donjons/familier/Chemin-9.jpg',
            'photos/donjons/familier/Chemin-10.jpg',
            'photos/donjons/familier/Chemin-11.jpg',
            'photos/donjons/familier/Chemin-12.jpg',
            'photos/donjons/familier/Chemin-13.jpg',
            'photos/donjons/familier/Chemin-14.jpg',
            'photos/donjons/familier/Chemin-15.jpg',
            'photos/donjons/familier/Chemin-16.jpg',
            'photos/donjons/familier/Chemin-17.jpg',
            'photos/donjons/familier/Chemin-18.jpg',
            'photos/donjons/familier/Chemin-19.jpg',
            'photos/donjons/familier/Chemin-20.jpg',
            'photos/donjons/familier/Chemin-21.jpg',
            'photos/donjons/familier/Chemin-22.jpg',
            'photos/donjons/familier/Chemin-23.jpg',
            'photos/donjons/familier/Chemin-24.jpg',
            'photos/donjons/familier/Chemin-25.jpg',
            'photos/donjons/familier/Chemin-26.jpg',
            'photos/donjons/familier/Chemin-27.jpg',
            'photos/donjons/familier/Chemin-28.jpg',
            'photos/donjons/familier/Chemin-29.jpg'
        ];

        return $this->render('Donjons/Familiers/familiers.html.twig', [
            'title' => 'Donjon des Familiers',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Familiers'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Familiers'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Familiers'),
            'slides' => $slides,
            'extraBoard' => [
                [
                    'titre' => 'Gain',
                    'valeur' => 'Poudre Réssurection'
                ],
                [
                    'titre' => 'Bonus',
                    'valeur' => 'Réssuciter un Familier'
                ],
            ],
        ]);
    }


    /**
     * @Route("/donjons/milimulou", name="milimulou")
     * ▬▬▬▬ Donjon Incarnam ▬▬▬▬
     * @return Response
     */
    public function milimulou(): Response
    {
        return $this->render('Donjons/Incarnam/milimulou.html.twig', [
            'title' => 'Donjon Incarnam',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Incarnam'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Incarnam'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Incarnam'),
            'extraBoard' => [
                [
                    'titre' => 'Zone Accessible ',
                    'valeur' => 'Level 15 maxi'
                ]
            ],
        ]);
    }


    /**
     * @Route("/donjons/tournesol-affame", name="tournesolAffame")
     * ▬▬▬▬ Donjon des Champs ▬▬▬▬
     * @return Response
     */
    public function tournesolAffame(): Response
    {
        return $this->render('Donjons/Champs/champs.html.twig', [
            'title' => 'Donjon des Champs',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Champs'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Champs'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Champs'),
            'extraBoard' => [
                [
                    'titre' => 'Drop',
                    'valeur' => 'Pano Paysane'
                ],
                [
                    'titre' => 'Drop',
                    'valeur' => 'Sort Libération'
                ],
                [
                    'titre' => 'Drop',
                    'valeur' => 'Sort Flamiche'
                ],
            ]
        ]);
    }


    /**
     * @Route("/donjons/mob-leponge", name="mobLePonge")
     * ▬▬▬▬ Donjon Ensablé ▬▬▬▬
     * @return Response
     */
    public function mobLePonge(): Response
    {
        return $this->render('Donjons/Ensable/ensable.html.twig', [
            'title' => 'Donjon Ensablé',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon ensable'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon ensable'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon ensable'),
            'extraBoard' => [
                [
                    'titre' => 'Drop',
                    'valeur' => 'Pano Mousse'
                ],
                [
                    'titre' => 'Emote',
                    'valeur' => 'S\'allonger'
                ],
            ]
        ]);
    }


    /**
     * @Route("/donjons/bouftou-royal", name="bouftouRoyal")
     * ▬▬▬▬ Donjon Bouftou ▬▬▬▬
     * @return Response
     */
    public function bouftouRoyal(): Response
    {
        return $this->render('Donjons/BouftouRoyal/bouftouroyal.html.twig', [
            'title' => 'Donjon des Bouftous',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Bouftou'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Bouftous'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Bouftous'),
            'extraBoard' => [
                [
                    'titre' => 'Familier',
                    'valeur' => '<a href="../familiers/#chacha" title="Familier Chacha" class="lien" target="_blank">Chacha</a>'
                ],
                [
                    'titre' => 'Drop',
                    'valeur' => 'Pano Bouftou Royal'
                ],
            ]
        ]);
    }


    /**
     * @Route("/donjons/chafer-fantassin", name="chaferFantassin")
     * ▬▬▬▬ Donjon Chafer ▬▬▬▬
     * @return Response
     */
    public function chaferFantassin(): Response
    {
        return $this->render('Donjons/Squelettes/squelettes.html.twig', [
            'title' => 'Donjon des Squelettes',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Squelette'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Squelettes'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Squelettes'),
            'extraBoard' => [
                [
                    'titre' => 'Sort',
                    'valeur' => 'Invocation Chaferfu'
                ]
            ]
        ]);
    }


    /**
     * @Route("/donjons/batofu", name="batofu")
     * ▬▬▬▬ Donjon des Tofus ▬▬▬▬
     * @return Response
     */
    public function batofu(): Response
    {
        return $this->render('Donjons/Tofus/tofus.html.twig', [
            'title' => 'Donjon des Tofus',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Tofus'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Tofus'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Tofus'),
            'extraBoard' => [
                [
                    'titre' => 'Drop',
                    'valeur' => 'Pano Tofu',
                ]
            ]
        ]);
    }


    /**
     * @Route("/donjons/coffre-des-forgerons", name="coffreDesForgerons")
     * ▬▬▬▬ Donjon des Forgerons ▬▬▬▬
     * @return Response
     */
    public function coffreDesForgerons(): Response
    {
        return $this->render('Donjons/Forgerons/forgerons.html.twig', [
            'title' => 'Donjon des Forgerons',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Forgerons'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Forgerons'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Forgerons'),
            'extraBoard' => [
                [
                    'titre' => 'Gain',
                    'valeur' => 'Manuel du Tailleur'
                ],
                [
                    'titre' => 'Emote',
                    'valeur' => '<a href="../emotes/saluer" class="lien" target="_blank">Saluer</a>'
                ],
            ]
        ]);
    }


    /**
     * @Route("/donjons/scarabosse-dore", name="scarabosseDore")
     * ▬▬▬▬ Donjon des Scarafeuilles ▬▬▬▬
     * @return Response
     */
    public function scarabosseDore(): Response
    {
        return $this->render('Donjons/Scarafeuilles/scarafeuilles.html.twig', [
            'title' => 'Donjon des Scarafeuilles',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Scarafeuilles'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Scarafeuilles'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Scarafeuilles'),
        ]);
    }


    /**
     * @Route("/donjons/shin-larve", name="shinLarve")
     * ▬▬▬▬ Donjon des Larves ▬▬▬▬
     * @return Response
     */
    public function shinLarve(): Response
    {
        return $this->render('Donjons/Larves/larves.html.twig', [
            'title' => 'Donjon des Larves',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Larves'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Larves'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Larves'),
            'extraBoard' => [
                [
                    'titre' => 'Astuces',
                    'valeur' => '<span style="background-color:red; padding: 0 0.2em;">Minimum 2 persos</span>'
                ],
                [
                    'titre' => 'Prérequis',
                    'valeur' => '<span style="background-color:red; padding: 0 0.2em;" title="Prévoir 1 peau de larve de chaque couleur">Peaux de larve</span>'
                ],
            ]
        ]);
    }


    /**
     * @Route("/donjons/sapik", name="sapik")
     * ▬▬▬▬ Donjon Noël 1 ▬▬▬▬
     * @return Response
     */
    public function sapik(): Response
    {
        $slides = [
            'photos/donjons/noel-1/Chemin-1.jpg',
            'photos/donjons/noel-1/Chemin-2.jpg',
            'photos/donjons/noel-1/Chemin-3.jpg',
            'photos/donjons/noel-1/Chemin-4.jpg',
            'photos/donjons/noel-1/Chemin-5.jpg',
        ];

        return $this->render('Donjons/Noel1/noel1.html.twig', [
            'title' => 'Donjon de Noel 1',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon de Noël n°1'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Noel 1'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Noel 1'),
            'slides' => $slides,
            'extraBoard' => [
                [
                    'titre' => 'Drop',
                    'valeur' => 'Cadeaux de Noël'
                ]
            ]
        ]);
    }


    /**
     * @Route("/donjons/BlopGriotteRoyal", name="blopGriotteRoyal")
     * ▬▬▬▬ Donjon des Blops ▬▬▬▬
     * @return Response
     */
    public function blopGriotteRoyal(): Response
    {
        return $this->render('Donjons/Blops/blops.html.twig', [
            'title' => 'Donjon des Blops',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Blops'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Blops'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Blops'),
        ]);
    }


    /**
     * @Route("/donjons/bulbig", name="bulbig")
     * ▬▬▬▬ Donjon des Bulbes ▬▬▬▬
     * @return Response
     */
    public function bulbig(): Response
    {
        return $this->render('Donjons/Bulbes/bulbes.html.twig', [
            'title' => 'Donjon des Bulbes',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Bulbes'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Bulbes'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Bulbes'),
            'extraBoard' => [
                [
                    'titre' => 'Astuces',
                    'valeur' => '<span style="background-color:red; padding: 0 0.2em;">Places Restreintes</span>'
                ],
                [
                    'titre' => 'Sort',
                    'valeur' => 'Capture d\'Âme'
                ],
            ]
        ]);
    }


    /**
     * @Route("/donjons/corailleur-magistral", name="corailleurMagistral")
     * ▬▬▬▬ Donjon Grotte Hesque ▬▬▬▬
     * @return Response
     */
    public function corailleurMagistral(): Response
    {
        return $this->render('Donjons/GrotteHesque/grotteHesque.html.twig', [
            'title' => 'Donjon Grotte Hesque',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Grotte Hesque'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Grotte Hesque'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Grotte Hesque'),
            'extraBoard' => [
                [
                    'titre' => 'Relique',
                    'valeur' => 'Première d\'Otomaï'
                ]
            ]
        ]);
    }


    /**
     * @Route("/donjons/bworkette", name="bworkette")
     * ▬▬▬▬ Donjon des Bworks ▬▬▬▬
     * @return Response
     */
    public function bworkette(): Response
    {
        return $this->render('Donjons/Bworkette/bworkette.html.twig', [
            'title' => 'Donjon des Bworks',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Bworks'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Bworks'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Bworks'),
            'extraBoard' => [
                [
                    'titre' => 'Familier',
                    'valeur' => '<a href="../familiers/#bworky" class="lien" title="Familier Bworky" target="_blank">Bworky</a>'
                ]
            ]
        ]);
    }


    /**
     * @Route("/donjons/chemin", name="chemin")
     * ▬▬▬▬ Chemin Château Wabbit ▬▬▬▬
     * @return Response
     */
    public function chemin(): Response
    {
        return $this->render('Donjons/Chemin/cheminChateauWabbit.html.twig', [
            'title' => 'Chemin Château Wabbit',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Chemin Château Wabbit'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Chemin Château Wabbit'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Chemin Château Wabbit'),
            'extraBoard' => [
                [
                    'titre' => 'Objets Quêtes',
                    'valeur' => 'Récupération de Clefs'
                ]
            ]
        ]);
    }


    /**
     * @Route("/donjons/wa-wabbit", name="waWabbit")
     * ▬▬▬▬ Château des Wabbits ▬▬▬▬
     * @return Response
     */
    public function waWabbit(): Response
    {
        return $this->render('Donjons/ChateauWabbit/chateauWabbit.html.twig', [
            'title' => 'Château Wabbit',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Château des Wabbits'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Château des Wabbits'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Château des Wabbits'),
            'extraBoard' => [
                [
                    'titre' => 'Récupération',
                    'valeur' => ' 1 Item Wabbit'
                ]
            ]
        ]);
    }


    /**
     * @Route("/donjons/chouque", name="chouque")
     * ▬▬▬▬ Donjon du Chouque ▬▬▬▬
     * @return Response
     */
    public function chouque(): Response
    {
        return $this->render('Donjons/Chouque/chouque.html.twig', [
            'title' => 'Donjon du Chouque',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon du Chouque'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon du Chouque'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon du Chouque'),
            'extraBoard' => [
                [
                    'titre' => 'Gain',
                    'valeur' => 'Objets de Quête'
                ]
            ]
        ]);
    }


    /**
     * @Route("/donjons/craqueleurlegendaire", name="craqueleurLegendaire")
     * ▬▬▬▬ Donjon des Craqueleurs ▬▬▬▬
     * @return Response
     */
    public function craqueleurLegendaire(): Response
    {
        return $this->render('Donjons/Craqueleurs/craqueleurs.html.twig', [
            'title' => 'Donjon des Craqueleurs',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Craqueleurs'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Craqueleurs'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Craqueleurs'),
            'extraBoard' => [
                [
                    'titre' => 'Astuces',
                    'valeur' => '<span style="background-color:red; padding: 0 0.2em;">Places Restreintes</span>'
                ],
            ]
        ]);
    }


    /**
     * @Route("/donjons/gelee-royale-fraise", name="geleeRoyaleFraise")
     * ▬▬▬▬ Donjon des Gelées ▬▬▬▬
     * @return Response
     */
    public function geleeRoyaleFraise(): Response
    {
        return $this->render('Donjons/Gelees/gelees.html.twig', [
            'title' => 'Donjon des Gelées',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Gelées'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Gelées'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Gelées'),
            'extraBoard' => [
                [
                    'titre' => 'Drop',
                    'valeur' => 'Gelées Royales'
                ]
            ]
        ]);
    }


    /**
     * @Route("/donjons/chemin-dofus-cawotte", name="cheminDofusCawotte")
     * ▬▬▬▬ Chemin Dofus Cawotte ▬▬▬▬
     * @return Response
     */
    public function cheminDofusCawotte(): Response
    {
        return $this->render('Donjons/Chemin/cheminDofusCawotte.html.twig', [
            'title' => 'Chemin Donjon Dofus Cawotte',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Chemin Château Wabbit'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Chemin Château Wabbit'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Chemin Château Wabbit'),
        ]);
    }


    /**
     * @Route("/donjons/dofus-cawotte", name="dofusCawotte")
     * ▬▬▬▬ Donjon Dofus Cawotte ▬▬▬▬
     * @return Response
     */
    public function dofusCawotte(): Response
    {
        return $this->render('Donjons/DofusCawotte/dofusCawotte.html.twig', [
            'title' => 'Donjon Dofus Cawotte',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Dofus Cawotte'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Dofus Cawotte'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Dofus Cawotte'),
            'extraBoard' => [
                [
                    'titre' => 'Récupération',
                    'valeur' => 'Dofus Cawotte',
                ]
            ]
        ]);
    }


    /**
     * @Route("/donjons/gourlo-le-terrible", name="gourloLeTerrible")
     * ▬▬▬▬ Donjon Arche Otomaï ▬▬▬▬
     * @return Response
     */
    public function gourloLeTerrible(): Response
    {
        return $this->render('Donjons/ArcheOtomai/archeOtomai.html.twig', [
            'title' => 'Donjon Arche Otomaï',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Arche Otomaï'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Arche Otomaï'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Arche Otomaï'),
        ]);
    }


    /**
     * @Route("/donjons/rat-blanc", name="ratBlanc")
     * ▬▬▬▬ Donjon Rat Blanc ▬▬▬▬
     * @return Response
     */
    public function ratBlanc(): Response
    {
        return $this->render('Donjons/RatBlanc/ratBlanc.html.twig', [
            'title' => 'Donjon Rat Blanc',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Rat Blanc'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Rat Blanc'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Rat Blanc'),
        ]);
    }


    /**
     * @Route("/donjons/rat-noir", name="ratNoir")
     * ▬▬▬▬ Donjon Rat Noir ▬▬▬▬
     * @return Response
     */
    public function ratNoir(): Response
    {
        return $this->render('Donjons/RatBlanc/ratBlanc.html.twig', [
            'title' => 'Donjon Rat Noir',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Rat Noir'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Rat Noir'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Rat Noir'),
        ]);
    }


    /**
     * @Route("/donjons/abraknyde-ancestral", name="abraknydeAncestral")
     * ▬▬▬▬ Donjon des Abraknydes ▬▬▬▬
     * @return Response
     */
    public function abraknydeAncestral(): Response
    {
        return $this->render('Donjons/RatBlanc/ratBlanc.html.twig', [
            'title' => 'Donjon des Abraknydes',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Abraknydes'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Abraknydes'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Abraknydes'),
        ]);
    }


    /**
     * @Route("/donjons/maitre-corbac", name="maitreCorbac")
     * ▬▬▬▬ Donjon du Maître Corbac ▬▬▬▬
     * @return Response
     */
    public function maitreCorbac(): Response
    {
        return $this->render('Donjons/MaitreCorbac/maitreCorbac.html.twig', [
            'title' => 'Donjon du Maître Corbac',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon du Maître Corbac'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon du Maître Corbac'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon du Maître Corbac'),
        ]);
    }


    /**
     * @Route("/donjons/koulosse", name="koulosse")
     * ▬▬▬▬ Donjon Koulosse ▬▬▬▬
     * @return Response
     */
    public function koulosse(): Response
    {
        $slides = [
            'photos/donjons/koulosse/Chemin-1.jpg',
            'photos/donjons/koulosse/Chemin-3.jpg',
            'photos/donjons/koulosse/Chemin-4.jpg',
            'photos/donjons/koulosse/Chemin-5.jpg',
            'photos/donjons/koulosse/Chemin-6.jpg',
            'photos/donjons/koulosse/Chemin-7.jpg',
            'photos/donjons/koulosse/Chemin-8.jpg',
            'photos/donjons/koulosse/Chemin-9.jpg',
            'photos/donjons/koulosse/Chemin-10.jpg',
            'photos/donjons/koulosse/Chemin-11.jpg',
            'photos/donjons/koulosse/Chemin-12.jpg',
            'photos/donjons/koulosse/Chemin-13.jpg',
            'photos/donjons/koulosse/Chemin-14.jpg',
            'photos/donjons/koulosse/Chemin-15.jpg',
            'photos/donjons/koulosse/Chemin-16.jpg',
            'photos/donjons/koulosse/Chemin-17.jpg',
            'photos/donjons/koulosse/Chemin-18.jpg',
            'photos/donjons/koulosse/Chemin-19.jpg',
            'photos/donjons/koulosse/Chemin-20.jpg',
            'photos/donjons/koulosse/Chemin-21.jpg',
            'photos/donjons/koulosse/Chemin-22.jpg',
            'photos/donjons/koulosse/Chemin-23.jpg',
            'photos/donjons/koulosse/Chemin-24.jpg',
            'photos/donjons/koulosse/Chemin-25.jpg',
            'photos/donjons/koulosse/Chemin-26.jpg',
            'photos/donjons/koulosse/Chemin-27.jpg',
            'photos/donjons/koulosse/Chemin-28.jpg',
            'photos/donjons/koulosse/Chemin-29.jpg',
            'photos/donjons/koulosse/Chemin-30.jpg',
            'photos/donjons/koulosse/Chemin-31.jpg',
            'photos/donjons/koulosse/Chemin-32.jpg',
            'photos/donjons/koulosse/Chemin-33.jpg',
            'photos/donjons/koulosse/Chemin-34.jpg',
            'photos/donjons/koulosse/Chemin-35.jpg',
            'photos/donjons/koulosse/Chemin-36.jpg',
            'photos/donjons/koulosse/Chemin-37.jpg',
            'photos/donjons/koulosse/Chemin-38.jpg',
            'photos/donjons/koulosse/Chemin-39.jpg',
            'photos/donjons/koulosse/Chemin-40.jpg',
            'photos/donjons/koulosse/Chemin-41.jpg',
            'photos/donjons/koulosse/Chemin-42.jpg',
            'photos/donjons/koulosse/Chemin-43.jpg',
            'photos/donjons/koulosse/Chemin-44.jpg',
            'photos/donjons/koulosse/Chemin-45.jpg',
            'photos/donjons/koulosse/Chemin-46.jpg',
            'photos/donjons/koulosse/Chemin-47.jpg',
            'photos/donjons/koulosse/Chemin-48.jpg',
            'photos/donjons/koulosse/Chemin-49.jpg'
        ];

        return $this->render('Donjons/Koulosse/koulosse.html.twig', [
            'title' => 'Donjon du Koulosse',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon du Koulosse'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon du Koulosse'),
            'slides' => $slides,
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon du Koulosse'),
        ]);
    }


    /**
     * @Route("/donjons/meulou", name="meulou")
     * ▬▬▬▬ Donjon des Canides ▬▬▬▬
     * @return Response
     */
    public function meulou(): Response
    {
        return $this->render('Donjons/MaitreCorbac/maitreCorbac.html.twig', [
            'title' => 'Donjon des Canidés',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Canidés'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Canidés'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Canidés'),
        ]);
    }


    /**
     * @Route("/donjons/tofu-royal", name="tofuRoyal")
     * ▬▬▬▬ Donjon Tofu Royal ▬▬▬▬
     * @return Response
     */
    public function tofuRoyal(): Response
    {
        return $this->render('Donjons/MaitreCorbac/maitreCorbac.html.twig', [
            'title' => 'Donjon Tofu Royal',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Tofu Royal'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Tofu Royal'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Tofu Royal'),
        ]);
    }


    /**
     * @Route("/donjons/moon-2", name="moon2")
     * ▬▬▬▬ Donjon du Moon ▬▬▬▬
     * @return Response
     */
    public function moon2(): Response
    {
        return $this->render('Donjons/Moon/moon.html.twig', [
            'title' => 'Donjon Moon',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Moon'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Moon'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Moon'),
        ]);
    }


    /**
     * @Route("/donjons/tanukoui-san", name="tanukouiSan")
     * ▬▬▬▬ Donjon des Kitsounes ▬▬▬▬
     * @return Response
     */
    public function tanukouiSan(): Response
    {
        return $this->render('Donjons/TanukouiSan/tanukouiSan.html.twig', [
            'title' => 'Donjon des Kitsounes',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Kitsounes'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Kitsounes'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Kitsounes'),
        ]);
    }


    /**
     * @Route("/donjons/rasboul", name="rasboul")
     * ▬▬▬▬ Donjon du Rasboul ▬▬▬▬
     * @return Response
     */
    public function rasboul(): Response
    {
        return $this->render('Donjons/Rasboul/rasboul.html.twig', [
            'title' => 'Donjon Goulet du Rasboul',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Goulet du Rasboul'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Goulet du Rasboul'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Goulet du Rasboul'),
        ]);
    }


    /**
     * @Route("/donjons/papa-nowel", name="papaNowel")
     * ▬▬▬▬ Donjon Noel 2 ▬▬▬▬
     * @return Response
     */
    public function papNowel(): Response
    {
        $slides = [
            'photos/donjons/noel-2/Chemin-1.jpg',
            'photos/donjons/noel-2/Chemin-2.jpg',
            'photos/donjons/noel-2/Chemin-3.jpg',
            'photos/donjons/noel-2/Chemin-4.jpg',
            'photos/donjons/noel-2/Chemin-5.jpg',
        ];

        return $this->render('Donjons/Noel2/noel2.html.twig', [
            'title' => 'Donjon de Noël n°2',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon de Noël n°2'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon de Noël n°2'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon de Noël n°2'),
            'slides' => $slides,
        ]);
    }


    /**
     * @Route("/donjons/BlopMulticolore", name="blopMulticolore")
     * ▬▬▬▬ Donjon du Blop Multicolore ▬▬▬▬
     * @return Response
     */
    public function blopMulticolore(): Response
    {
        return $this->render('Donjons/BlopMulticolore/blopMulticolore.html.twig', [
            'title' => 'Donjon Blop Multicolore',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Blop Multicolore'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Blop Multicolore'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Blop Multicolore'),
        ]);
    }


    /**
     * @Route("/donjons/maitre-pandore", name="maitrePandore")
     * ▬▬▬▬ Donjon du Maître Pandore ▬▬▬▬
     * @return Response
     */
    public function maitrePandore(): Response
    {
        return $this->render('Donjons/MaitrePandore/maitrePandore.html.twig', [
            'title' => 'Donjon des Pandikazes',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Pandikazes'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Pandikazes'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Pandikazes'),
        ]);
    }


    /**
     * @Route("/donjons/skeunk", name="skeunk")
     * ▬▬▬▬ Donjon Skeunk ▬▬▬▬
     * @return Response
     */
    public function skeunk(): Response
    {
        $slides = [
            'photos/donjons/skeunk/zaap.jpg',
            'photos/donjons/skeunk/2.jpg',
            'photos/donjons/skeunk/3.jpg',
            'photos/donjons/skeunk/4.jpg',
            'photos/donjons/skeunk/5.jpg',
            'photos/donjons/skeunk/6.jpg',
            'photos/donjons/skeunk/7.jpg',
            'photos/donjons/skeunk/8.jpg',
            'photos/donjons/skeunk/9.jpg',
            'photos/donjons/skeunk/10.jpg',
            'photos/donjons/skeunk/11.jpg',
            'photos/donjons/skeunk/12.jpg',
            'photos/donjons/skeunk/13.jpg',
            'photos/donjons/skeunk/14.jpg',
            'photos/donjons/skeunk/15.jpg',
            'photos/donjons/skeunk/16.jpg',
            'photos/donjons/skeunk/17.jpg',
            'photos/donjons/skeunk/18.jpg',
            'photos/donjons/skeunk/19.jpg',
            'photos/donjons/skeunk/20.jpg',
            'photos/donjons/skeunk/21.jpg',
            'photos/donjons/skeunk/22.jpg',
            'photos/donjons/skeunk/23.jpg',
            'photos/donjons/skeunk/24.jpg',
            'photos/donjons/skeunk/25.jpg',
            'photos/donjons/skeunk/26.jpg',
            'photos/donjons/skeunk/27.jpg',
            'photos/donjons/skeunk/28.jpg',
            'photos/donjons/skeunk/29.jpg',
            'photos/donjons/skeunk/30.jpg',
            'photos/donjons/skeunk/31.jpg',
            'photos/donjons/skeunk/32.jpg',
            'photos/donjons/skeunk/33.jpg',
            'photos/donjons/skeunk/34.jpg',
            'photos/donjons/skeunk/35.jpg',
            'photos/donjons/skeunk/36.jpg',
            'photos/donjons/skeunk/37.jpg',
            'photos/donjons/skeunk/38.jpg',
            'photos/donjons/skeunk/39.jpg',
            'photos/donjons/skeunk/40.jpg',
            'photos/donjons/skeunk/41.jpg',
            'photos/donjons/skeunk/42.jpg',
            'photos/donjons/skeunk/43.jpg',
            'photos/donjons/skeunk/44.jpg',
            'photos/donjons/skeunk/45.jpg',
            'photos/donjons/skeunk/46.jpg',
            'photos/donjons/skeunk/47.jpg',
            'photos/donjons/skeunk/48.jpg',
            'photos/donjons/skeunk/49.jpg',
            'photos/donjons/skeunk/50.jpg',
            'photos/donjons/skeunk/51.jpg',
            'photos/donjons/skeunk/52.jpg',
            'photos/donjons/skeunk/53.jpg',
            'photos/donjons/skeunk/54.jpg',
            'photos/donjons/skeunk/55.jpg',
            'photos/donjons/skeunk/56.jpg',
            'photos/donjons/skeunk/57.jpg',
            'photos/donjons/skeunk/58.jpg'
        ];

        return $this->render('Donjons/Skeunk/skeunk.html.twig', [
            'title' => 'Donjon du Skeunk',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon du Skeunk'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon du Skeunk'),
            'slides' => $slides,
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon du Skeunk'),
        ]);
    }


    /**
     * @Route("/donjons/dragon-cochon", name="dragonCochon")
     * ▬▬▬▬ Donjon du Dragon Cochon ▬▬▬▬
     * @return Response
     */
    public function dragonCochon(): Response
    {
        return $this->render('Donjons/DragonCochon/dragon-cochon.html.twig', [
            'title' => 'Donjon Dragon Cochon',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Dragon Cochon'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Dragon Cochon'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Dragon Cochon'),
        ]);
    }


    /**
     * @Route("/donjons/dark-vlad", name="darkvlad")
     * ▬▬▬▬ Donjon du Dark Vlad ▬▬▬▬
     * @return Response
     */
    public function darkvlad(): Response
    {
        return $this->render('Donjons/DarkVlad/darkvlad.html.twig', [
            'title' => 'Donjon Dark Vlad',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Dark Vlad'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Dark Vlad'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Dark Vlad'),
        ]);
    }


    /**
     * @Route("/donjons/minotoror", name="minotoror")
     * ▬▬▬▬ Donjon du Minotoror ▬▬▬▬
     * @return Response
     */
    public function minotoror(): Response
    {
        return $this->render('Donjons/Minotoror/minotoror.html.twig', [
            'title' => 'Donjon du Minotoror',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon du Minotoror'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon du Minotoror'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon du Minotoror'),
        ]);
    }


    /**
     * @Route("/donjons/sphinter-cell", name="sphinterCell")
     * ▬▬▬▬ Donjon du Sphinter Cell ▬▬▬▬
     * @return Response
     */
    public function sphinterCell(): Response
    {
        return $this->render('Donjons/SphinterCell/sphinterCell.html.twig', [
            'title' => 'Donjon Sphinter Cell',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Sphinter Cell'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Sphinter Cell'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Sphinter Cell'),
        ]);
    }


    /**
     * @Route("/donjons/peki-peki", name="pekiPeki")
     * ▬▬▬▬ Donjon des Firefoux ▬▬▬▬
     * @return Response
     */
    public function pekiPeki(): Response
    {
        return $this->render('Donjons/PekiPeki/pekiPeki.html.twig', [
            'title' => 'Donjon des Firefoux',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Firefoux'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Firefoux'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Firefoux'),
        ]);
    }

    /**
     * @Route("/donjons/tynril", name="tynril")
     * ▬▬▬▬ Donjon du Tynril ▬▬▬▬
     * @return Response
     */
    public function tynril(): Response
    {
        return $this->render('Donjons/Tynril/tynril.html.twig', [
            'title' => 'Donjon Laboratoire du Tynril',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Laboratoire du Tynril'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Laboratoire du Tynril'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Laboratoire du Tynril'),
        ]);
    }


    /**
     * @Route("/donjons/crocabulia", name="crocabulia")
     * ▬▬▬▬ Donjon des Dragoeufs ▬▬▬▬
     * @return Response
     */
    public function crocabulia(): Response
    {
        return $this->render('Donjons/Crocabulia/crocabulia.html.twig', [
            'title' => 'Donjon des Dragoeufs',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon des Dragoeufs'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon des Dragoeufs'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon des Dragoeufs'),
        ]);
    }


    /**
     * @Route("/donjons/pere-fwetar", name="pereFwetar")
     * ▬▬▬▬ Donjon Noël 3 ▬▬▬▬
     * @return Response
     */
    public function pereFwetar(): Response
    {
        return $this->render('Donjons/Noel3/noel3.html.twig', [
            'title' => 'Donjon de Noël n°3',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon de Noël n°3'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon de Noël n°3'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon de Noël n°3'),
        ]);
    }


    /**
     * @Route("/donjons/chene-mou", name="cheneMou")
     * ▬▬▬▬ Donjon du Chêne Mou ▬▬▬▬
     * @return Response
     */
    public function cheneMou(): Response
    {
        return $this->render('Donjons/CheneMou/cheneMou.html.twig', [
            'title' => 'Donjon du Chêne Mou',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon du Chêne Mou'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon du Chêne Mou'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon du Chêne Mou'),
        ]);
    }


    /**
     * @Route("/donjons/kimbo", name="kimbo")
     * ▬▬▬▬ Donjon du Kimbo ▬▬▬▬
     * @return Response
     */
    public function kimbo(): Response
    {
        return $this->render('Donjons/Kimbo/kimbo.html.twig', [
            'title' => 'Donjon Canopée du Kimbo',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Canopée du Kimbo'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Canopée du Kimbo'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Canopée du Kimbo'),
        ]);
    }


    /**
     * @Route("/donjons/bworker", name="bworker")
     * ▬▬▬▬ Donjon du Bworker ▬▬▬▬
     * @return Response
     */
    public function bworker(): Response
    {
        return $this->render('Donjons/Bworker/bworker.html.twig', [
            'title' => 'Donjon du Bworker',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon du Bworker'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon du Bworker'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon du Bworker'),
        ]);
    }


    /**
     * @Route("/donjons/minotot", name="minotot")
     * ▬▬▬▬ Donjon du Minotot ▬▬▬▬
     * @return Response
     */
    public function minotot(): Response
    {
        return $this->render('Donjons/Minotot/minotot.html.twig', [
            'title' => 'Donjon du Minotot',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon du Minotot'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon du Minotot'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon du Minotot'),
        ]);
    }


    /**
     * @Route("/donjons/kralamour-geant", name="kralamourGeant")
     * ▬▬▬▬ Donjon du Kralamour Géant ▬▬▬▬
     * @return Response
     */
    public function kralamourGeant(): Response
    {
        return $this->render('Donjons/KralamourGeant/kralamourGeant.html.twig', [
            'title' => 'Donjon Antre du Kralamour',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Antre du Kralamour'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Antre du Kralamour'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Antre du Kralamour'),
        ]);
    }


    /**
     * @Route("/donjons/ougah", name="ougah")
     * ▬▬▬▬ Donjon Ougah ▬▬▬▬
     * @return Response
     */
    public function ougah(): Response
    {
        return $this->render('Donjons/KralamourGeant/kralamourGeant.html.twig', [
            'title' => 'Donjon Fungus',
            'donjons' => $this->donjonsRepository->rechercheDonjon('Donjon Fungus'),
            'tutos' => $this->donjonsCardsDoubleRepository->affichage('Donjon Fungus'),
            'descriptions' => $this->footerDescriptionRepository->affichage('Donjon Fungus'),
        ]);
    }

}
