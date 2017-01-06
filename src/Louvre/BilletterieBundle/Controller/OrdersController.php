<?php

namespace Louvre\BilletterieBundle\Controller;

use Louvre\BilletterieBundle\Form\InfosType;
use Louvre\BilletterieBundle\Model\BilletModel;
use Louvre\BilletterieBundle\Model\ClientModel;
use Louvre\BilletterieBundle\Model\CommandeModel;
use Louvre\BilletterieBundle\Entity\Client;
use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Entity\Tarif;
use Louvre\BilletterieBundle\Form\BilletType;
use Louvre\BilletterieBundle\Form\ClientType;
use Louvre\BilletterieBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends Controller
{
    public function indexAction(Request $request)
    {
        $billet = new BilletModel();

        $form = $this->get('form.factory')->create(BilletType::class, $billet);

        if ($request->isMethod('POST')) {
            /*$form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($billet);
                $em->flush();*/

            };

        return $this->redirectToRoute('louvre_billetterie_infos', array('id' => $billet->getId()));

        return $this->render('LouvreBilletterieBundle:Orders:index.html.twig', array(
            'form' => $form->createView(),
        ));


;
        /*$commande = new Commande();
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

            $em->flush();*/


        /* $content = $this->get('templating')->render('LouvreBilletterieBundle:Orders:index.html.twig');
         return new Response($content);*/

    }

    public function infosAction(Request $request)
    {
        $session = $this->get('session');
        $session->set('nombrebillet',2);

        $client = new ClientModel();

        $form = $this->get('form.factory')->create(InfosType::class, $client);

        dump($form);
        return $this->render('LouvreBilletterieBundle:Orders:infos.html.twig', array(
            'form' => $form->createView(),
        ));
        //$content = $this->get('templating')->render('LouvreBilletterieBundle:Orders:infos.html.twig');
        //return new Response($content);
    }

    public function commandeAction()
    {
        $commande = new CommandeModel();

        $form = $this->get('form.factory')->create(CommandeType::class, $commande);

        return $this->render('LouvreBilletterieBundle:Orders:commande.html.twig', array(
            'form' => $form->createView(),
        ));

        /*$content = $this->get('templating')->render('LouvreBilletterieBundle:Orders:commande.html.twig');
        return new Response($content);*/

    }
}