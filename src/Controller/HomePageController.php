<?php

namespace App\Controller;

use App\Repository\BarreRechercheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\From\SearchTypeForm;
use App\Repository\FruitRepository;

class HomePageController extends AbstractController {
    #[Route('/', name: 'app_home_page')]
    public function index(Request $request, FruitRepository $fruitRepository): Response
    {
        $data = new BarreRechercheRepository();
        $barreRecherche = $this->createForm(SearchTypeForm::class, $data);


        $barreRecherche->handleRequest($request);

        if ($barreRecherche->isSubmitted() && $barreRecherche->isValid()) {
            $data->page = $request->query->get('page', 1);
            $fruit = $fruitRepository->findOneBySomeField($data);

            return $this->render('search_bar/index.html.twig', [
                'form' => $barreRecherche,
                'fruitCherche' => $fruit
            ]);
        }
        $params =  [
            'controller_name' => 'HomePageController',
            'menu' => [
                0 => [
                    'url' => '/discographie',
                    'name' => 'Discothèque',
                ],
                1 => [
                    'url' => '/nouveau-compte',
                    'name' => 'créer un compte',
                ],
            ],
            'form' => $barreRecherche->createView()
        ];
        
        return $this->render('home_page/index.html.twig', $params);
    }
}
