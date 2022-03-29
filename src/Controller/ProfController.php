<?php

namespace App\Controller;

use App\Entity\Prof;
use App\Repository\ProfRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

    /**
     * @Route("/prof/create", name="app_prof_create")
     */
    public function create(ProfRepository $cr, Request $request)
    {
        $prof = new Prof;
        $formulaire = $this
            ->createFormBuilder($prof)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('date_de_naissance', DateType::class)
            ->add('matiere', TextType::class)
            ->add(
                'submit',
                SubmitType::class,
                ['label' => 'Envoyer']
            )
            ->getForm();
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $cr->add($prof);
            return $this->redirectToRoute('app_profs');
        } else return $this->render('prof/create.html.twig', [
            'formView' => $formulaire->createView()
        ]);
    }

    /**
     * @Route("/prof/{id}/delete", name="app_prof_delete")
     */
    public function delete($id, ProfRepository $pr): Response
    {
        $pr->remove($pr->find($id));

        return $this->redirectToRoute('app_profs');
    }
}
