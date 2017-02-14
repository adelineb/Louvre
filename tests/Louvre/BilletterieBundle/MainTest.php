<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainTest extends WebTestCase
{
    /*public function setUp()
    {
        self::bootKernel();
    }*/

    public function testMainTest()
    {
        $this->assertContains('Musée du Louvre', '#Container h1');
    }
}