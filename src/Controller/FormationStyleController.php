<?php

namespace App\Controller;

use App\Entity\FormationStyle;
use App\Form\FormationStyleType;
use App\Repository\FormationStyleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/style")
 */
class FormationStyleController extends AbstractController
{
    /**
     * @Route("/", name="formation_style_index", methods={"GET"})
     */
    public function index(FormationStyleRepository $formationStyleRepository): Response
    {
        return $this->render('formation_style/index.html.twig', [
            'formation_styles' => $formationStyleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="formation_style_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formationStyle = new FormationStyle();
        $form = $this->createForm(FormationStyleType::class, $formationStyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formationStyle);
            $entityManager->flush();

            return $this->redirectToRoute('formation_style_index');
        }

        return $this->render('formation_style/new.html.twig', [
            'formation_style' => $formationStyle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formation_style_show", methods={"GET"})
     */
    public function show(FormationStyle $formationStyle): Response
    {
        return $this->render('formation_style/show.html.twig', [
            'formation_style' => $formationStyle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="formation_style_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FormationStyle $formationStyle): Response
    {
        $form = $this->createForm(FormationStyleType::class, $formationStyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formation_style_index');
        }

        return $this->render('formation_style/edit.html.twig', [
            'formation_style' => $formationStyle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="formation_style_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FormationStyle $formationStyle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formationStyle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formationStyle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('formation_style_index');
    }
}
