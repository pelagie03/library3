<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Form\AdherentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdherentController extends AbstractController
{
    #[Route('/adherent', name: 'adherent')]
    public function index(): Response
    {
        return $this->render('adherent/index.html.twig', [
            'controller_name' => 'AdherentController',
        ]);
    }

    public function ajoutAdherent(Request $request)
    {
        $adh = new Adherent();
        $form = $this->createForm(AdherentType::class, $adh);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($adh); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

            return new Response('SUCCES!!!');
        }

        return $this->render('adherent/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
