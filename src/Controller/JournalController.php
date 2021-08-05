<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Journal;
use App\Form\JournalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JournalController extends AbstractController
{
    #[Route('/journal', name: 'journal')]
    public function index(): Response
    {
        return $this->render('document/index.html.twig', [
            'controller_name' => 'JournalController',
        ]);
    }
    public function ajoutJournal(Request $request)
    {
        $journal = new Journal();
        $form = $this->createForm(JournalType::class, $journal);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($journal); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

            return new Response('SUCCES!!!');
        }

        return $this->render('document/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
