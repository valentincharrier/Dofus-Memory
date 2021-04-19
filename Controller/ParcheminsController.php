<?php

namespace App\Controller;

use App\Repository\DonjonsCardsDoubleRepository;
use App\Repository\FooterDescriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ParcheminsController extends AbstractController
{

    private $footerDescriptionRepository;
    private $donjonsCardsDoubleRepository;

    public function __construct(FooterDescriptionRepository $footerDescriptionRepository, DonjonsCardsDoubleRepository $donjonsCardsDoubleRepository){
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->donjonsCardsDoubleRepository = $donjonsCardsDoubleRepository;
    }


    /**
     * @Route("/parchemins", name="parchemins")
     * ▬▬▬▬ Parchemin Acceuil ▬▬▬▬
     * @return Response
     */
    public function parchemins(): Response
    {
        return $this->render('Parchemins/index.html.twig', [
            'title' => 'Les Parchemins',
            'descriptions' => $this->footerDescriptionRepository->affichage('Parchemins'),
        ]);
    }


    /**
     * @Route("/parchemins/chance", name="chance")
     * ▬▬▬▬ Parchemin Chance ▬▬▬▬
     * @return Response
     */
    public function chance(): Response
    {
        $Donnees = array(
            'Categorie'    => array(

                'bloc 1'    => array(
                    'nom'       => 'Chance < 25',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => '[2,-2]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '80 Pattes araknes',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[0,2]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '1 Amulette du bûcheron',
                            ),
                        ),

                        'ligne 3' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde indigo',
                                'recette 2'    => 'Dinde indigo-amande',
                                'recette 3'    => 'Dinde indigo-ebène',
                            ),
                        ),
                    ),
                ),



                'bloc 2'    => array(
                    'nom'       => 'Chance < 50',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[4,8]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '90 Pattes araknes',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '65 Trèfles à 5 feuilles',
                            ),
                        ),
                    ),
                ),


                'bloc 3'    => array(
                    'nom'       => 'Chance < 80',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[-2,-4]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '75 Pattes araknes',
                                'recette 2'    => '60 Trèfles à 5 feuilles',
                                'recette 3'    => '40 Ongles chevaucheurs',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde ivoire',
                                'recette 2'    => 'Dinde ivoire-amande',
                                'recette 3'    => 'Dinde indigo-ivoire',
                                'recette 4'    => 'Dinde indigo-turquoise',
                            ),
                        ),
                    ),
                ),


                'bloc 4'    => array(
                    'nom'       => 'Chance < 100',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[2,5]',
                            'bonus'     => '+2',
                            'recettes'  => array(
                                'recette 1'    => '60 Pattes araknes',
                                'recette 2'    => '55 Trèfles à 5 feuilles',
                                'recette 3'    => '40 Ongles chevaucheurs',
                                'recette 4'    => '15 Queues du mulous',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde emeraude-ivoire',
                                'recette 2'    => 'Dinde emeraude-indigo',
                                'recette 3'    => 'Dinde prune-ivoire',
                            ),
                        ),
                    ),
                ),


            ),
        );

        return $this->render('Parchemins/Chance/chance.html.twig', [
            'title' => "Parchemins de Chance",
            'image' => 'chance',
            'donnees' => $Donnees,
            'tutos' =>  $this->donjonsCardsDoubleRepository->affichage("Parchemin de Chance"),
            'descriptions' => $this->footerDescriptionRepository->affichage("Parchemins De Chance"),
        ]);
    }


    /**
     * @Route("/parchemins/agilite", name="agilite")
     * ▬▬▬▬ Parchemin Agilité ▬▬▬▬
     * @return Response
     */
    public function agilite(): Response
    {
        $Donnees = array(
            'Categorie'    => array(

                'bloc 1'    => array(
                    'nom'       => 'Agilité < 25',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => '[0,3]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '100 Anneaux agilesques',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde ébène',
                                'recette 2'    => 'Dinde ébène-amande',
                            ),
                        ),
                    ),
                ),



                'bloc 2'    => array(
                    'nom'       => 'Agilité < 50',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[2,17]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '70 Glands',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[8,-2]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '70 Glands',
                                'recette 2'    => '70 Langues de pissenlits',
                            ),
                        ),

                        'ligne 3' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde ébène-orchidée',
                                'recette 2'    => 'Dinde ébène-pourpre',
                            ),
                        ),
                    ),
                ),


                'bloc 3'    => array(
                    'nom'       => 'Agilité < 80',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[3,4]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '75 Glands',
                                'recette 2'    => '75 Langues de pissenlits',
                                'recette 3'    => '70 Pétales de roses',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde turquoise',
                                'recette 2'    => 'Dinde ébène-turquoise',
                                'recette 3'    => 'Dinde ébène-ivoire',
                            ),
                        ),
                    ),
                ),


                'bloc 4'    => array(
                    'nom'       => 'Agilité < 100',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[3,4]',
                            'bonus'     => '+2',
                            'recettes'  => array(
                                'recette 1'    => '80 Glands',
                                'recette 2'    => '80 Langues de pissenlits',
                                'recette 3'    => '80 Pétales de roses',
                                'recette 4'    => '20 Spormes de champchamps',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+2',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde emeraude-turquoise',
                                'recette 2'    => 'Dinde ébène-prune',
                            ),
                        ),
                    ),
                ),

                
            ),
        );

        return $this->render('Parchemins/Agilite/agilite.html.twig', [
            'title' => "Parchemins d'Agilité",
            'image' => 'agilite',
            'donnees' => $Donnees,
            'tutos' => $this->donjonsCardsDoubleRepository->affichage("Parchemin d'Agilité"),
            'descriptions' => $this->footerDescriptionRepository->affichage("Parchemins D'Agilité"),
        ]);
    }


    /**
     * @Route("/parchemins/froce", name="force")
     * ▬▬▬▬ Parchemin Force ▬▬▬▬
     * @return Response
     */
    public function force(): Response
    {
        $Donnees = array(
            'Categorie'    => array(

                'bloc 1'    => array(
                    'nom'       => 'Force < 10',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Nuggets****',
                            ),
                        ),
                    ),
                ),


                'bloc 2'    => array(
                    'nom'       => 'Force < 20',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Cuisse de bouftou roti****',
                            ),
                        ),
                    ),
                ),


                'bloc 3'    => array(
                    'nom'       => 'Force < 25',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => '[1,3]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '100 Epines de champchamps',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[2,0]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '100 Peaux de larves bleues',
                            ),
                        ),

                        'ligne 3' => array(
                            'position'  => '[1,-2]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '80 Pics de prespics',
                            ),
                        ),

                        'ligne 4' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde pourpre',
                            ),
                        ),
                    ),
                ),


                'bloc 4'    => array(
                    'nom'       => 'Force < 50',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[-2,-3]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '70 Pics de prespics',
                                'recette 2'    => '70 Pinces de crabes',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde pourpre-amande',
                                'recette 2'    => 'Dinde pourpre-rousse',
                            ),
                        ),
                    ),
                ),


                'bloc 5'    => array(
                    'nom'       => 'Force < 60',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Jambon cuit****',
                            ),
                        ),
                    ),
                ),


                'bloc 6'    => array(
                    'nom'       => 'Force < 80',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[8,-2]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '70 Pics de prespics',
                                'recette 2'    => '75 Pince de crabes',
                                'recette 3'    => '40 Côtes de ribs',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde pourpre-turquoise',
                                'recette 2'    => 'Dinde pourpre-ivoire',
                            ),
                        ),

                        'ligne 3' => array(
                            'position'  => '[Food]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Wabbit grillé****',
                            ),
                        ),
                    ),
                ),


                'bloc 7'    => array(
                    'nom'       => 'Force < 100',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Bifsteak de dragoviande****',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[2,-3]',
                            'bonus'     => '+2',
                            'recettes'  => array(
                                'recette 1'    => '75 Pics de prespics',
                                'recette 2'    => '75 Pinces de crabes',
                                'recette 3'    => '45 Côtes de ribs',
                                'recette 4'    => '30 Silex',
                            ),
                        ),

                        'ligne 3' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+2',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde emeraude',
                                'recette 2'    => 'Dinde emeraude-ébène',
                                'recette 3'    => 'Dinde pourpre-prune',
                            ),
                        ),
                    ),
                ),

            ),
        );

        return $this->render('Parchemins/Force/force.html.twig', [
            'title' => "Parchemins de Force",
            'image' => 'force',
            'donnees' => $Donnees,
            'tutos' => $this->donjonsCardsDoubleRepository->affichage("Parchemin de Force"),
            'descriptions' => $this->footerDescriptionRepository->affichage("Parchemins De Force"),
        ]);
    }


    /**
     * @Route("/parchemins/intelligence", name="intelligence")
     * ▬▬▬▬ Parchemin Intelligence ▬▬▬▬
     * @return Response
     */
    public function intelligence(): Response
    {
        $Donnees = array(
            'Categorie'    => array(

                'bloc 1'    => array(
                    'nom'       => 'Intelligence < 10',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Greu-vette horreur****',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Poisson igloo****',
                            ),
                        ),
                    ),
                ),



                'bloc 2'    => array(
                    'nom'       => 'Intelligence < 25',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[7,1]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '100 Ceintures de chance',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde orchidée',
                            ),
                        ),
                    ),
                ),


                'bloc 3'    => array(
                    'nom'       => 'Intelligence < 30',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Crabe surimi exotique****',
                            ),
                        ),
                    ),
                ),


                'bloc 4'    => array(
                    'nom'       => 'Intelligence < 50',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[0,5]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '50 Peaux de larves bleues',
                                'recette 2'    => '40 Peaux de larves oranges',
                                'recette 3'    => '40 Peaux de larves vertes',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde orchidée-rousse',
                                'recette 2'    => 'Dinde orchidée-pourpre',
                            ),
                        ),

                        'ligne 3' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Raie de farle****',
                                'recette 2'    => 'Kralamour unique****',
                            ),
                        ),
                    ),
                ),


                'bloc 5'    => array(
                    'nom'       => 'Intelligence < 80',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[5,4]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '45 Peaux de larves bleues',
                                'recette 2'    => '45 Peaux de larves oranges',
                                'recette 3'    => '45 Peaux de larves vertes',
                                'recette 4'    => '30 Ailes de tofus maléfiques',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde orchidée-turquoise',
                                'recette 2'    => 'Dinde orchidée-ivoire',
                            ),
                        ),
                    ),
                ),


                'bloc 6'    => array(
                    'nom'       => 'Intelligence < 100',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Requin marché libre****',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[2,2]',
                            'bonus'     => '+2',
                            'recettes'  => array(
                                'recette 1'    => '60 Peaux de larves bleues',
                                'recette 2'    => '50 Peaux de larves oranges',
                                'recette 3'    => '50 Peaux de larves vertes',
                                'recette 4'    => '40 Ailes de tofu maléfiques',
                                'recette 5'    => '30 Sangs de vampires',
                            ),
                        ),

                        'ligne 3' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+2',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde prune',
                                'recette 2'    => 'Dinde prune-orchidée',
                                'recette 3'    => 'Dinde emeraude-prune',
                                'recette 4'    => 'Dinde emeraude-orchidée',
                            ),
                        ),
                    ),
                ),

            ),
        );

        return $this->render('Parchemins/Intelligence/intelligence.html.twig', [
            'title' => "Parchemins d'Intelligence",
            'image' => 'intelligence',
            'donnees' => $Donnees,
            'tutos' => $this->donjonsCardsDoubleRepository->affichage("Parchemin d'Intelligence"),
            'descriptions' => $this->footerDescriptionRepository->affichage("Parchemins D'Intelligence"),
        ]);
    }


    /**
     * @Route("/parchemins/sagesse", name="sagesse")
     * ▬▬▬▬ Parchemin Sagesse ▬▬▬▬
     * @return Response
     */
    public function sagesse(): Response
    {
        $Donnees = array(
            'Categorie'    => array(

                'bloc 1'    => array(
                    'nom'       => 'Sagesse < 10',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Goujon kiye',
                            ),
                        ),
                    ),
                ),


                'bloc 2'    => array(
                    'nom'       => 'Sagesse < 20',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Truite ancestrale****',
                            ),
                        ),
                    ),
                ),


                'bloc 3'    => array(
                    'nom'       => 'Sagesse < 25',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => '[8,2]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '100 Cornes de bouftous',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[10,3]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '100 Champignons',
                            ),
                        ),

                        'ligne 3' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde doré',
                                'recette 2'    => 'Dinde doré-amande',
                                'recette 3'    => 'Dinde doré-rousse',
                                'recette 4'    => 'Dinde doré-indigo',
                                'recette 5'    => 'Dinde doré-ébène',
                            ),
                        ),
                    ),
                ),


                'bloc 4'    => array(
                    'nom'       => 'Sagesse < 40',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Poisson tigre****',
                            ),
                        ),
                    ),
                ),


                'bloc 5'    => array(
                    'nom'       => 'Sagesse < 50',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => '[1,1]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '80 Champignons',
                                'recette 2'    => '30 Graines de tournesols',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde doré-orchidée',
                                'recette 2'    => 'Dinde doré-pourpre',
                            ),
                        ),

                        'ligne 3' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Carpette des sables****',),
                        ),
                    ),
                ),


                'bloc 6'    => array(
                    'nom'       => 'Sagesse < 70',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Bar iton****',
                            ),
                        ),
                    ),
                ),


                'bloc 7'    => array(
                    'nom'       => 'Sagesse < 80',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[1,1]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '90 Champignons',
                                'recette 2'    => '70 Graines de tournesols',
                                'recette 3'    => '40 Graines de chanvres',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde doré-turquoise',
                                'recette 2'    => 'Dinde doré-ivoire',
                            ),
                        ),
                    ),
                ),


                'bloc 8'    => array(
                    'nom'       => 'Sagesse < 100',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Chaton-perche****',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[-2,14]',
                            'bonus'     => '+2',
                            'recettes'  => array(
                                'recette 1'    => '90 Champignons',
                                'recette 2'    => '75 Graines de tournesols',
                                'recette 3'    => '60 Graines de chanvres',
                                'recette 4'    => '200 Ailes de moskitos',
                            ),
                        ),

                        'ligne 3' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+2',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde doré-emeraude',
                                'recette 2'    => 'Dinde doré-prune',
                            ),
                        ),
                    ),
                ),

            ),
        );

        return $this->render('Parchemins/Sagesse/sagesse.html.twig', [
            'title' => "Parchemins de Sagesse",
            'image' => 'sagesse',
            'donnees' => $Donnees,
            'tutos' => $this->donjonsCardsDoubleRepository->affichage("Parchemin de Sagesse"),
            'descriptions' => $this->footerDescriptionRepository->affichage("Parchemins De Sagesse"),
        ]);
    }


    /**
     * @Route("/parchemins/vitalite", name="vitalite")
     * ▬▬▬▬ Parchemin Vitalité ▬▬▬▬
     * @return Response
     */
    public function vitalite(): Response
    {
        $Donnees = array(
            'Categorie'    => array(

                'bloc 1'    => array(
                    'nom'       => 'Vitalité < 10',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Pain doré',
                            ),
                        ),
                    ),
                ),


                'bloc 2'    => array(
                    'nom'       => 'Vitalité < 20',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Briochette magique',
                            ),
                        ),
                    ),
                ),


                'bloc 3'    => array(
                    'nom'       => 'Vitalité < 25',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => '[12,5]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '100 Défenses de sangliers',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[4,5]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '100 Gelées bleutées',
                            ),
                        ),

                        'ligne 3' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde rousse-amande',
                                'recette 2'    => 'Dinde rousse-indigo',
                                'recette 3'    => 'Dinde rousse-ébène',
                            ),
                        ),
                    ),
                ),


                'bloc 4'    => array(
                    'nom'       => 'Vitalité < 30',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Pain consistant magique',
                            ),
                        ),
                    ),
                ),

                'bloc 5'    => array(
                    'nom'       => 'Vitalité < 40',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Pain de seigle résistant',
                            ),
                        ),
                    ),
                ),


                'bloc 6'    => array(
                    'nom'       => 'Vitalité < 50',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => '[3,-1]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '80 Gelées bleutées',
                                'recette 2'    => '30 Gelées menthes',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde amande-orchidée',
                            ),
                        ),
                    ),
                ),


                'bloc 7'    => array(
                    'nom'       => 'Vitalité < 70',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => 'Food',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => "Pain aux flocons d'avoine aurifère",
                            ),
                        ),
                    ),
                ),


                'bloc 8'    => array(
                    'nom'       => 'Vitalité < 80',
                    'lignes' => array(
                        'ligne 1' => array(
                            'position'  => '[3,1]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '60 Gelées bleutées',
                                'recette 2'    => '20 Gelées menthes',
                                'recette 3'    => '25 Gelées fraises',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde amande-turquoise',
                                'recette 2'    => 'Dinde rousse-ivoire',
                            ),
                        ),
                    ),
                ),


                'bloc 9'    => array(
                    'nom'       => 'Vitalité < 100',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => '[0,-2]',
                            'bonus'     => '+2',
                            'recettes'  => array(
                                'recette 1'    => '60 Gelées bleutées',
                                'recette 2'    => '25 Gelées menthes',
                                'recette 3'    => '30 Gelées fraises',
                                'recette 4'    => '1 Gelée bleutée royale',
                                'recette 5'    => '1 Gelée fraise royale',
                            ),
                        ),

                        'ligne 2' => array(
                            'position'  => '[5,-6]',
                            'bonus'     => '+2',
                            'recettes'  => array(
                                'recette 1'    => 'Dinde rousse-emeraude',
                                'recette 2'    => 'Dinde Rousse-prune',

                            ),
                        ),
                    ),
                ),

            ),
        );

        return $this->render('Parchemins/Vitalite/vitalite.html.twig', [
            'title' => "Parchemins de Vitalité",
            'image' => 'vitalite',
            'donnees' => $Donnees,
            'tutos' => $this->donjonsCardsDoubleRepository->affichage("Parchemin de Vitalité"),
            'descriptions' => $this->footerDescriptionRepository->affichage("Parchemins De Vitalité"),
        ]);
    }


    /**
     * @Route("/parchemins/sorts", name="sorts")
     * ▬▬▬▬ Parchemin Sorts ▬▬▬▬
     * @return Response
     */
    public function sorts(): Response
    {
        $Donnees = array(
            'Categorie'    => array(

                'bloc 1'    => array(
                    'nom'       => 'Infini',
                    'lignes' => array(

                        'ligne 1' => array(
                            'position'  => '[2,0]',
                            'bonus'     => '+1',
                            'recettes'  => array(
                                'recette 1'    => '5 Diamants polis',
                            ),
                        ),
                    ),
                ),
            ),
        );

        return $this->render('Parchemins/Sorts/sorts.html.twig', [
            'title' => "Parchemins de Sorts",
            'image' => 'vitalite',
            'donnees' => $Donnees,
            'tutos' => $this->donjonsCardsDoubleRepository->affichage("Parchemin de Sorts"),
            'descriptions' => $this->footerDescriptionRepository->affichage("Parchemins De Sorts"),
        ]);
    }

}
