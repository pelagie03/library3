<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Form\LivresType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivresController extends AbstractController
{
    #[Route('/livres', name: 'livres')]
    public function index(): Response
    {
        return $this->render('livres/index.html.twig', [
            'controller_name' => 'LivresController',
        ]);
    }

    public function ajoutLivre()
    {
        $livre = new Livres();
        $form = $this->createForm(LivresType::class, $livre);

        return $this->render('livres/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
