<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DictionnaireController extends AbstractController
{
    #[Route('/dictionnaire', name: 'dictionnaire')]
    public function index(): Response
    {
        return $this->render('dictionnaire/index.html.twig', [
            'controller_name' => 'DictionnaireController',
        ]);
    }
}
