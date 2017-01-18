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

    public function calculTarif($datenaissance, $tarifreduit)
    {
        if ($tarifreduit == true)
        {
            $tarif = $this->tarifRepository->getTarifReduit();
        }
        else
        {
            $date1 = new \DateTime();
            $interval = $date1->diff($datenaissance);
            $age = $interval->y;

            $tarif = $this->tarifRepository->getTarif($age);
        }

        return $tarif->getTarif();

    }
}