<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\DiscogsApi;

class ReleaseController extends AbstractController
{
    #[Route('/release/{idRelease}', name: 'app_release')]
    public function index(int $idRelease, DiscogsApi $discogsApi): Response
    {
        return $this->render('release/index.html.twig', [
            'reponse' => $discogsApi->getDatas($idRelease),
        ]);
    }

}
