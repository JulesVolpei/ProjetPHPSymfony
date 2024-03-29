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
                'Authorization' => 'Discogs key=' . $_ENV["DISCOG_KEY"] . ', secret=' . $_ENV["DISCOG_SECRET"],
                'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36'
            ],
        ]);
        $translations = $fruit->getTranslations();
        $responses['fruitLabel'] = $translations[1];
        $responses = [];
        $responses = json_decode($client->request(
                'GET',
                'https://api.discogs.com/database/search?type=release&q='. implode('||',$translations).'&per_page=10&page='. $page
            )->getContent(),true);
        $responses['results'] = $this->sortByPopularity($responses['results']);
        $responses['titre'] = $translations[1];
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

    public function getDatasAvecPlusieursReleases(array $idReleases) : array {
        $client = HttpClient::create();
        $client = $client->withOptions([
            'headers' => [
                'Authorization' => 'Discogs key=' . $_ENV["DISCOG_KEY"] . ', secret=' . $_ENV["DISCOG_SECRET"],
                'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36'
            ],
        ]);
        $responses = [];
        foreach ($idReleases as $release) {
            $response = json_decode($client->request(
                'GET',
                'https://api.discogs.com/releases/' . $release['idRelease']
            )->getContent(), true);
    
            $responses[] = $response;
        }     
        return $responses;
    }

    public function getReleaseImg(string $titleRelease, string $year, int $idRelease) : string {
        $client = HttpClient::create();
        $client = $client->withOptions([
            'headers' => [
                'Authorization' => 'Discogs key=' . $_ENV["DISCOG_KEY"] . ', secret=' . $_ENV["DISCOG_SECRET"],
                'User-Agent' =>  'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36'
            ],
        ]); 
        $response = json_decode($client->request(
            'GET',
            'https://api.discogs.com/database/search?type=release&release_title='.$titleRelease.'&year='.$year
        )->getContent(),true)['results'];
        $imageUrl = '';

        foreach($response as $release){
            if ($release['id'] == $idRelease){
                $imageUrl = $release['cover_image'];
            }
        }
                
        return $imageUrl;
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