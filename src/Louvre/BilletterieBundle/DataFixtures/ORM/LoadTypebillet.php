<?php

namespace Louvre\BilletterieBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Louvre\BilletterieBundle\Entity\Type_billet;

class LoadTypebillet implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Journée',
            'Demi-journée'
        );

        foreach ($names as $name) {
            $typebillet = new Type_billet();
            $typebillet->setLibelle($name);

            $manager->persist($typebillet);
        };

        $manager->flush();
    }
}