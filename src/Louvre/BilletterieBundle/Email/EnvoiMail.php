<?php
// src/Louvre/Billetterie/Email/EnvoiMail.php

namespace Louvre\BilletterieBundle\Email;

use Louvre\BilletterieBundle\Entity\Commande;
use Knp\Bundle\SnappyBundle\Snappy\LoggableGenerator;
use Knp\Snappy\Pdf;


class EnvoiMail
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    private $twig;
    private $pdf;
    //CONST PATH_PDF = __DIR__. '/tmp/reservation/';

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, LoggableGenerator $pdf)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->pdf = $pdf;
    }

    public function generatePDF(Commande $commande)
    {
        $coderesa = $commande->getCoderesa();
        $path = __DIR__.  '\tmp\reservation' . $coderesa . '.pdf';
        dump($path);
        $this->pdf->generateFromHtml(
            $this->twig->render(
                'LouvreBilletterieBundle:Orders:mailConfirmation.html.twig',
                array(
                    'coderesa' => $commande->getCoderesa()
                )
            ),
            $path
        );
        dump($path);
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
            ->setFrom(array('adeline.barre62@gmail.com' => 'Musée du Louvre'));
        // Envoi du message au visiteur
        $this->mailer->send($message);
    }
}
