<?php

namespace App\Controller;

use App\Entity\Incident;
use App\Form\IncidentType;
use App\Repository\IncidentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/incident")
 */
class IncidentController extends AbstractController
{
    /**
     * @Route("/", name="incident_index", methods={"GET"})
     */
    public function index(IncidentRepository $incidentRepository): Response
    {
        return $this->render('incident/index.html.twig', [
            'incidents' => $incidentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="incident_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $incident = new Incident();
        $form = $this->createForm(IncidentType::class, $incident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($incident);
            $entityManager->flush();

            return $this->redirectToRoute('incident_index');
        }

        return $this->render('incident/new.html.twig', [
            'incident' => $incident,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="incident_show", methods={"GET"})
     */
    public function show(Incident $incident): Response
    {
        return $this->render('incident/show.html.twig', [
            'incident' => $incident,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="incident_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Incident $incident): Response
    {
        $form = $this->createForm(IncidentType::class, $incident);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('incident_index');
        }

        return $this->render('incident/edit.html.twig', [
            'incident' => $incident,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="incident_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Incident $incident): Response
    {
        if ($this->isCsrfTokenValid('delete'.$incident->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($incident);
            $entityManager->flush();
        }

        return $this->redirectToRoute('incident_index');
    }
}
