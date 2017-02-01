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
        $message = new \Swift_Message();
        // Composition du message du mail
        $message
            ->setCharset('UTF-8')
            ->setSubject('Billet(s) de réservation au Musée du Louvre')
            ->setBody($this->twig->render('LouvreBilletterieBundle:Orders:mailConfirmation.html.twig',
                array('coderesa' => $commande->getCoderesa(),)))
            ->setContentType('text/html')
            ->setTo($commande->getEmail())
            ->setFrom(array('adeline.barre62@gmail.com' => 'Musée du Louvre'));
        // Envoi du message au visiteur
        $this->mailer->send($message);
    }
}
