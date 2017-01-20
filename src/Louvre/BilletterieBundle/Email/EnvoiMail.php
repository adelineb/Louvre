<?php
// src/Louvre/Billetterie/Email/EnvoiMail.php

namespace Louvre\BilletterieBundle\Email;

use Louvre\BilletterieBundle\Entity\Commande;

class EnvoiMail
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    private $twig;
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function envoiMail(Commande $commande)
    {
        // Image en pièce jointe
        $image = '{{ asset(\'css/main.css\') }}';
        $message = new \Swift_Message();
        $logo = $message->embed(\Swift_Image::fromPath($image));
        // Composition du message du mail
        $message
            ->setCharset('UTF-8')
            ->setSubject('Billet(s) de réservation au Musée du Louvre')
            ->setBody($this->twig->render('LouvreBilletterieBundle:Orders:email.html.twig')) /*, array(
                'commande' => $commande,
                'logo' => $logo,
            )))*/
            ->setContentType('text/html')
            ->setTo('ajacquelin27@hotmail.com')
            ->setFrom(array('ajacquelin27@hotmail.com' => 'Musée du Louvre'));
        // Envoi du message au visiteur
        $this->mailer->send($message);
        dump("email envoyé");
    }
}
