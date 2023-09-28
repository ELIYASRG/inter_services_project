<?php

namespace App\Controller\Admin\Home;

use App\Entity\Envoi;
use App\Form\EnvoiFormType;
use App\Repository\EnvoiRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/admin/home', name: 'admin.home.index')]
    public function sending(Request $request, EnvoiRepository $envoiRepository, ManagerRegistry $doctrine): Response
    {
        $envoi = new Envoi();
        $form = $this->createForm(EnvoiFormType::class, $envoi);
        
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() )
        {

            $envoi->setUser($this->getUser());
            
            $envoiRepository->save($envoi, true);
            $this->addFlash('success', "Votre envoi a été éffectué avec succès.");
            return $this->redirectToRoute('admin.home.index');
        }
        return $this->render('pages/admin/home/index.html.twig', [
            "form" => $form->createView()
        ]);
    }
}
