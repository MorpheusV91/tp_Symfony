<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    /**
     * @Route("/classes", name="app_classes")
     */
    public function liste(ClasseRepository $cr): Response
    {
        return $this->render('classe/classes.html.twig', [
            'classes' => $cr->findAll()
        ]);
    }
}
