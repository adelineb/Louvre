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
        dump($mailer);
    }

    public function envoiMail(Commande $commande)
    {
        // Image en pièce jointe
        $str = "ABCDEFGHIJKLMNOPQRSTUVWYZ";
        $str = str_split(str_shuffle($str), 4)[0];
        $coderesa = rand(1000,9999).$str;
        dump($coderesa);
        $image = '{{ asset(\'css/main.css\') }}';
        $message = new \Swift_Message();
        $logo = $message->embed(\Swift_Image::fromPath($image));
        // Composition du message du mail
        $message
            ->setCharset('UTF-8')
            ->setSubject('Billet(s) de réservation au Musée du Louvre')
            ->setBody($this->twig->render('LouvreBilletterieBundle:Orders:mailConfirmation.html.twig',
                array('coderesa' => $coderesa,)))
            ->setContentType('text/html')
            ->setTo('ajacquelin27@hotmail.com')
            ->setFrom('adeline.barre62@gmail.com');
        // Envoi du message au visiteur
        $this->mailer->send($message);
        dump("email envoyé");
    }
}
