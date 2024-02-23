<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\WebLink\Link;

class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            $params =  [
                'controller_name' => 'HomePageController',
                'menu' => [
                    0 => [
                        'url' => '/discographie',
                        'name' => 'Discographie',
                    ],
                    1 => [
                        'url' => '/nouveau-compte',
                        'name' => 'créer un compte',
                    ],
                ],
            ];
        } else {
            $userId = $user->getId();
            $params =  [
                'controller_name' => 'HomePageController',
                'menu' => [
                    0 => [
                        'url' => '/discographie',
                        'name' => 'Discographie',
                    ],
                    1 => [
                        'url' => '/nouveau-compte',
                        'name' => 'créer un compte',
                    ],
                ],
                'userID' => $userId,
            ];
        }

        return $this->render('home_page/index.html.twig', $params);
    }
}
