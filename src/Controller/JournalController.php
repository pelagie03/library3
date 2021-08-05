<?php

namespace App\Controller;

use App\Entity\Document;
use App\Entity\Journal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JournalController extends AbstractController
{
    #[Route('/journal', name: 'journal')]
    public function index(): Response
    {
        return $this->render('journal/index.html.twig', [
            'controller_name' => 'JournalController',
        ]);
    }
    public function selectJournal()
    {
    }

    public function addJournal()
    {
        //not correct
        $document = new Document();
        $journal = new Journal();
        $journal->setNumParution(1);
        $document->setTitre('John');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($document);
        $entityManager->persist($journal);
        $entityManager->flush();
        return $this->render('journal/index.html.twig', [
            'controller_name' => 'JournalController',
            'journal' => $journal,
        ]);
    }
}
