<?php

namespace Louvre\BilletterieBundle\Calcul;

use Louvre\BilletterieBundle\Repository\TarifRepository;
use Louvre\BilletterieBundle\Entity\Tarif;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class LouvreTarif
{
    private $tarifRepository;

    public function __construct(TarifRepository $tarifRepository) {
        $this->tarifRepository = $tarifRepository;
    }

    //public function calculTarif($client, $heure)
    public function calculTarif($client, $dateVisite, $typebillet)
    {
        $datejour = new \DateTime();
        if ($client->tarifreduit == true)
        {
            $tarif = $this->tarifRepository->getTarifReduit();
        }
        else
        {
            //$date1 = new \DateTime();
            //$interval = $date1->diff($client->datenaissance);
            $interval = $datejour->diff($client->datenaissance);
            $age = $interval->y;

            $tarif = $this->tarifRepository->getTarif($age);
        }


        $prixBillet = $tarif->getTarif();
        if (($typebillet =="2") || ($dateVisite->format('Ymd') === $datejour->format('Ymd'))) {
            if ($datejour->format('H') >= 14)
            {
                $prixBillet = $tarif->getTarif() / 2;
            }
        }

        $client->tarif = $tarif->getLibelle();
        $client->codetarif = $tarif->getId();
        $client->prix = $prixBillet;

        return $prixBillet;

    }
}