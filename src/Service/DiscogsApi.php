<?php 
namespace App\Service;

use App\Entity\Fruit;
use Symfony\Component\HttpClient\HttpClient;

class DiscogsApi
{
    public function getListByFruit(Fruit $fruit, int $page) : array {
        $client = HttpClient::create();
        $client = $client->withOptions([
            'headers' => [
                'Authorization' => 'Discogs key="wngrIEFFNrZUEouixDyS", secret="zvlGcAFBaRffmCfKNbNiAvEWLxqQBzQR"',
                'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36'
            ],
        ]);
        $translations = $fruit->getTranslations();
        $responses = [];
        $responses = json_decode($client->request(
                'GET',
                'https://api.discogs.com/database/search?type=release&q='. implode('||',$translations).'&per_page=10&page='. $page
            )->getContent(),true);
        $responses['results'] = $this->sortByPopularity($responses['results']);
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

    private function compareScore($a, $b) {
        if ($a['score'] == $b['score']) {
            return 0;
        }
        return ($a['score'] < $b['score']) ? 1 : -1;
    }

    private function sortByPopularity(array $responses) : array {
        foreach ($responses as &$release) {
            $release['score'] = $release['community']['want'] + $release['community']['have']*2;
        }
        usort($responses, [$this::class,'compareScore']);
        return $responses;
    }

    
}