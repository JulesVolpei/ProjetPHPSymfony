<?php

namespace App\Controller;

use App\Entity\Fruit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpClient\HttpClient;
use Doctrine\ORM\EntityManagerInterface;

class ListQueryController extends AbstractController
{
    #[Route('/list_query', name: 'app_list_query')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $idFruit = $_GET['id_fruit'];
        $fruit = new Fruit($idFruit,$entityManager);
        return $this->render('list_query/index.html.twig', [
            'reponse' => $this->getListByName($fruit),
        ]);
    }

    protected function getListByName(Fruit $fruit) : mixed {
        $client = HttpClient::create();
        $client = $client->withOptions([
            'headers' => [
                'Authorization' => 'Discogs key="wngrIEFFNrZUEouixDyS", secret="zvlGcAFBaRffmCfKNbNiAvEWLxqQBzQR"',
                'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36'
            ],
        ]);
        $translations = $fruit->getTranslations();
        $responses = [];
        foreach ($translations as $query){
            $responses = array_merge($responses, json_decode($client->request(
                'GET',
                'https://api.discogs.com/database/search?release_title='.$query.'&artist='.$query.'&per_page=5&page=1'
            )->getContent(),true)['results']);
        }
        
        return $responses;
    }
}
