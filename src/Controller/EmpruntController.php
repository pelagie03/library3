<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Form\EmpruntType;
use App\Repository\EmpruntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmpruntController extends AbstractController
{
    #[Route('/adherent', name: 'emprunt')]
    public function emprunter(Request $request): Response
    {
        $emprunt = new Emprunt();
        $form = $this->createForm(EmpruntType::class, $emprunt);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($emprunt); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

            return $this->redirectToRoute('emprunt');
        }

        return $this->render('adherent/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/livres', name: 'empList', methods: 'GET')]
    public function listEmp(EmpruntRepository $empRepository): Response
    {
        return $this->render('emprunt/index.html.twig', ['adherent' => $empRepository->findAll()]);
    }

    #[Route('/{id}/adherent', name: 'emp_edit', methods: 'GET|POST')]
    public function prolongerDate(Request $request, Emprunt $emp): Response
    {
        $form = $this->createForm(EmpruntType::class, $emp);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emp_edit', ['id' => $emp->getId()]);
        }

        return $this->render('adherent/index.html.twig', [
            'emprunt' => $emp,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'emp_del', methods: 'DELETE')]
    public function delete(Request $request, Emprunt $emprunt): Response
    {
        if (!$this->isCsrfTokenValid('delete' . $emprunt->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('livres');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($emprunt);
        $em->flush();

        return $this->redirectToRoute('livres');
    }
}
