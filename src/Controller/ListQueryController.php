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
    #[Route('/list_query/{idFruit}/page-{page}', name: 'app_list_fruit')]
    public function fruitResult(EntityManagerInterface $entityManager, DiscogsApi $discogsApi, mixed $idFruit = null, int $page = 1): Response
    {
        
        if ($idFruit < 1 || !is_int($page)) {
            $idFruit = 1;
        }
        $fruit = new Fruit($idFruit,$entityManager);
        $maxPage = intval($this->getVarsForListing($discogsApi,$fruit,1)['pagination']['pages']);

        
        
        if ($page < 1 || !is_int($page)) {
            $page = 1;
        }
        if ($page > $maxPage) {
            $page = $maxPage;
        }
        return $this->render('list_query/index.html.twig',$this->getVarsForListing($discogsApi,$fruit,$page));
    }

    #[Route('/list_query', name: 'app_list_query', priority: 2)]
    public function index(): Response
    {
        return $this->render('list_query/index.html.twig', [
            'reponse' => [],
        ]);
    }

    private function getVarsForListing(DiscogsApi $discogsApi, Fruit $fruit, int $page) : array {
        $vars = $discogsApi->getListByFruit($fruit,$page);
        return [
            'reponse' => $vars['results'],
            'pagination' => $vars['pagination'],
            'titre' => $vars['titre'],
            'fruit' => $fruit->getId(),
        ];
    }
}
