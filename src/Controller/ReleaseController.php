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
        // Récupérez les données de l'API Discogs
        $response = $discogsApi->getDatas($idRelease);
        $year = $response['released_formatted'];

        // Vérifiez si le formulaire a été soumis
        if ($request->isMethod('POST')) {
            // Récupérez l'ID de l'utilisateur connecté
            $userId = $this->getUser()->getId();

            // Récupérez l'ID de la release à ajouter
            $releaseId = $idRelease;

            // Ajoutez un disque en appelant la méthode du repository
            $discographyRepository->ajouterReleaseAUser($userId, $releaseId);

            // Redirigez l'utilisateur vers une autre page après l'ajout
        }

        // Affichez la page avec les données de l'API Discogs
        return $this->render('release/index.html.twig', [
            'reponse' => $response,
            'image' => $discogsApi->getReleaseImg($response['title'], $year, $idRelease),
        ]);
    }
}
