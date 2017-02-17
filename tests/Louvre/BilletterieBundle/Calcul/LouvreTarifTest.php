<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08/02/2017
 * Time: 17:37
 */

namespace BilletterieBundle\Calcul;

use Doctrine\ORM\EntityRepository;
use Louvre\BilletterieBundle\Calcul;
use Louvre\BilletterieBundle\Entity\Tarif;
use Louvre\BilletterieBundle\Model\BilletModel;
use Louvre\BilletterieBundle\Model\ClientModel;
use Louvre\BilletterieBundle\Repository\TarifRepository;


class LouvreTarifTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Calcul\LouvreTarif
     */
    private $service;

    public function setUp()
    {
        $tarif =$this->createMock(Tarif::class);
        $tarif->expects($this->any())
            ->method('getTarif')
            ->will($this->returnValue(16));

        $tarifreduit = $this->createMock(Tarif::class);
        $tarifreduit->expects($this->any())
            ->method('getTarif')
            ->will($this->returnValue(10));

        $tarifRepository = $this
            ->getMockBuilder(TarifRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $tarifRepository->expects($this->any())
            ->method('getTarifReduit')
            ->will($this->returnValue($tarifreduit));
        $tarifRepository->expects($this->any())
            ->method('getTarif')
            ->will($this->returnValue($tarif));

        $this->service = new Calcul\LouvreTarif($tarifRepository);

    }

    public function testCalculTarifNormal()
    {
        $client = new ClientModel();
        $billet = new BilletModel();
        $datenaiss = new \DateTime('1975-02-17');

        $client->setDateNaissance($datenaiss);
        $client->setNom('NOM');
        $client->setPrenom('PRENOM');

        $datevisite = new \DateTime('2017-02-18');
        $billet->setDate($datevisite);

        $tarif = $this->service->calculTarif($client, $datevisite, $billet->getTypebillet());

        $this->assertEquals(16, $tarif);
    }

    public function testCalculTarifReduit()
    {
        $client = new ClientModel();
        $billet = new BilletModel();
        $datenaiss = new \DateTime('1975-02-17');

        $client->setDateNaissance($datenaiss);
        $client->setNom('NOM');
        $client->setPrenom('PRENOM');
        $client->setTarifreduit(true);

        $datevisite = new \DateTime('2017-02-18');
        $billet->setDate($datevisite);
        $billet->setTypebillet(1);

        $tarif = $this->service->calculTarif($client, $datevisite, $billet->getTypebillet());

        $this->assertEquals(10, $tarif);
    }

    public function testCalculTarifDemiJournée()
    {
        $client = new ClientModel();
        $billet = new BilletModel();
        $datenaiss = new \DateTime('1975-02-17');

        $client->setDateNaissance($datenaiss);
        $client->setNom('NOM');
        $client->setPrenom('PRENOM');

        $datevisite = new \DateTime('2017-02-17');
        $billet->setDate($datevisite);

        $tarif = $this->service->calculTarif($client, $datevisite, $billet->getTypebillet());

        $this->assertEquals(8, $tarif);
    }
}