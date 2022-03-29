<?php

namespace App\Controller;

use App\Repository\EleveRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EleveController extends AbstractController
{
    /**
     * @Route("/eleves", name="app_eleves")
     */
    public function liste(EleveRepository $er): Response
    {
        return $this->render('eleve/eleves.html.twig', [
            'eleves' => $er->findAll()
        ]);
    }
}
