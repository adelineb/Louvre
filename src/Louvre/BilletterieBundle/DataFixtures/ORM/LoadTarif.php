<?php

namespace Louvre\BilletterieBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Louvre\BilletterieBundle\Entity\Tarif;

class LoadTarif implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tab = array(
            array('libelle' => 'Gratuit', 'tarif' => '0', 'age_mini' => '0', 'age_maxi' => '4'),
            array('libelle' => 'Enfant', 'tarif' => '8', 'age_mini' => '4', 'age_maxi' => '12'),
            array('libelle' => 'Normal', 'tarif' => '16', 'age_mini' => '12', 'age_maxi' => '60'),
            array('libelle' => 'Sénior', 'tarif' => '12', 'age_mini' => '60', 'age_maxi' => '150'),
            array('libelle' => 'Réduit', 'tarif' => '10', 'age_mini' => '', 'age_maxi' => ''),
        );

        foreach ($tab as $tarifs) {
            $tarif = new Tarif();
            $tarif->setLibelle($tarifs['libelle']);
            $tarif->setTarif($tarifs['tarif']);
            $tarif->setAgeMini($tarifs['age_mini']);
            $tarif->setAgeMaxi($tarifs['age_maxi']);

            $manager->persist($tarif);
        };

        $manager->flush();
    }
}