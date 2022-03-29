<?php

namespace App\Controller;

use App\Repository\ProfRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfController extends AbstractController
{
    /**
     * @Route("/profs", name="app_profs")
     */
    public function liste(ProfRepository $pr): Response
    {
        return $this->render('prof/profs.html.twig', [
            'profs' => $pr->findAll()
        ]);
    }
}
