<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RandomSpinController extends AbstractController
{
    #[Route('/random/spin', name: 'app_random_spin')]
    public function index(): Response
    {
        return $this->render('random_spin/index.html.twig', [
            'controller_name' => 'RandomSpinController',
        ]);
    }
}
