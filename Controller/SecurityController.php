<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ArchimonstresRepository;
use App\Repository\FooterDescriptionRepository;
use App\Repository\UserMonsterRepository;
use App\Repository\UserRepository;
use App\Service\GestionUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private $authenticationUtils;
    private $passwordEncoder;
    private $userMonsterRepository;
    private $archimonstresRepository;
    private $footerDescriptionRepository;
    private $userRepository;
    private $gestionUserService;

    public function __construct(GestionUserService $gestionUserService, UserMonsterRepository $userMonsterRepository,UserPasswordEncoderInterface $passwordEncoder,ArchimonstresRepository $archimonstresRepository, FooterDescriptionRepository $footerDescriptionRepository, UserRepository $userRepository, AuthenticationUtils $authenticationUtils){
        $this->passwordEncoder = $passwordEncoder;
        $this->userMonsterRepository = $userMonsterRepository;
        $this->archimonstresRepository = $archimonstresRepository;
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->userRepository = $userRepository;
        $this->authenticationUtils = $authenticationUtils;
        $this->gestionUserService = $gestionUserService;
    }

    /**
     * @Route("/modification/profil", name="modificationProfil")
     * ▬▬▬▬ Page Update User Data ▬▬▬▬
     * @param Request $request
     * @return Response
     */
    public function modificationProfil(Request $request, UserInterface $user): Response
    {
        return $this->gestionUserService->updateDataUser($request, $user);
    }


    /**
     * @Route("/login", name="app_login")
     * ▬▬▬▬ Page Connexion ▬▬▬▬
     * @param Request $request
     * @return Response
     */
    public function login(Request $request, ?UserInterface $user): Response
    {
        if($this->gestionUserService->isUserConnect($user)){return $this->redirectToRoute('home', ['message' => 'Vous êtes déja connecté !']);}

        return $this->render('security/login.html.twig',
            [
                'message' => $request->get('message'),
                'last_username' => $this->authenticationUtils->getLastUsername(),
                'error' => $this->authenticationUtils->getLastAuthenticationError(),
                'title' => "Connexion",
                'descriptions' => $this->footerDescriptionRepository->affichage('Connexion'),
            ]);
    }


    /**
     * @Route("/logout", name="app_logout")
     * ▬▬▬▬ Page Déconnexion ▬▬▬▬
     */
    public function logout()
    {
        throw new \LogicException('Deconnexion');
    }




    /**
     * @Route("/delete-user/{id}", name="delete_user")
     * ▬▬▬▬ Page Suppression de compte ▬▬▬▬
     */
    public function deleteUser($id){
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository(User::class);
        $session = new Session();
        $session->invalidate();


        $user = $userRepository->find($id);
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('app_register', ['compteDelete' => 'Votre compte à été supprimé !']);
    }

    /**
     * @Route("/supression-compte-email", name="delete_compte_email")
     * ▬▬▬▬ Page Suppression de compte ▬▬▬▬
     */
    public function deleteUserWithEmail(Request $request){
        $token = htmlspecialchars($request->get('token'));

        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository(User::class);
        $user = $userRepository->findBy(['token' => $token]);
        if(count($user) == 1){
            $session = new Session();
            $session->invalidate();
            $em->remove($user[0]);
            $em->flush();
        }else{
            // redirectToRoute erreur = votre lien n'est plus valide, régénérer en un sur le site dans la page des mentions légales.
            return $this->redirectToRoute('mention_legales', ['error' => 'Impossible de vous trouver... Réessayez de créer un lien de suppression de compte.']);
        }


        return $this->redirectToRoute('app_register', ['compteDelete' => 'Votre compte à été supprimé !']);
    }
}
