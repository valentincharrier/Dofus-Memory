<?php


namespace App\Service;


use App\Repository\ArchimonstresRepository;
use App\Repository\FooterDescriptionRepository;
use App\Repository\UserMonsterRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;


class GestionUserService extends AbstractController
{
    private $guardAuthenticatorHandler;
    private $authenticator;
    private $encoderBB;
    private $passwordEncoder;
    private $archimonstresRepository;
    private $userRepository;
    private $emailService;
    private $entityManager;
    private $userMonsterRepository;
    private $footerDescriptionRepository;
    private $emailSite = 'dofusmemorydofus@gmail.com';
//    private $urlSite = 'http://localhost/Dofus-Memory/public/index.php/';
    private $urlSite = 'https://dofus-memory.ovh/';


    public function __construct(GuardAuthenticatorHandler $authenticatorHandler, LoginFormAuthenticator $authenticator,UserRepository $userRepository, EntityManagerInterface $entityManager, EncoderService $encoderBB, UserPasswordEncoderInterface $passwordEncoder, ArchimonstresRepository $archimonstresRepository, SendEmailService $emailService, UserMonsterRepository $userMonsterRepository, FooterDescriptionRepository $footerDescriptionRepository){
        $this->encoderBB = $encoderBB;
        $this->passwordEncoder = $passwordEncoder;
        $this->archimonstresRepository = $archimonstresRepository;
        $this->userRepository = $userRepository;
        $this->emailService = $emailService;
        $this->guardAuthenticatorHandler = $authenticatorHandler;
        $this->authenticator = $authenticator;
        $this->entityManager = $entityManager;
        $this->userMonsterRepository = $userMonsterRepository;
        $this->footerDescriptionRepository = $footerDescriptionRepository;
    }


    /**
     *  ▬▬▬▬ Inscription ▬▬▬▬ Encodage Password + Aleatoire Avatar + Add Token + Add email invalid + Add date + Add IP + SendMail
     * @param $user
     * @param $form
     * @return bool
     */
    public function inscription($user, $form) : Bool{
        if(strlen($form->get('password')->getViewData()['first']) > 5){
            $user->setPassword($this->passwordEncoder->encodePassword($user, $form->get('password')->getData()));
            $avatar = $this->archimonstresRepository->find(rand(1,317));
            $user->setAvatar($avatar->getImageMonster());
            $user->setLimitTime(strtotime((new \DateTime('now'))->format('Y-m-d H:i:s')) + 20);
            $token = $this->encoderBB->encoderBB($user->getPassword());
            $user->setToken($token);
            $user->setIsEmailValidate(false);
            $user->setDateCreationCompte(new \DateTime(''));
            $user->setLastIpUser($_SERVER['REMOTE_ADDR']);
            $user->setMonstresDejaCapture(0);

            $this->entityManager->persist($user);
            $this->entityManager->flush();


            $message = $this->renderView('Emails/inscription.html.twig', [
                    'user' => $user,
                    'token' => $token,
                    'urlSite' => $this->urlSite
                ]
            );

            $this->emailService->sendMail($this->emailSite, $user->getEmail() , $message, 'Validation Inscription');

            return true;
        }
            return false;
    }


    /**
     * ▬▬▬▬ Validation Email ▬▬▬▬ Recuperation user + Validate email + Reset token + Connexion
     * @param $request
     * @return bool
     */
    public function isChecker($request){
        $user = $this->userRepository->findOneBy(array('token' => $request->get('token')));

        if ($user != null) {
            $user->setIsEmailValidate(true);
            $user->setToken('');
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->connexion($user, $request);
            return true;
        }
        return false;
    }


