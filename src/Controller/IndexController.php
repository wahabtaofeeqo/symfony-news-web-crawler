<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $articles = [1,2,3,4,5];
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'articles' => $articles
        ]);
    }
}
