<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Form\AdherentType;
use App\Repository\AdherentRepository as RepositoryAdherentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdherentController extends AbstractController
{
    #[Route('/inscription', name: 'adh_ajout')]
    public function ajoutAdherent(Request $request): Response
    {
        $adh = new Adherent();
        $form = $this->createForm(AdherentType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($adh); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

            return $this->redirectToRoute('adhlist');
        }

        return $this->render('adherent/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/adherent', name: 'adhlist', methods: 'GET')]
    public function list(RepositoryAdherentRepository $adhRepository): Response
    {
        return $this->render('adherent/_tableau.html.twig', ['adherent' => $adhRepository->findAll()]);
    }

    #[Route('/{id}/inscription', name: 'adhEdit', methods: 'GET|POST')]
    public function edit(Request $request, Adherent $adherent): Response
    {
        $form = $this->createForm(AdherentType::class, $adherent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adhEdit', ['id' => $adherent->getId()]);
        }

        return $this->render('adherent/editAdh.html.twig', [
            'adherent' => $adherent,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'adh_del', methods: 'DELETE')]
    public function delete(Request $request, Adherent $adherent): Response
    {
        if (!$this->isCsrfTokenValid('delete' . $adherent->getId(), $request->request->get('_token'))) {
            return $this->redirectToRoute('adhList');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($adherent);
        $em->flush();

        return $this->redirectToRoute('adhList');
    }
}
