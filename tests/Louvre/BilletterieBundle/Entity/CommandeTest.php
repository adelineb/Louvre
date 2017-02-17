<?php

namespace tests\Louvre\BilletterieBundle\Entity;

use Louvre\BilletterieBundle\Entity\Billet;
use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Entity\Type_billet;
use AGProject\BookingBundle\Entity\Tarif;

//use AGProject\BookingBundle\Entity\Reservation;
//use AGProject\BookingBundle\Entity\Visiteur;

class CommandeTest extends \PHPUnit_Framework_TestCase
{
    public function testgetTotalCde()
    {
        $commande = new Commande();
        $billet1 = new Billet();
        $billet1->setPrixBillet(16);
        $commande->addBillet($billet1);

        $billet2 = new Billet();
        $billet2->setPrixBillet(8);
        $commande->addBillet($billet2);

        $total = $commande->getTotalCde();
        $this->assertEquals(24, $total);
  }
}