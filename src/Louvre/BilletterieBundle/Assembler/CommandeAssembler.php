<?php
// src/Louvre/Billetterie/Assembler/CommandeAssembler.php

namespace Louvre\BilletterieBundle\Assembler;

use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Entity\Billet;
use Louvre\BilletterieBundle\Entity\Client;
use Louvre\BilletterieBundle\Model\CommandeModel;
use Louvre\BilletterieBundle\Model\ClientsListeModel;
use Doctrine\ORM\EntityManager;
use Louvre\BilletterieBundle\Model\BilletModel;
use Louvre\BilletterieBundle\Repository\CommandeRepository;


class CommandeAssembler
{
    private $em;
    private $commanderepository;

    public function __construct(EntityManager $em, CommandeRepository $commandeRepository)
    {
        $this->em = $em;
        $this->commanderepository = $commandeRepository;
    }

    /**
     * @return Commande
     */
    public function createCommande(CommandeModel $commandeModel, ClientsListeModel $infosModel, BilletModel $billetModel)
    {
        //$em = $this->getDoctrine()->getManager();
        $coderesa = null;
        while ($coderesa == null || $this->commanderepository->FindCodeResa($coderesa) <> null) {
            $str = "ABCDEFGHIJKLMNOPQRSTUVWYZ";
            $str = str_split(str_shuffle($str), 4)[0];
            $coderesa = rand(1000,9999).$str;
        }
        $commande = new Commande();
        $commande->setCoderesa($coderesa);
        $commande->setEmail($commandeModel->getEmail());
        foreach ($infosModel->getClients() as $client) {
            $visiteur = new Client();
            $visiteur->setNom($client->nom);
            $visiteur->setPrenom($client->prenom);
            $visiteur->setPays($client->pays);
            $visiteur->setDateNaissance($client->datenaissance);
            $codeTarif = $this->em->getRepository('LouvreBilletterieBundle:Tarif')->find($client->codetarif);
            $visiteur->setTarif($codeTarif);

            $billet = new Billet();
            $billet->setClient($visiteur);
            $commande->addBillet($billet);
            $billet->setDate($billetModel->getDate());
            $billet->setClient($visiteur);
            $billet->setCommande($commande);
            $billet->setPrixBillet($client->prix);
            $codeTypeBillet = $this->em->getRepository('LouvreBilletterieBundle:Type_billet')->find($billetModel->getTypebillet());
            $billet->setTypebillet($codeTypeBillet);
        }
        return $commande;
    }

}