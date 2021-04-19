<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\UserRepository;
use App\Service\EncoderService;
use App\Service\GestionUserService;
use App\Service\SendEmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MentionLegalesController extends AbstractController
{
    private $emailSite = 'dofusmemorydofus@gmail.com';
    //    private $urlSite = 'http://localhost/Dofus-Memory/public/index.php/';
    private $urlSite = 'https://dofus-memory.ovh/';

    /**
     * @Route("/mention/legales", name="mention_legales")
     */
    public function index(UserRepository $userRepository, EncoderService $encoderService, SendEmailService $sendMail, Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
//            Envoie un message après sucess du formulaire
            $this->addFlash('notice', 'Un email vous à été envoyé, cliquez sur le lien pour valider la suppression du compte.');

            $email = $form->getData()['contact_email'];

            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user = $userRepository->findBy(['email' => $email]);
                $nbr_findByEmail = count($user);
                if ($nbr_findByEmail == 1) {
                    // On envoie un email avec token et on stok celui-ci dans la bdd
                    $token = $encoderService->encoderBB($email . "GraineDeSucre");
                    $userRepository->updateTokenUser($email, $token);
                    //Envoie de l'email avec le token
                    $message = $this->renderView('Emails/suppression_Compte.html.twig', [
                            'pseudo' => $user[0]->getPseudo(),
                            'token' => $token,
                            'urlSite' => $this->urlSite
                        ]
                    );

                    $sendMail->sendMail($this->emailSite, $email, $message, 'Suppression Compte');
                    return $this->redirectToRoute('mention_legales', ['emailEnvoyer' => 'Un email vous a été envoyé vous permettant de finaliser la suppression de votre compte.']);
                } else {
                    return $this->redirectToRoute('mention_legales', ['error' => 'Votre compte est déja supprimé.']);
                }
            }
        }

        return $this->render('Mention_legales/mentionsLegales.html.twig', [
            'title' => 'Mentions Légales',
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contact(SendEmailService $sendMail, Request $request, ?UserInterface $user): Response
    {
        if(!$user){ return $this->redirectToRoute('app_login'); }

        // Si le formulaire est submit
        if(isset($_POST['contact-message']) && !empty($_POST['contact-message'])){
            $email = $user->getEmail();
            $pseudo = $user->getPseudo();
            $message = 'Vous avez reçu un message de '.$pseudo.' avec l\'email : '.$email.' Message : '.htmlspecialchars((trim($_POST['contact-message'])));

            //Envoie de l'email
            $sendMail->sendMail($this->emailSite,'valentin.charrier@hotmail.fr', $message, 'Contact utilisateur dofus memory');
            return $this->redirectToRoute('home', ['message' => 'Message envoyé ! Nous vous répondrons au plus vite...']);
        }


        return $this->render('Mention_legales/contact.html.twig', [
            'title' => 'Ecrivez nous',
        ]);
    }



    /**
     * @Route("/faq", name="faq")
     */
    public function faq(): Response
    {
        return $this->render('Mention_legales/faq.html.twig', [
            'title' => 'FAQ',
        ]);
    }
}
