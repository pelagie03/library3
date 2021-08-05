<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Form\AdherentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    public function add()
    {
        //à revoir
        $adh = new Adherent();
        $form = $this->createForm(AdherentType::class, $adh);
        return $this->render('adherent/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
