<?php

namespace App\Controller\Admin\Agence;

use App\Entity\Agence;
use App\Form\AgenceFormType;
use App\Repository\AgenceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/agence')]
class AgenceController extends AbstractController
{
    #[Route('/', name: 'admin.agence.index', methods: ['GET'])]
    public function index(AgenceRepository $agenceRepository): Response
    {
        return $this->render('pages/admin/agence/index.html.twig', [
            'agences' => $agenceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin.agence.new', methods: ['GET', 'POST'])]
    public function new(Request $request, AgenceRepository $agenceRepository): Response
    {
        $agence = new Agence();
        $form = $this->createForm(AgenceFormType::class, $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $agenceRepository->save($agence, true);

            $this->addFlash('success', "L'agence a été ajoutée avec succès.");
            return $this->redirectToRoute('admin.agence.index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('pages/admin/agence/new.html.twig', [
            'agence' => $agence,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'admin.agence.show', methods: ['GET'])]
    public function show(Agence $agence): Response
    {
        return $this->render('pages/admin/agence/show.html.twig', [
            'agence' => $agence,
        ]);
    }
    
    #[Route('/{id}/edit', name: 'admin.agence.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Agence $agence, AgenceRepository $agenceRepository): Response
    {
        $form = $this->createForm(AgenceFormType::class, $agence);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $agenceRepository->save($agence, true);

            $this->addFlash('success', "L'agence a été modifiée avec succès.");
            return $this->redirectToRoute('admin.agence.index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('pages/admin/agence/edit.html.twig', [
            'agence' => $agence,
            'form' => $form,
        ]);
    }
    
    #[Route('/{id}', name: 'admin.agence.delete', methods: ['POST'])]
    public function delete(Request $request, Agence $agence, AgenceRepository $agenceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agence->getId(), $request->request->get('_token'))) {
            $agenceRepository->remove($agence, true);

            $this->addFlash('success', "L'agence a été supprimée avec succès.");
        }

        return $this->redirectToRoute('admin.agence.index', [], Response::HTTP_SEE_OTHER);
    }
}
