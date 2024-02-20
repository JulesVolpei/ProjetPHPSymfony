<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpClient\HttpClient;

class ReleaseController extends AbstractController
{
    #[Route('/release/{idRelease}', name: 'app_release')]
    public function index(int $idRelease): Response
    {
        

        return $this->render('release/index.html.twig', [
            'reponse' => $this->getDatas($idRelease),
        ]);
    }

    protected function getDatas(int $idRelease) : mixed {
        $client = HttpClient::create();
                
        $response = json_decode($client->request(
            'GET',
            'https://api.discogs.com/releases/'.$idRelease
        )->getContent(),true);
                
        return $response;
    }
}
