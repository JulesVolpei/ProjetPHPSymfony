<?php

namespace App\Controller;

use App\Entity\Fruit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\DiscogsApi;

class ListQueryController extends AbstractController
{
    #[Route('/list_query/{idFruit}', name: 'app_list_fruit')]
    public function fruitResult(EntityManagerInterface $entityManager, DiscogsApi $discogsApi, int $idFruit = null): Response
    {
        $fruit = new Fruit($idFruit,$entityManager);
        
        return $this->render('list_query/index.html.twig', [
            'reponse' => $discogsApi->getListByFruit($fruit),
        ]);
    }

    #[Route('/list_query', name: 'app_list_query', priority: 2)]
    public function index(): Response
    {
        return $this->render('list_query/index.html.twig', [
            'reponse' => [],
        ]);
    }
}
