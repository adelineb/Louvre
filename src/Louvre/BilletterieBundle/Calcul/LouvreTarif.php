<?php

namespace Louvre\BilletterieBundle\Calcul;

use Louvre\BilletterieBundle\Entity\Tarif;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class LouvreTarif
{
    public function calculTarif(Request $request)
    {
        $session = $request->getSession();

        $info = $session->get('Infos');

        foreach ($info as $billet) {
            $datenaiss = $billet->datenaissance;
            echo($datenaiss);
        }
    }

}