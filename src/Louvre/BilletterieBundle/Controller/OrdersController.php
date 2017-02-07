<?php

namespace Louvre\BilletterieBundle\Controller;

use Louvre\BilletterieBundle\Entity\Billet;
use Louvre\BilletterieBundle\Entity\Client;
use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Form\InfosType;
use Louvre\BilletterieBundle\LouvreBilletterieBundle;
use Louvre\BilletterieBundle\Model\BilletModel;
use Louvre\BilletterieBundle\Model\ClientModel;
use Louvre\BilletterieBundle\Model\ClientsListeModel;
use Louvre\BilletterieBundle\Model\CommandeModel;
use Louvre\BilletterieBundle\Form\BilletType;
use Louvre\BilletterieBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends Controller
{
    public function indexAction(Request $request)
    {
        //$this->get('session')->clear();
        $billet = new BilletModel();
        $billet->setDate(new \DateTime());
        $session = $request->getSession();
        //if ($session->get('date_visite') <> null){
        if ($request->getSession()->get('Billet') <> null){
            $billet->setDate(new \DateTime());
            //$billet->setTypebillet($session->get('type_billet'));
            //$billet->setNbbillet($session->get('nb_billet'));
            $billet->setTypebillet($request->getSession()->get('Billet')->getTypeBillet());
            $billet->setNbbillet($request->getSession()->get('Billet')->getNbBillet());
        }
        $form = $this->get('form.factory')->create(BilletType::class, $billet);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $session = $request->getSession();
                $data = $form->getData();
                $session->set('Billet', $data);
                dump($data);
                //$session->set('date_visite', $billet->getDate());
                //$session->set('type_billet', $billet->getTypebillet());
                //$session->set('nb_billet', $billet->getNbbillet());
                return $this->redirectToRoute('louvre_billetterie_infos', array());
           }
        }
        return $this->render('LouvreBilletterieBundle:Orders:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function infosAction(Request $request)
    {
        $session = $request->getSession();
        $billet = $request->getSession()->get('Billet');
        $tabClient = array();
        //for($nb=1; $nb <= $session->get('nb_billet'); $nb++)
        for($nb=1; $nb <= $billet->getNbbillet(); $nb++)
        {
            $tabClient[] = new clientModel();
        }

        $client = new ClientsListeModel($tabClient);
        $form = $this->get('form.factory')->create(InfosType::class, $client);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();
                $session->set('Infos', $data);
            }

            return $this->redirectToRoute('louvre_billetterie_commande', array());
        }
        return $this->render('LouvreBilletterieBundle:Orders:infos.html.twig', array(
            'listeclient' => $client,
            'form' => $form->createView(),
        ));
    }

    public function commandeAction(Request $request)
    {
        $totCommande = 0;
        $listTarifs = $this->get('billetterie.tarif');

        $session = $request->getSession();
        $infos = $session->get('Infos');
        $billet = $session->get('Billet');

        //$heure = $session->get('date_visite')->format('H');
        foreach ($infos->getClients() as $client) {
            //$tarif = $listTarifs->CalculTarif($client, $session->get('date_visite'), $session->get('type_billet'));
            $tarif = $listTarifs->CalculTarif($client, $billet->getDate(), $billet->getTypebillet());
            $totCommande += $tarif;
        }

        $session->set('Infos', $infos);
        $session->set('Total', $totCommande);

        $commandeModel = new CommandeModel();
        //$form = $this->get('form.factory')->create(CommandeType::class, $commandeModel);
        //$email = '';
        //$commandeModel->setCoderesa($coderesa);
        if ($request->isMethod('POST')) {
            //$form->handleRequest($request);
            $em = $this->getDoctrine()->getManager();
            //if ($form->isValid()) {
                $token = $request->request->get('stripeToken');
                $stripe = $this->get('billetterie.stripe');
                try {
                    $stripe->chargeCard($this->getParameter("stripe_private_key"), $token, $totCommande);
                    // on enregistre la commande en base
                    $commandeModel->setEmail(\Stripe\Token::retrieve($token)->email);
                    $billetModel = $session->get('Billet');
                    $infosModel = $session->get('Infos');
                    $commande = $this->get('commande_assembler')->createCommande($commandeModel, $infosModel, $billetModel);
                    $em->persist($commande);
                    $em->flush();

                    $session->set('commandeid', $commande->getId());

                    $this->get('billetterie.email')->envoiMail($commande);
                    return $this->redirectToRoute('louvre_billetterie_email');

                } catch(\Stripe\Error\Card $e) {
                    $this->addFlash('refus', 'Votre paiement a échoué. Veuillez ressaisir votre paiement. Merci.');
                }
            //}
        }
        return $this->render('LouvreBilletterieBundle:Orders:commande.html.twig', array(
            //'form' => $form->createView(),
            'montant' => $session->get('Total'),
            //'email' => $email,
            'email' => $commandeModel->getEmail(),
            'stripe_public_key' => $this->getParameter('stripe_public_key'),
        ));
    }

    public function emailAction(Request $request)
    {
        $session = $request->getSession();
        $commandeid = $session->get('commandeid');
        $commande = $this->getDoctrine()->getManager()->getRepository('LouvreBilletterieBundle:Commande')->find($commandeid);
        //$this->get('session')->clear();

        return $this->render('LouvreBilletterieBundle:Orders:email.html.twig', array(
            'coderesa' =>$commande->getCoderesa(),
        ));
    }

    public function videsessionAction()
    {
        //dump('videsession');
        $this->get('session')->clear();
        return $this->redirectToRoute('louvre_billetterie_homepage');
    }


}