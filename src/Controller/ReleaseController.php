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
            
            $userARelease = $discographyRepository->verifieSiUserADejaLeRelease($userId, $releaseId);

            if (empty($userARelease)) { // L'utilisateur n'a pas encore ajouté la release à sa discographie
                $discographyRepository->ajouterReleaseAUser($userId, $releaseId);
            }

        }
        $user = $this->getUser();

        if ($user) {
            return $this->render('release/index.html.twig', [
                'reponse' => $response,
                'image' => $discogsApi->getReleaseImg($response['title'], $year, $idRelease),
                'userID' => $user->getId(),
            ]);
        } else {
            return $this->render('release/index.html.twig', [
                'reponse' => $response,
                'image' => $discogsApi->getReleaseImg($response['title'], $year, $idRelease),
            ]);
        }
    }
}
