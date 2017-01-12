<?php

namespace Louvre\BilletterieBundle\Calcul;

use Louvre\BilletterieBundle\Repository\TarifRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class LouvreTarif
{
    public function calculTarif($datenaissance)
    {
        $date1 = new \DateTime();
        $interval = $date1->diff($datenaissance);
        $age = $interval->y;
        getTarif($age);
        echo($age);

        $listAdverts = $this->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert')
            ->getAdverts($page, $nbPerPage)
    }
}