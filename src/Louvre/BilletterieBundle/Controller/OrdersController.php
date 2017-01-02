<?php

namespace Louvre\BilletterieBundle\Controller;

use Louvre\BilletterieBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;


use Symfony\Component\HttpFoundation\Request;

class OrdersController extends Controller
{
    public function indexAction(Request $request)
    {
        //return new Response("MON HELLO WORLD de INDEX");
        //return $this->render('LouvreBilletterie:Orders:index');

        $orders = new Commande();

        $formBuilder = $this->get('form.factory')->createBuilder($orders);

        $formBuilder
            ->add('date',               DateType::class)
            ->add('Visite à la ',       RadioType::class)
            ->add('Nombre de billets ', TextType::class)
        ;
        $form = $formBuilder->getForm();

        $form->handleRequest($request);

        $content = $this->get('templating')->render('LouvreBilletterieBundle:Orders:index.html.twig');
        return new Response($content);
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