<?php

namespace Louvre\BilletterieBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ControleDateValidator extends ConstraintValidator
{
    public function validate($value, Constraint $contraint)
    {
        $today = new \DateTime;
        $today->setTime(0, 0, 0);
        if ($value < $today) {
            $this->context->addViolation($contraint->message);
        }
    }

}
