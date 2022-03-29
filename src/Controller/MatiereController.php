<?php

namespace App\Controller;

use App\Repository\MatiereRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatiereController extends AbstractController
{
    /**
     * @Route("/matieres", name="app_matieres")
     */
    public function liste(MatiereRepository $mr): Response
    {
        return $this->render('matiere/matieres.html.twig', [
            'matieres' => $mr->findAll()
        ]);
    }
}
