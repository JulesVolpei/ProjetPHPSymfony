<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DiscographyRepository;
use App\Repository\UserRepository;

class DiscographyController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/{idUtilisateur}/discography', name: 'app_discography')]
    public function index(DiscographyRepository $disco, mixed $idUtilisateur = null): Response
    {
        $user = $this->entityManager->getRepository(User::class)->find($idUtilisateur);
        $userDiscography = $disco->trouverLesReleases($user->getId());
        if (! $userDiscography) {
            $userDiscography = "Rien maintenant"; // À changer quand un user pourra ajouter en BD un idRelease
        } else {
            $userDiscography = "ÇA MARCHE !"; // À changer quand un user pourra ajouter en BD un idRelease
        }
        return $this->render('discography/index.html.twig', [
            'controller_name' => 'DiscographyController',
            'utilisateur' => $user->getUsername(),
            'utilisateurDisco'=> $userDiscography,
        ]);
    }
}
