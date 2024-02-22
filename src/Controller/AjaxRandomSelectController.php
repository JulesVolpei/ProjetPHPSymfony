<?php

namespace App\Controller;

use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AjaxRandomSelectController extends AbstractController
{
    #[Route('/ajax/random_select', name: 'app_ajax_random_select')]
    public function index(FruitRepository $fruitRepository): Response
    {
        return new Response($fruitRepository->getRandomFruit());
    }
}
