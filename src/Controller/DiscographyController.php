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
    #[Route('/{idUtilisateur}/discography', name: 'app_discography')]
    public function index(DiscographyRepository $disco, mixed $idUtilisateur = null, DiscogsApi $discogsApi): Response
    {
        $user = $this->getUser();
        $userDiscography = $disco->trouverLesReleases($user->getId());
        $userReleases = $discogsApi->getDatasAvecPlusieursReleases($userDiscography);

        return $this->render('discography/index.html.twig', [
            'controller_name' => 'DiscographyController',
            'utilisateur' => $user->getUserIdentifier(),
            'utilisateurDisco'=> $userDiscography,
            'reponse' => $userReleases['results'],
            'pagination' => $userReleases['pagination'],
            'userID' => $user->getId(),
        ]);
    }
}
