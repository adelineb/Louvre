<?php

namespace Louvre\BilletterieBundle\Controller;

use Louvre\BilletterieBundle\Entity\Billet;
use Louvre\BilletterieBundle\Entity\Client;
use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Entity\Tarif;
use Louvre\BilletterieBundle\Form\BilletType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends Controller
{
    public function indexAction(Request $request)
    {
        $billet = new Billet();

        $form = $this->get('form.factory')->create(BilletType::class, $billet);

        return $this->render('LouvreBilletterieBundle:Orders:index.html.twig', array(
            'form' => $form->createView(),
        ));

        /*$commande = new Commande();
            $commande->setEmail('azerty@tyui.fr');

            $client = new Client();
            $client->setNom('Dupont');
            $client->setPrenom('Arnaud');
            $client->setPays('FR');
            //$client->setDateNaissance('01/01/1980');

            $billet = new Billet();
            //$billet->setDate('04/01/2017');
            $billet->setClient($client);
            $billet->setCommande($commande);
            $billet->setPrixBillet('16');

            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->persist($billet);
            $em->persist($client);

            $em->flush();*/


        /* $content = $this->get('templating')->render('LouvreBilletterieBundle:Orders:index.html.twig');
         return new Response($content);*/

    }

    public function infosAction()
    {
        //return new Response("MON HELLO WORLD de INFOS");
        //return $this->render('LouvreBilletterieBundle:Orders:infos');
        $content = $this->get('templating')->render('LouvreBilletterieBundle:Orders:infos.html.twig');
        return new Response($content);
    }

    public function commandeAction()
    {
        //return new Response("MON HELLO WORLD de COMMANDE");
        //return $this->render('LouvreBilletterieBundle:Orders:commande');
        $content = $this->get('templating')->render('LouvreBilletterieBundle:Orders:commande.html.twig');
        return new Response($content);

    }
}