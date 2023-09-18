<?php

namespace App\Controller\Visitor\Registration;

use App\Entity\User;
use App\Entity\Client;
use App\Form\ClientFormType;
use App\Service\SendEmailService;
use App\Repository\UserRepository;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'visitor.registration.register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager,
    TokenGeneratorInterface $tokenGenerator,
    SendEmailService $sendEmailService
    ): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('visitor.welcome.index'); 
        }

        
        $clientUser = new Client();
        $form = $this->createForm(ClientFormType::class, $clientUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $password_hashed = $userPasswordHasher->hashPassword($clientUser,$form->get('password')->getData());
            $clientUser->setPassword($password_hashed);
            
            // Generate the token
            $token_generated = $tokenGenerator->generateToken();
            $clientUser->setTokenForEmailVerification($token_generated);

            // Generate the deadline for email validation
            $now = new \DateTimeImmutable('now');
            $expires_at = $now->add(new \DateInterval('P1D'));
            $clientUser->setExpiresAt($expires_at);

            // Insert new user into table "user" in the database
            $entityManager->persist($clientUser);
            $entityManager->flush();

            // dd($clientUser);
            // send an email to user
            $sendEmailService->send([
                "sender_email" => "interservicesvlg@gmail.com",
                "sender_name" => "Ahmed IS",
                "recipient_email" => $clientUser->getEmail(),
                "subject" => "Vérification de votre compte sur le site InterServices VLG",
                "html_template" => "email/email_verification.html.twig",
                "context" => [
                    "user_id" => $clientUser->getId(),
                    "token" => $clientUser->getTokenForEmailVerification(),
                    "expires_at" => $clientUser->getExpiresAt()->format('d/m/Y H:i:s'),
                ]
            ]);

            $this->addFlash('success', "Un email de confirmation vous a été envoyé. Cliquez sur le lien qui s'y trouve pour confirmer votre inscription.");

            return $this->redirectToRoute('visitor.authentication.login');
        }

        return $this->render('pages/visitor/registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    #[Route('/register/email-verif/{id<\d+>}/{token}', name: 'visitor.registration.email_verif')]
    public function emailVerif(Client $clientUser, string $token, ClientRepository $clientRepository) : Response
    {
        if ( ! $clientUser)
        {
            throw new AccessDeniedException();
        }
        
        if ( $clientUser->isIsVerified() )
        {
            $this->addFlash('success', 'Votre compte a déjà été vérifié! Veuillez vous connecter.');
            $this->redirectToRoute('visitor.authentication.login');
        }
        
        if ( empty($token) || empty($clientUser->getTokenForEmailVerification()) || ($token !== $clientUser->getTokenForEmailVerification()))
        {
            throw new AccessDeniedException();
        }
        
        if ( new \DateTimeImmutable('now') > $clientUser->getExpiresAt() )
        {
            $deadline = $clientUser->getExpiresAt();
            $clientRepository->remove($clientUser, true);

            throw new CustomUserMessageAccountStatusException("Votre délai de vérification de compte est dépassé depuis le : $deadline. Veuillez vous réinscrire.");
        }

        $clientUser->setIsVerified(true);
        $clientUser->setVerifiedAt(new \DateTimeImmutable('now'));

        $clientUser->setTokenForEmailVerification(null);
        $clientUser->setExpiresAt(null);

        $clientRepository->save($clientUser, true);

        $this->addFlash('success', 'Votre compte a bien été vérifié! Vous pouvez vous connecter.');

        return $this->redirectToRoute('visitor.authentication.login');
    }
}
