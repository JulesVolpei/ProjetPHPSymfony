<?php 
namespace App\Service;

use App\Entity\Fruit;
use Symfony\Component\HttpClient\HttpClient;

class DiscogsApi
{
    public function getListByFruit(Fruit $fruit) : array {
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

    public function getDatas(int $idRelease) : array {
        $client = HttpClient::create();
                
        $response = json_decode($client->request(
            'GET',
            'https://api.discogs.com/releases/'.$idRelease
        )->getContent(),true);
                
        return $response;
    }
}