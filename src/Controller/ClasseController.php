<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

    /**
     * @Route("/classe/create", name="app_classe_create")
     */
    public function create(ClasseRepository $cr, Request $request)
    {
        $classe = new Classe;
        $formulaire = $this
            ->createFormBuilder($classe)
            ->add('nom', TextType::class)
            ->add('niveau', TextType::class)
            ->add('prof', TextType::class)
            ->add(
                'submit',
                SubmitType::class,
                ['label' => 'Envoyer']
            )
            ->getForm();
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $cr->add($classe);
            return $this->redirectToRoute('classe/classes.html.twig');
        } else return $this->render('classe/create.html.twig', [
            'formView' => $formulaire->createView()
        ]);
    }
}
