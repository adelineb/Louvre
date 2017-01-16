<?php

namespace Louvre\BilletterieBundle\Stripe;

use Louvre\BilletterieBundle\Repository\TarifRepository;
use Louvre\BilletterieBundle\Entity\Tarif;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class SaveCommande
{

    public function EnregCde() {
        $commande = new Commande();
        $commande->setEmail('azerty@tyui.fr');

        $client = new Client();
        $client->setNom('Dupont');
        $client->setPrenom('Arnaud');
        $client->setPays('FR');
        $client->setDateNaissance(new \DateTime('1980-01-01'));

        $billet = new Billet();
        //$billet->setDate(new \DateTime('04/01/2017'));
        $billet->setClient($client);
        $billet->setCommande($commande);
        $billet->setPrixBillet('16');

        $em = $this->getDoctrine()->getManager();
        $em->persist($commande);
        $em->persist($billet);
        $em->persist($client);

        $em->flush();
    }
}