<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\Response;

class ResponseService
{
    /**
     * ▬▬▬▬ Response Json ▬▬▬▬ Instanciation d'une Response + Remplissage + Encodage Json
     * @param array $content
     * @return Response
     */
    public function responseJson(array $content){
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($content));
        return $response;
    }
}