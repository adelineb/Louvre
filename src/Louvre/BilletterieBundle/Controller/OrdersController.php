<?php

namespace Louvre\BilletterieBundle\Controller;

use Louvre\BilletterieBundle\Entity\Billet;
use Louvre\BilletterieBundle\Entity\Client;
use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Form\InfosType;
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
        if ($session->get('date_visite') <> null){
            $billet->setDate($session->get('date_visite'));
            $billet->setTypebillet($session->get('type_billet'));
            $billet->setNbbillet($session->get('nb_billet'));
        }
        $form = $this->get('form.factory')->create(BilletType::class, $billet);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $session = $request->getSession();
                $session->set('date_visite', $billet->getDate());
                $session->set('type_billet', $billet->getTypebillet());
                $session->set('nb_billet', $billet->getNbbillet());
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
        $tabClient = array();
        for($nb=1; $nb <= $session->get('nb_billet'); $nb++)
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

        $heure = $session->get('date_visite')->format('H');
        foreach($infos->getClients() as $client) {
            $tarif = $listTarifs->CalculTarif($client->datenaissance, $client->tarifreduit);

            /*foreach ($tarifService as $tarif) {
                $client->tarif = $tarif->getLibelle();
                $client->codetarif = $tarif->getId();
                $prixbillet = $tarif->getTarif();
                dump($prixbillet);
                dump($client->tarifreduit);
                if ($heure > 14)
                {
                    $prixbillet = $tarif->getTarif() / 2;
                }
                dump($prixbillet);

                $client->prix = $prixbillet;
                $totCommande = $totCommande + $prixbillet;
            }*/
        }
        $session->set('Infos', $infos);
        $session->set('Total', $totCommande);

        $commandeModel = new CommandeModel();
        $form = $this->get('form.factory')->create(CommandeType::class, $commandeModel);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            dump($form);
            $em = $this->getDoctrine()->getManager();
            if ($form->isValid()) {
                $commande = new Commande();
                $commande->setEmail($commandeModel->getEmail());
                foreach($infos->getClients() as $client) {
                    $visiteur = new Client();
                    $visiteur->setNom($client->nom);
                    $visiteur->setPrenom($client->prenom);
                    $visiteur->setPays($client->pays);
                    $visiteur->setDateNaissance($client->datenaissance);
                    $codeTarif = $em->getRepository('LouvreBilletterieBundle:Tarif')->find($client->codetarif);
                    $visiteur->setTarif($codeTarif);
                    $em->persist($visiteur);

                    $billet = new Billet();
                    $billet->setDate($session->get('date_visite'));
                    $billet->setClient($visiteur);
                    $billet->setCommande($commande);
                    $billet->setPrixBillet($client->prix);
                    $codeTypeBillet = $em->getRepository('LouvreBilletterieBundle:Type_billet')->find($session->get('type_billet'));
                    $billet->setTypebillet($codeTypeBillet);
                    $em->persist($billet);
                }
                $em->persist($commande);
                $em->flush();
            }
            //return $this->redirectToRoute('/', array());
        }

        return $this->render('LouvreBilletterieBundle:Orders:commande.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}