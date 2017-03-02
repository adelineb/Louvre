<?php

namespace Louvre\BilletterieBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;
use Louvre\BilletterieBundle\Entity\Billet;

class ControleDateValidator extends ConstraintValidator
{
    private $em;

        public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $contraint)
    {
        // Jours passés
        $today = new \DateTime;
        $heureJour = $today->format('H');
        $today->setTime(0, 0, 0);

        // Dimanche
        $jourFermes = array(
            "dimanche" =>7,
            "mardi" =>2
        );

        // Jours fériés
        $year = $today->format('Y');
        $easterDate = easter_date($year);
        $easterDay = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);
        $easterYear = date('Y', $easterDate);
        $joursFeries = array(
            // Dates fixes
            mktime(0, 0, 0, 1, 1, $year),  // 1er janvier
            mktime(0, 0, 0, 5, 1, $year),  // Fête du travail
            mktime(0, 0, 0, 5, 8, $year),  // Victoire des alliés
            mktime(0, 0, 0, 7, 14, $year),  // Fête nationale
            mktime(0, 0, 0, 8, 15, $year),  // Assomption
            mktime(0, 0, 0, 11, 1, $year),  // Toussaint
            mktime(0, 0, 0, 11, 11, $year),  // Armistice
            mktime(0, 0, 0, 12, 25, $year),  // Noel
            // Dates variables
            mktime(0, 0, 0, $easterMonth, $easterDay + 1, $easterYear),
            mktime(0, 0, 0, $easterMonth, $easterDay + 40, $easterYear),
            mktime(0, 0, 0, $easterMonth, $easterDay + 50, $easterYear),
        );
        
        $repository = $this->em->getRepository('LouvreBilletterieBundle:Billet');
        $listReservations = $repository->findByDate($value->getDate());
        $nbBillet= count($listReservations);
        $nbBillet += $value->getNbBillet();

        if ($value->getDate() < $today) {
            $this->context->addViolation($contraint->message1);
        }
        if (in_array($value->getDate()->format('N'), $jourFermes))
        {
            $this->context->addViolation($contraint->message2);
        }
        if (in_array($value->getDate()->setTime(0, 0, 0)->getTimestamp(), $joursFeries))
        {
            $this->context->addViolation($contraint->message3);
        }
        if ($nbBillet >= 1000) {
            $this->context->addViolation($contraint->message4);
        }
        if ($value->getDate() == $today && $heureJour >= 14 && $value->getTypeBillet() == 1)
        {
            $this->context->addViolation($contraint->message5);
        }
        if ($value->getNbBillet() < 1)
        {
            $this->context->addViolation($contraint->message6);
        }
    }
}
