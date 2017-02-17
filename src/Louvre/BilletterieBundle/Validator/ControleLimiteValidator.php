<?php

namespace Louvre\BilletterieBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class ControleLimiteValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $contraint)
    {
        $repository = $this->em->getRepository('LouvreBilletterieBundle:Billet');

        $dateVisite = $value->getDate();

        $listReservations = $repository->FindByDate($dateVisite);
        $number= count($listReservations);
        $number += $value;
        dump($number);

        if ($number >= 1000) {
            $this->context->addViolation($contraint->message);

        }
    }
}