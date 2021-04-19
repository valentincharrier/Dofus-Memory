<?php

namespace App\Controller;

use App\Entity\Equipements;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap", defaults={"_format"="xml"})
     */
    public function index(\Symfony\Component\HttpFoundation\Request $request): Response
    {
        // On récupère le nom d'hote depuis l'url
        $hostname = $request->getSchemeAndHttpHost();

        // On initialise un tableau  pour lister les URLs
        $urls = [];

        // On ajoute les urls statiquess
        $urls[] = ['loc' => $this->generateUrl('dofus')];
        $urls[] = ['loc' => $this->generateUrl('fantome-chacha')];
        $urls[] = ['loc' => $this->generateUrl('milimulou')];
        $urls[] = ['loc' => $this->generateUrl('tournesolAffame')];
        $urls[] = ['loc' => $this->generateUrl('mobLePonge')];
        $urls[] = ['loc' => $this->generateUrl('bouftouRoyal')];
        $urls[] = ['loc' => $this->generateUrl('chaferFantassin')];
        $urls[] = ['loc' => $this->generateUrl('batofu')];
        $urls[] = ['loc' => $this->generateUrl('coffreDesForgerons')];
        $urls[] = ['loc' => $this->generateUrl('scarabosseDore')];
        $urls[] = ['loc' => $this->generateUrl('shinLarve')];
        $urls[] = ['loc' => $this->generateUrl('sapik')];
        $urls[] = ['loc' => $this->generateUrl('blopGriotteRoyal')];
        $urls[] = ['loc' => $this->generateUrl('bulbig')];
        $urls[] = ['loc' => $this->generateUrl('corailleurMagistral')];
        $urls[] = ['loc' => $this->generateUrl('bworkette')];
        $urls[] = ['loc' => $this->generateUrl('chemin')];
        $urls[] = ['loc' => $this->generateUrl('waWabbit')];
        $urls[] = ['loc' => $this->generateUrl('chouque')];
        $urls[] = ['loc' => $this->generateUrl('craqueleurLegendaire')];
        $urls[] = ['loc' => $this->generateUrl('geleeRoyaleFraise')];
        $urls[] = ['loc' => $this->generateUrl('cheminDofusCawotte')];
        $urls[] = ['loc' => $this->generateUrl('dofusCawotte')];
        $urls[] = ['loc' => $this->generateUrl('gourloLeTerrible')];
        $urls[] = ['loc' => $this->generateUrl('ratBlanc')];
        $urls[] = ['loc' => $this->generateUrl('ratNoir')];
        $urls[] = ['loc' => $this->generateUrl('abraknydeAncestral')];
        $urls[] = ['loc' => $this->generateUrl('maitreCorbac')];
        $urls[] = ['loc' => $this->generateUrl('koulosse')];
        $urls[] = ['loc' => $this->generateUrl('meulou')];
        $urls[] = ['loc' => $this->generateUrl('tofuRoyal')];
        $urls[] = ['loc' => $this->generateUrl('moon2')];
        $urls[] = ['loc' => $this->generateUrl('tanukouiSan')];
        $urls[] = ['loc' => $this->generateUrl('rasboul')];
        $urls[] = ['loc' => $this->generateUrl('papaNowel')];
        $urls[] = ['loc' => $this->generateUrl('blopMulticolore')];
        $urls[] = ['loc' => $this->generateUrl('maitrePandore')];
        $urls[] = ['loc' => $this->generateUrl('skeunk')];
        $urls[] = ['loc' => $this->generateUrl('dragonCochon')];
        $urls[] = ['loc' => $this->generateUrl('darkvlad')];
        $urls[] = ['loc' => $this->generateUrl('minotoror')];
        $urls[] = ['loc' => $this->generateUrl('sphinterCell')];
        $urls[] = ['loc' => $this->generateUrl('pekiPeki')];
        $urls[] = ['loc' => $this->generateUrl('tynril')];
        $urls[] = ['loc' => $this->generateUrl('crocabulia')];
        $urls[] = ['loc' => $this->generateUrl('pereFwetar')];
        $urls[] = ['loc' => $this->generateUrl('cheneMou')];
        $urls[] = ['loc' => $this->generateUrl('kimbo')];
        $urls[] = ['loc' => $this->generateUrl('bworker')];
        $urls[] = ['loc' => $this->generateUrl('minotot')];
        $urls[] = ['loc' => $this->generateUrl('kralamourGeant')];
        $urls[] = ['loc' => $this->generateUrl('ougah')];
        $urls[] = ['loc' => $this->generateUrl('emotes')];
        $urls[] = ['loc' => $this->generateUrl('montrerSonArme')];
        $urls[] = ['loc' => $this->generateUrl('pierreFeuilleCiseaux')];
        $urls[] = ['loc' => $this->generateUrl('pointerDuDoigt')];
        $urls[] = ['loc' => $this->generateUrl('sallonger')];
        $urls[] = ['loc' => $this->generateUrl('saluer')];
        $urls[] = ['loc' => $this->generateUrl('sasseoir')];
        $urls[] = ['loc' => $this->generateUrl('ventDePanique')];
        $urls[] = ['loc' => $this->generateUrl('eternelleMoisson')];
        $urls[] = ['loc' => $this->generateUrl('familiers')];
        $urls[] = ['loc' => $this->generateUrl('forgemagie')];
        $urls[] = ['loc' => $this->generateUrl('forgemagiePoidsDesRunes')];
        $urls[] = ['loc' => $this->generateUrl('home')];
        $urls[] = ['loc' => $this->generateUrl('liste_donjons')];
        $urls[] = ['loc' => $this->generateUrl('mention_legales')];
        $urls[] = ['loc' => $this->generateUrl('parchemins')];
        $urls[] = ['loc' => $this->generateUrl('chance')];
        $urls[] = ['loc' => $this->generateUrl('agilite')];
        $urls[] = ['loc' => $this->generateUrl('force')];
        $urls[] = ['loc' => $this->generateUrl('intelligence')];
        $urls[] = ['loc' => $this->generateUrl('sagesse')];
        $urls[] = ['loc' => $this->generateUrl('vitalite')];
        $urls[] = ['loc' => $this->generateUrl('sorts')];
        $urls[] = ['loc' => $this->generateUrl('simulateurs')];
        $urls[] = ['loc' => $this->generateUrl('simulateursCoupsCritique')];
        $urls[] = ['loc' => $this->generateUrl('simulateursExperiences')];
        $urls[] = ['loc' => $this->generateUrl('simulateursParchemins')];


        // Fabrication de la réponse
        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
               'urls' => $urls,
                'hostname' => $hostname
            ]),
            200
        );

        // Ajout des entêtes HTTP
        $response->headers->set('Content-Type', 'text/xml');

        // On envoie la réponse
        return $response;
    }
}
