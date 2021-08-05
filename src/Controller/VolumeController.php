<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VolumeController extends AbstractController
{
    #[Route('/volume', name: 'volume')]
    public function index(): Response
    {
        return $this->render('document/index.html.twig', [
            'controller_name' => 'VolumeController',
        ]);
    }
}
