<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\DiscogsApi;
use App\Repository\DiscographyRepository;

class ReleaseController extends AbstractController
{
    #[Route('/release/{idRelease}', name: 'app_release')]
    public function index(int $idRelease, DiscogsApi $discogsApi, DiscographyRepository $discographyRepository, Request $request): Response
    {

        $response = $discogsApi->getDatas($idRelease);
        $year = $response['released_formatted'];

        if ($request->isMethod('POST')) {

            $userId = $this->getUser()->getId();

            $releaseId = $idRelease;

            $discographyRepository->ajouterReleaseAUser($userId, $releaseId);

        }

        return $this->render('release/index.html.twig', [
            'reponse' => $response,
            'image' => $discogsApi->getReleaseImg($response['title'], $year, $idRelease),
        ]);
    }
}
