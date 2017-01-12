<?php

namespace Louvre\BilletterieBundle\Controller;

use Louvre\BilletterieBundle\Form\ClientType;
use Louvre\BilletterieBundle\Form\InfosType;
use Louvre\BilletterieBundle\Model\BilletModel;
use Louvre\BilletterieBundle\Model\ClientModel;
use Louvre\BilletterieBundle\Model\ClientsListeModel;
use Louvre\BilletterieBundle\Model\CommandeModel;
use Louvre\BilletterieBundle\Form\BilletType;
use Louvre\BilletterieBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class OrdersController extends Controller
{
    public function indexAction(Request $request)
    {
        //$this->get('session')->clear();
        $billet = new BilletModel();
        $billet->setDate(new \DateTime());

        $form = $this->get('form.factory')->create(BilletType::class, $billet);
        dump($billet);
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $session = $request->getSession();
                //$dateVisite = $session->get('date_visite');
                $session->set('date_visite', $billet->getDate());
                $session->set('type_billet', $billet->getTypebillet());
                $session->set('nb_billet', $billet->getNbbillet());

             /*        $em = $this->getDoctrine()->getManager();
                    $em->persist($billet);
                    $em->flush();*/
            }
            return $this->redirectToRoute('louvre_billetterie_infos', array());
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
        dump($form);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            dump($form);
            if ($form->isValid()) {
                $data = $form->getData();
                $session->set('Infos', $data);
                dump($data);
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
        $tarif = $this->container->get('billetterie.tarif');
        $tarif->CalculTarif($request);


        $commande = new CommandeModel();
        $form = $this->get('form.factory')->create(CommandeType::class, $commande);


        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            dump($form);
            if ($form->isValid()) {
            }
        }

        return $this->render('LouvreBilletterieBundle:Orders:commande.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}