    /**
     * ▬▬▬▬ Recuperation MDP ▬▬▬▬ Add token + SendMail
     * @param $formData
     * @return bool
     */
    public function recuperationMdp($formData){
        $isUser = $this->userRepository->findOneBy(['email' => $formData->getData()['email']]);

        if($isUser != null ){
            if( $isUser->getLimitTime() < (strtotime((new \DateTime('now'))->format('Y-m-d H:i:s'))) ){
                $tokenModificationMdp = $this->encoderBB->encoderBB($isUser->getEmail().$isUser->getPseudo().$isUser->getServeur());
                $isUser->setToken($tokenModificationMdp);
                $isUser->setLimitTime(strtotime((new \DateTime('now'))->format('Y-m-d H:i:s')) + 300);
                $this->entityManager->persist($isUser);
                $this->entityManager->flush();

                $message = $this->renderView('Emails/recuparationMdp.html.twig', [
                        'user' => $isUser,
                        'token' => $tokenModificationMdp,
                        'urlSite' => $this->urlSite
                    ]
                );

                $this->emailService->sendMail($this->emailSite, $isUser->getEmail(), $message, 'Modification MDP');
                return '0';
            }
            return '-1';
        }
        return '-2';
    }


    /**
     * ▬▬▬▬ Modification MDP ▬▬▬▬ Modification MDP  + Reset token + Validate email + Connexion
     * @param $form
     * @param $token
     * @param $request
     * @return bool
     */
    public function modificationMdp($form, $request){
        $isUser  = $this->userRepository->findOneBy(['token' => $form->getData()['token']]);
        if($isUser){
            $isUser->setPassword($this->passwordEncoder->encodePassword($isUser, $form->getData()['newPassword']));
            $isUser->setToken('');
            $isUser->getIsEmailValidate() === false ? $isUser->setIsEmailValidate(true) : false;
            $this->entityManager->persist($isUser);
            $this->entityManager->flush();

            $this->connexion($isUser, $request);
            return true;
        }
        return false;
    }


    /**
     * ▬▬▬▬ Connexion ▬▬▬▬
     * @param $user
     * @param $request
     */
    public function connexion($user, $request){
        $this->guardAuthenticatorHandler->authenticateUserAndHandleSuccess($user, $request, $this->authenticator, 'main');
    }

    /**
     * ▬▬▬▬ Modification Data User ▬▬▬▬
     * @param $request
     * @param $user
     * @return RedirectResponse|Response
     */
    public function updateDataUser($request, $user){

        $infosJoueur = $this->userRepository->find($user->getId());
        $errors = [];
        $serveur = ['Eratz', 'Galgarion', 'Henual', 'Crail', 'Monocompte VII', 'Monocompte IX', 'Monocompte X'];

        if(isset($_POST['rechercher'])){
            $pseudo = $request->get('pseudo');
            $password = $request->get('password');
            $choixServeur = $request->get('choixServeur');
            $image = $request->get('nomMonster');
            $resetCaptures = $request->get('resetCaptures');

            //Update Pseudo
            strlen($pseudo) > 0 ? $infosJoueur->setPseudo($pseudo) : $errors[] = 'Pseudo trop court';
            //Update Server
            if(in_array($choixServeur, $serveur)){$infosJoueur->setServeur($choixServeur);}else{$errors[] = 'Serveur inconnu';}
            //Update Avatar
            $infosJoueur->setAvatar($image);
            //Update Password
            strlen($password) === 0 || strlen($password) > 5 ? $infosJoueur->setPassword( $this->passwordEncoder->encodePassword( $infosJoueur, $password )) : $errors[] = 'Mot de passe trop court';

            if( $resetCaptures === 'true'){
                $this->userMonsterRepository->deleteMonsterUserID($infosJoueur->getId());
                $infosJoueur->setMonstresDejaCapture(0);
            }
            if(count($errors) === 0 ){
                $this->entityManager->persist($infosJoueur);
                $this->entityManager->flush();

                return $this->redirectToRoute("eternelleMoisson", ['errors' => $errors, 'message' => 'Modification effectuée !']);
            }
        }

        return $this->render('security/informationsPersonnelles.html.twig', array(
            'title' => 'Informations Personnelles',
            'descriptions' => $this->footerDescriptionRepository->affichage('Informations Personnelles'),
            'pseudo' => isset($pseudo) != null ? $pseudo :  $infosJoueur->getPseudo(),
            'password' => isset($password) != null ? $password :  '',
            'choixServeur' => isset($choixServeur) != null ? $choixServeur : $infosJoueur->getServeur(),
            'archimonstres' => $this->archimonstresRepository->affichagerTout(337),
            'image' => isset($image) != null ? $image : $infosJoueur->getAvatar(),
            'errors' => $errors,
        ));
    }

    public function isUserConnect($user){
       return $user ? true : false;
    }

}