<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Repository\MatiereRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

    /**
     * @Route("/matiere/create", name="app_matiere_create")
     */
    public function create(MatiereRepository $mr, Request $request)
    {
        $matiere = new Matiere;
        $formulaire = $this
            ->createFormBuilder($matiere)
            ->add('nom', TextType::class)
            ->add(
                'submit',
                SubmitType::class,
                ['label' => 'Envoyer']
            )
            ->getForm();
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $mr->add($matiere);
            return $this->redirectToRoute('app_matieres');
        } else return $this->render('matiere/create.html.twig', [
            'formView' => $formulaire->createView()
        ]);
    }

    /**
     * @Route("/matiere/{id}/delete", name="app_matiere_delete")
     */
    public function delete($id, MatiereRepository $mr): Response
    {
        $mr->remove($mr->find($id));

        return $this->redirectToRoute('app_matieres');
    }
}
