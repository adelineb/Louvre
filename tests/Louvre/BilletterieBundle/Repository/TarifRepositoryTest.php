<?php

namespace tests\Louvre\BilletterieBundle\Repository;

use Louvre\BilletterieBundle\Entity\Tarif;
use Louvre\BilletterieBundle\Repository\TarifRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TarifRepositoryTest extends WebTestCase
{
    private $tarifRepository;

    public function setUp()
    {
        //self::bootKernel();
        $kernel = static::createKernel();
        $kernel->boot();
        $this->tarifRepository = static::$kernel->getContainer()
            ->get('doctrine.orm.default_entity_manager')
            ->getRepository('LouvreBilletterieBundle:Tarif');
    }

    public function testgetTarifTest()
    {
        $tarif = $this->tarifRepository
            //->getRepository('LouvreBilletterieBundle:Tarif')
            ->getTarif(5);

        $this->assertEquals(8, $tarif->getTarif());

    }

    public function testgetTarifReduitTest()
    {
        $tarifReduit = $this->em
            ->getRepository('LouvreBilletterieBundle:Tarif')
            ->getTarifReduit();

        $this->assertEquals(16, $tarifReduit->getTarif());
    }
}
