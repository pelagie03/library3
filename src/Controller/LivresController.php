<?php

namespace App\Controller;

use App\Entity\Livres;
use App\Form\LivresType;
use App\Repository\LivresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivresController extends AbstractController
{
    #[Route('/livres', name: 'livres', methods: 'GET|POST')]
    public function ajoutLivre(Request $request): Response
    {
        $livre = new Livres();
        $form = $this->createForm(LivresType::class, $livre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($livre); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

            return $this->redirectToRoute('livres');
        }

        return $this->render('livres/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/livres', name: 'livreList', methods: 'GET')]
    public function list(LivresRepository $livRepository): Response
    {
        return $this->render('livres/tabLiv.html.twig', ['adherent' => $livRepository->findAll()]);
    }

    #[Route('/{id}/livres', name: 'livEdit', methods: 'GET|POST')]
    public function editLiv(Request $request, Livres $livre): Response
    {
        $form = $this->createForm(LivresType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livEdit', ['id' => $livre->getId()]);
        }

        return $this->render('livres/index.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'liv_del', methods: 'DELETE')]
    public function delete(Request $request, Livres $liv): Response
    {
        if (!$this->isCsrfTokenValid('delete' . $liv->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('livres');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($liv);
        $em->flush();

        return $this->redirectToRoute('livres');
    }

    /*public function index(): Response
    {
        $livre = new Livres();
        $form = $this->createForm(LivresType::class, $livre);

        return $this->render('livres/index.html.twig', [
            'form' => $form->createView()
        ]);
    } */
}
