<?php


namespace App\Service;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SendEmailService
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer){
        $this->mailer = $mailer;
    }

    public function sendMail($expediteur = 'dofusmemorydofus@gmail.com', $destinataire, $message, $subjectMessage){

        $mail = (new \Swift_Message($subjectMessage))
            ->setFrom($expediteur)
            ->setTo($destinataire)
            ->setBody(
            //Rendue de l'email et on fourni les coordonnées écrite par l'utilisateur dans le formulaire
                $message,
                'text/html'
            );
        $this->mailer->send($mail);
    }

}