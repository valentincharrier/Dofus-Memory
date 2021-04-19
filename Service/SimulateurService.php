<?php


namespace App\Service;


class SimulateurService
{
    /**
     * ▬▬▬▬ addRessourcesADropper() ▬▬▬▬ Add ou Upd une ressources
     * @param object $ressource
     * @param int $taille
     * @param array $ressourcesADropper
     * @return array
     */
    public function addRessourcesADropper(object $ressource, int $taille, array $ressourcesADropper)
    {
        if(!empty($ressourcesADropper)){
            $i=0;
            foreach ($ressourcesADropper as $ressourceADropper){
                if($ressource->getImage()->getNom() === $ressourceADropper['ressource']){
                    $ressourcesADropper[$i]['quantite'] += $ressource->getQuantite() * $taille;
                    return $ressourcesADropper;
                }
                $i++;
            }
        }

        $array = [
            'ressource' => $ressource->getImage()->getNom(),
            'quantite' => $ressource->getQuantite() * $taille,
            'image' => $ressource->getImage()->getImage()
        ];
        array_push($ressourcesADropper, $array);
        return $ressourcesADropper;
    }
}