<?php

namespace App\Controller;

use App\Entity\DiscographyInfos;
use App\Repository\DiscographyInfosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\DiscogsApi;
use App\Repository\DiscographyRepository;

class ReleaseController extends AbstractController
{
    #[Route('/release/{idRelease}', name: 'app_release')]
    public function index(int $idRelease, DiscogsApi $discogsApi, DiscographyRepository $discographyRepository, Request $request, DiscographyInfosRepository $discographyInfos): Response
    {

        $response = $discogsApi->getDatas($idRelease);
        if (array_key_exists('released_formatted', $response)) {
            $year = $response['released_formatted'];
        } else {
            $year = "Pas précisé";
        }
        $image = $discogsApi->getReleaseImg($response['title'], $year, $idRelease);

        if ($request->isMethod('POST')) {

            $userId = $this->getUser()->getId();

            $releaseId = $idRelease;
            
            $userARelease = $discographyRepository->verifieSiUserADejaLeRelease($userId, $releaseId);

            if (empty($userARelease)) { // L'utilisateur n'a pas encore ajouté la release à sa discographie
                $discographyRepository->ajouterReleaseAUser($userId, $releaseId);
                // On ajoute en plus les informations liées à la release
                $discographyInfos->ajouteInfosDiscographie($idRelease, $response['title'], $image);
            }

        }
        $user = $this->getUser();

        if ($user) {
            return $this->render('release/index.html.twig', [
                'reponse' => $response,
                'image' => $image,
                'userID' => $user->getId(),
            ]);
        } else {
            return $this->render('release/index.html.twig', [
                'reponse' => $response,
                'image' => $image,
            ]);
        }
    }
}
