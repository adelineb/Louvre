<?php

namespace Louvre\BilletterieBundle\Controller;

use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Form\InfosType;
use Louvre\BilletterieBundle\Model\BilletModel;
use Louvre\BilletterieBundle\Model\ClientsListeModel;
use Louvre\BilletterieBundle\Model\CommandeModel;
use Louvre\BilletterieBundle\Form\BilletType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends Controller
{
    public function indexAction(Request $request)
    {
        $billet = new BilletModel();
        $billet->setDate(new \DateTime());
        $form = $this->get('form.factory')->create(BilletType::class, $billet);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $session = $request->getSession();
                $data = $form->getData();
                $session->set('Billet', $data);
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
        if ($billet==null) {
            return $this->redirectToRoute('louvre_billetterie_homepage');
        }
        $client = new ClientsListeModel($billet->getNbbillet());

        $form = $this->get('form.factory')->create(InfosType::class, $client);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();
                $session->set('Infos', $data);
            }

            return $this->redirectToRoute('louvre_billetterie_commande');
        }
        return $this->render('LouvreBilletterieBundle:Orders:infos.html.twig', array(
            'listeclient' => $client,
            'form' => $form->createView(),
        ));
    }

    public function commandeAction(Request $request)
    {
        $session = $request->getSession();
        $infos = $session->get('Infos');

        if ($infos==null) {
            return $this->redirectToRoute('louvre_billetterie_infos');
        }
        $billet = $session->get('Billet');

        foreach ($infos->getClients() as $client) {
            $this->get('billetterie.tarif')->CalculTarif($client, $billet->getDate(), $billet->getTypebillet());
        }

        $session->set('Infos', $infos);

        $commandeModel = new CommandeModel();

        $commande = $this->get('commande_assembler')->createCommande($commandeModel, $infos, $billet);
        $session->set('Total', $commande->getTotalCde());
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $token = $request->request->get('stripeToken');
            try {
                $this->get('billetterie.stripe')->chargeCard($token, $commande->getTotalCde());
                $commande->setEmail(\Stripe\Token::retrieve($token)->email);

                $em->persist($commande);
                $em->flush();

                $session->set('commandeid', $commande->getId());
                $this->get('billetterie.email')->envoiMail($commande);

                return $this->redirectToRoute('louvre_billetterie_email');

            } catch(\Stripe\Error\Card $e) {
                $this->addFlash('refus', 'Votre paiement a échoué. Veuillez ressaisir votre paiement. Merci.');
            }
        }
        return $this->render('LouvreBilletterieBundle:Orders:commande.html.twig', array(
            'montant' => $session->get('Total'),
            'email' => $commandeModel->getEmail(),
            'stripe_public_key' => $this->getParameter('stripe_public_key'),
        ));
    }

    public function emailAction(Request $request)
    {
        $session = $request->getSession();
        if ($session->get('Infos')==null) {
            return $this->redirectToRoute('louvre_billetterie_infos');
        }
        $commandeId = $session->get('commandeid');
        if ($commandeId==null) {
            return $this->redirectToRoute('louvre_billetterie_commande');
        }
        $commande = $this->getDoctrine()->getManager()->getRepository('LouvreBilletterieBundle:Commande')->find($commandeId);


        return $this->render('LouvreBilletterieBundle:Orders:email.html.twig', array(
            'coderesa' =>$commande->getCoderesa(),
        ));
    }

    public function videSessionAction()
    {
        $this->get('session')->clear();
        return $this->redirectToRoute('louvre_billetterie_homepage');
    }
}