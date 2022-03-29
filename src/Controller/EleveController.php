<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Repository\EleveRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

    /**
     * @Route("/eleve/create", name="app_eleve_create")
     */
    public function create(EleveRepository $er, Request $request)
    {
        $eleve = new Eleve;
        $formulaire = $this
            ->createFormBuilder($eleve)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('date_de_naissance', DateType::class)
            ->add('classe', TextType::class)
            ->add(
                'submit',
                SubmitType::class,
                ['label' => 'Envoyer']
            )
            ->getForm();
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $er->add($eleve);
            return $this->redirectToRoute('app_eleves');
        } else return $this->render('eleve/create.html.twig', [
            'formView' => $formulaire->createView()
        ]);
    }
}
