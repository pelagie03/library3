<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Form\EmpruntType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmpruntController extends AbstractController
{
    #[Route('/emprunt', name: 'emprunt')]
    public function index(): Response
    {

        $emprunt = new Emprunt();
        $form = $this->createForm(EmpruntType::class, $emprunt);
        return $this->render('adherent/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
    public function emprunter(Request $request): Response
    {
        $emprunt = new Emprunt();
        $form = $this->createForm(EmpruntType::class, $emprunt);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($emprunt); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

            return new Response('SUCCES!!!');
        }

        return $this->render('adherent/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
