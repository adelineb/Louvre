<?php

namespace tests\Louvre\BilletterieBundle\Entity;

use Louvre\BilletterieBundle\Entity\Billet;
use Louvre\BilletterieBundle\Entity\Commande;
use Louvre\BilletterieBundle\Entity\Type_billet;
use AGProject\BookingBundle\Entity\Tarif;

//use AGProject\BookingBundle\Entity\Reservation;
//use AGProject\BookingBundle\Entity\Visiteur;

class BilletTest extends \PHPUnit_Framework_TestCase
{
    private $billet;

    public function setUp()
    {
        $this->billet = new Billet();
    }

    public function testGetIdReturnsNullBeforeFlush()
    {
        $this->assertTrue(is_null($this->billet->getId()));
    }

    public function testGetCommandeTest()
    {
        $this->billet->setCommande(new Commande());
        $reservation = $this->billet->getCommande();
        $this->assertInstanceOf(Commande::class, $reservation);
    }

    /*public function testGetTarifTest()
    {
        $this->billet->setTypeBillet(new Type_billet());
        $tarif = $this->billet->getTypeBillet();
        $this->assertInstanceOf(Tarif::class, $tarif);
    }*/
}