<?php

namespace App\Controller;

use App\Entity\Dictionnaire;
use App\Form\DictionnaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DictionnaireController extends AbstractController
{
    #[Route('/dictionnaire', name: 'dico')]
    public function ajoutDico(Request $request)
    {
        $dico = new Dictionnaire();
        $form = $this->createForm(DictionnaireType::class, $dico);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($dico); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

            return new Response('SUCCES!!!');
        }

        return $this->render('dictionnaire/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
