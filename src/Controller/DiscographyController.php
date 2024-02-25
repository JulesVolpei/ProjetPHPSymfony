<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DiscographyRepository;
use App\Repository\UserRepository;
use App\Service\DiscogsApi;


class DiscographyController extends AbstractController
{
    #[Route('/{idUtilisateur}/discography/page-{page}', name: 'app_discography')]
    public function index(DiscographyRepository $disco, mixed $idUtilisateur = null, DiscogsApi $discogsApi, int $page = 1): Response
    {
        $user = $this->getUser();
        $indicePage = $page - 1;
        
        
        $userDiscography = $disco->trouverLesReleases($user->getId()); // Passer qu'un array avec entre les deux coeffs
        $arrayIDRelease = array_chunk($userDiscography, 10); // Divise le tableau en dix sous tableau

        $userReleases = $discogsApi->getDatasAvecPlusieursReleases($arrayIDRelease[$indicePage]); // Passe le indicePage-ième sous tableau

        $testImage = [];
        $cmpt = 0;
        foreach ($userReleases as $userRelease) {
            $testImage[$cmpt] = $discogsApi->getReleaseImg($userRelease["title"], $userRelease["year"], $userRelease["id"]);
            $cmpt += 1;
        }

        return $this->render('discography/index.html.twig', [
            'controller_name' => 'DiscographyController',
            'utilisateur' => $user->getUserIdentifier(),
            'reponse' => $userReleases,
            'pagination' => $userReleases,
            'userID' => $user->getId(),
            'testImage'=> $testImage,
        ]);
    }
}
