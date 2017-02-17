<?php

namespace tests\Louvre\BilletterieBundle\Controller;

use Louvre\BilletterieBundle\Entity\Billet;
use Louvre\BilletterieBundle\Model\BilletModel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;


class OrdersControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertContains('Musée du Louvre', $client->getResponse()->getContent());
    }


    public function testIndexAction()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $form = $crawler->selectButton('suivant')->form(array(
            'billet[date]' => '27/02/2017',
            'billet[typebillet]' => 1,
            'billet[nbbillet]' => 2,
        ));
        $client->submit($form);

        $crawler = $client->request('GET', '/infos');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}