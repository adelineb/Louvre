<?php

namespace Louvre\BilletterieBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;
use Louvre\BilletterieBundle\Repository\BilletRepository;

class ControleLimiteValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManager $em)
    { // i guess it's EntityManager the type
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
            //$this->context->buildViolation($contraint->message)->addViolation();
            $this->context->addViolation($contraint->message);

        }
    }
}