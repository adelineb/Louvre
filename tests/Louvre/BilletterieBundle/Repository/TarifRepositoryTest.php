<?php

namespace tests\Louvre\BilletterieBundle\Repository;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TarifRepositoryTest extends KernelTestCase
//class TarifRepositoryTest extends \PHPUnit_Framework_TestCase
{
    private $em;

    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testgetTarifTest()
    {
        $tarif = $this->em
            ->getRepository('LouvreBilletterieBundle:Tarif')
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
