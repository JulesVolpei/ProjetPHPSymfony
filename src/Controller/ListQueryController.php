<?php

namespace App\Controller;

use App\Entity\Fruit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\Exception\ServerException;

class ListQueryController extends AbstractController
{
    #[Route('/list_query', name: 'app_list_query')]
    public function index(): Response
    {
        $fruit = new Fruit();
        return $this->render('list_query/index.html.twig', [
            'reponse' => $this->getListByName($fruit),
        ]);
    }

    protected function getListByName(Fruit $fruit) : String {
        $client = HttpClient::create();
        $client = $client->withOptions([
            'headers' => [
                'Authorization' => 'Discogs key="wngrIEFFNrZUEouixDyS", secret="wngrIEFFNrZUEouixDyS"',
                'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36'
            ],
            'config' => []
        ]);
        try {
            $response = $client->request(
                'GET',
                'https://api.discogs.com/database/search?release_title=nevermind&artist=nirvana&per_page=3&page=1'
            );
        } catch (ServerException $th) {
            dd($response);   
        }
        
        return json_decode('');
    }
}
