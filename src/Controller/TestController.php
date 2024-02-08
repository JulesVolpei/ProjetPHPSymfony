<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController
{
    #[Route(path:"/test", name:"Test")]
    public function number(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body> Test Lucky number: '.$number.'</body></html>'
        );
    }
}