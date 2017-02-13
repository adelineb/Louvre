<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08/02/2017
 * Time: 17:37
 */

namespace BilletterieBundle\Calcul;

use Louvre\BilletterieBundle\Calcul;
use Louvre\BilletterieBundle\Model\BilletModel;
use Louvre\BilletterieBundle\Model\ClientModel;
use Louvre\BilletterieBundle\Repository\TarifRepository;

//use LouvreTarifTest.php;


class LouvreTarifTest extends \PHPUnit_Framework_TestCase
{
    private $tarifRepository;

    public function setUp()
    {

    }

    public function testCalculTarif()
    {
        $client = new ClientModel();
        $billet = new BilletModel();
        $datenaiss = new \DateTime('1975-02-17');

        $client->setDateNaissance($datenaiss);
        $client->setNom('NOM');
        $client->setPrenom('PRENOM');

        $datevisite = new \DateTime('2017-02-18');
        $billet->setDate($datevisite);
        $billet->setTypebillet(1);

        $tarif = new Calcul\LouvreTarif($client, $datevisite, $billet->getTypebillet());
        //$result = $tarif->calculTarif($client, $datevisite, $billet->getTypebillet());

        $this->assertEquals(16, $tarif);

    }
}