<?php

namespace App\Controller;

use App\Repository\TranslationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AjaxFruitListController extends AbstractController
{
    #[Route('/ajax/fruit_list/{input}', name: 'app_ajax_fruit_list')]
    public function index(TranslationRepository $translationRepository, string $input): Response
    {
        return $this->render('ajax_fruit_list/index.html.twig', [
            'fruitData' => $translationRepository->getListBySelectInput($input),
        ]);
    }
}
