<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ModificationMotPasseType;
use App\Form\RecuperationMotPasseType;
use App\Form\RegistrationFormType;
use App\Repository\ArchimonstresRepository;
use App\Repository\FooterDescriptionRepository;
use App\Repository\UserRepository;
use App\Security\LoginFormAuthenticator;
use App\Service\GestionUserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    private $error;
    private $passwordEncoder;
    private $guardHandler;
    private $authenticator;
    private $footerDescriptionRepository;
    private $archimonstresRepository;
    private $gestionUserService;
    private $userRepository;
    private $em;


    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, FooterDescriptionRepository $footerDescriptionRepository, ArchimonstresRepository $archimonstresRepository, GestionUserService $gestionUserService){


        $this->passwordEncoder = $passwordEncoder;
        $this->guardHandler = $guardHandler;
        $this->authenticator = $authenticator;
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->archimonstresRepository = $archimonstresRepository;
        $this->gestionUserService = $gestionUserService;
        $this->userRepository = $userRepository;
        $this->em = $entityManager;

    }

    /**
     * @Route("/register", name="app_register", methods={"GET", "POST"})
     * ▬▬▬▬ Page inscription ▬▬▬▬ Form inscription + Inscription + Redirection(eternelleMoisson)
     * @param Request $request
     * @return Response
     */
    public function register(Request $request, ?UserInterface $user): Response
    {
        if($this->gestionUserService->isUserConnect($user)){return $this->redirectToRoute('home', ['message' => 'Vous êtes déja connecté !']);}

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return  $this->gestionUserService->inscription($user , $form) === true ? $this->redirectToRoute('app_login', ['message' => 'Un email vous a été envoyé, cliquez sur son lien pour valider votre email.']) : $this->redirectToRoute('app_register', ['error' => 'password: 6 caractères minimum']);
        }

        return $this->render('registration/register.html.twig', [
            'errors' => isset($errors) ? $errors : '',
            'title' => 'Inscription',
            'descriptions' => $this->footerDescriptionRepository->affichage('Inscription'),
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/checker-mail", name="checkerMail", methods={"GET", "POST"})
     * ▬▬▬▬ Checker Email ▬▬▬▬ Verification Validite email
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function checkerMail(Request $request, ?UserInterface $user): Response
    {
        if($this->gestionUserService->isUserConnect($user)){return $this->redirectToRoute('home', ['message' => 'Vous êtes déja connecté !']);}
        return $this->gestionUserService->isChecker($request) === true ? $this->redirectToRoute('eternelleMoisson', ['message' => 'Email Validée !']) : $this->redirectToRoute('app_login', ['error' => 'Votre lien est invalid. Veuillez rééssayer ou en générer un nouveau.']);
    }


    /**
     * @Route("/recuperation-mdp", name="recuperationMdp", methods={"GET", "POST"})
     * ▬▬▬▬ Recuperation MDP ▬▬▬▬
     * @param Request $request
     * @return Response
     */
    public function recuperationMdp(Request $request, ?UserInterface $user): Response
    {
        if($this->gestionUserService->isUserConnect($user)){return $this->redirectToRoute('home', ['message' => 'Vous êtes déja connecté !']);}

        $form = $this->createForm(RecuperationMotPasseType::class);
        $form->handleRequest(($request));
        if( $form->isSubmitted() && $form->isValid()) {
            $isMailIsSend = $this->gestionUserService->recuperationMdp($form);
            if($isMailIsSend == '0'){
                $message = "Un email vous a été envoyé vous permettant de réinitialiser votre mot de passe.";
            }else if($isMailIsSend == '-2'){
                $error = 'Email incorrect';
            }else if($isMailIsSend == '-1'){
                $error = 'Attendre 5min avant de redemander !';
            }
        }

        return $this->render('registration/recuperationMdp.html.twig', [
            'message' => isset($message) ? $message : '',
            'error' => isset($error) ?  $error : false,
            'title' => 'Recuperation Mot de Passe',
            'descriptions' => $this->footerDescriptionRepository->affichage('Recuperation Mot de Passe'),
            'form' => $form->createView(),
            'form' => $form->createView(),
        ]);
    }


    /**
     *  @Route("/modification-mdp", name="modificationMdp", methods={"GET", "POST"})
     * ▬▬▬▬ Modification MDP ▬▬▬▬ Modification MDP + Redirection(eternelleMoisson // app_login)
     * @param Request $request
     * @return Response
     */
    public function modificationMdp(Request $request, ?UserInterface $user): Response
    {
        if($this->gestionUserService->isUserConnect($user)){return $this->redirectToRoute('home', ['message' => 'Vous êtes déja connecté !']);}

        $form = $this->createForm(ModificationMotPasseType::class);
        $form->handleRequest(($request));

        if($form->isSubmitted()){
            if(strlen($form->getData()['newPassword']) > 5 && $form->getData()['newPassword'] == $form->getData()['confirmPassword']){
                return $this->gestionUserService->modificationMdp($form, $request) === true ? $this->redirectToRoute('eternelleMoisson', ['message' => 'Votre mot de passe à bien été modifié !']) : $this->redirectToRoute('app_login', ['error' => 'Lien erroné, cliquez sur récupération de mot de passe pour pouvoir récupérer votre mot de passe']);
            }else{
                return $this->redirectToRoute('modificationMdp', ['error' => 'mots de passe < 5 ou différents !', 'token' => $request->get('token')]);
            }
        }

        return $this->render('registration/motDePasseOublie.html.twig', [
            'error' => isset($error) ? $error : '',
            'title' => 'Modification Mot de Passe',
            'descriptions' => $this->footerDescriptionRepository->affichage('Modification Mot de Passe'),
            'form' => $form->createView(),
            'token' => $request->get('token'),
        ]);
    }



}
