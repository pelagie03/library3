<?php

namespace App\Controller;

use App\Entity\Bd;
use App\Form\BdType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BdController extends AbstractController
{
    #[Route('/bd', name: 'bd')]
    public function ajoutBd(Request $request)
    {
        $bd = new Bd();
        $form = $this->createForm(BdType::class, $bd);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager(); // On récupère l'entity manager
            $em->persist($bd); // On confie notre entité à l'entity manager (on persist l'entité)
            $em->flush(); // On execute la requete

            return new Response('SUCCES!!!');
        }

        return $this->render('bd/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
