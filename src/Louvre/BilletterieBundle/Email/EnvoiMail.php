<?php
// src/Louvre/Billetterie/Email/EnvoiMail.php

namespace Louvre\BilletterieBundle\Email;

use Louvre\BilletterieBundle\Entity\Commande;
use Knp\Bundle\SnappyBundle\Snappy\LoggableGenerator;


class EnvoiMail
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    private $twig;
    CONST PATH_PDF = __DIR__.'/../../../../web/EnvoiPDF/';

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, LoggableGenerator $pdf)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->pdf = $pdf;
    }

    public function generatePDF(Commande $commande)
    {
     $this->pdf->generateFromHtml(
            $this->twig->render(
                'LouvreBilletterieBundle:Orders:BilletPDF.html.twig',
                array(
                    'coderesa' => $commande->getCoderesa()
                )
            ),
            self::PATH_PDF.$commande->getCoderesa() .'.pdf'
        );
    }

    public function envoiMail(Commande $commande)
    {
        $this->generatePDF($commande);
        $message = new \Swift_Message();

        // Composition du message du mail
        $message
            ->setCharset('UTF-8')
            ->setSubject('Billet(s) de réservation au Musée du Louvre')
            ->setBody($this->twig->render('LouvreBilletterieBundle:Orders:mailConfirmation.html.twig',
                array('coderesa' => $commande->getCoderesa(),)))
            ->setContentType('text/html')
            ->setTo($commande->getEmail())
            ->setFrom(array('adeline.barre62@gmail.com' => 'Musée du Louvre'))
            ->attach(\Swift_Attachment::fromPath(self::PATH_PDF.$commande->getCoderesa() .'.pdf'));
        // Envoi du message au visiteur
        $this->mailer->send($message);
    }
}
