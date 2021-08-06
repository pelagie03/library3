<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Form\LivresType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivresController extends AbstractController
{
    #[Route('/livres', name: 'livres')]
    public function index(): Response
    {
        $livre = new Livres();
        $form = $this->createForm(LivresType::class, $livre);

        /*return $this->render('livres/index.html.twig', [
            'controller_name' => 'LivresController',
        ]);*/
        return $this->render('livres/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function ajoutLivre(Request $request): Response
    {
        $livre = new Livres();
        $form = $this->createForm(LivresType::class, $livre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($livre); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

            return new Response('SUCCES!!!');
        }

        return $this->render('livres/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
