<?php

namespace tests\Louvre\BilletterieBundle\Controller;

use AGProject\BookingBundle\Entity\Billet;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit\Framework\TestCase ;


class OrdersControllerTest extends WebTestCase
{
    private $formData;
    private $crawler;
    private $client;
    private $flow;
    private $visiteRepository;
    private $form;
    private $session;

    public function setUp()
    {
        $this->client = static::createClient();
        $container = $this->client->getContainer();
        $em = static::$kernel->getContainer()
            ->get('doctrine.orm.entity_manager');

        $this->formData = $this->createMock(Billet::class);
        $this->formData
            ->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(1));

        $billet = new Billet();
        $billet->setNbbillet(2);
        $this->session = $this->client->getContainer()->get('session');
        $this->session->set('Billet', $billet);

        $this->crawler = $this->client->request('GET', '/');
        $this->form = $this->crawler->selectButton('next')->form();
    }

    public function testIndexAction()
    {
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertContains('form', $this->client->getResponse()->getContent());
    }

}