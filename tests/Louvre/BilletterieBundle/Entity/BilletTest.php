<?php

namespace tests\Louvre\BilletterieBundle\Entity;

use Louvre\BilletterieBundle\Entity\Billet;
use Louvre\BilletterieBundle\Entity\Commande;


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

    public function testGetCommande()
    {
        $this->billet->setCommande(new Commande());
        $reservation = $this->billet->getCommande();
        $this->assertInstanceOf(Commande::class, $reservation);
    }
}