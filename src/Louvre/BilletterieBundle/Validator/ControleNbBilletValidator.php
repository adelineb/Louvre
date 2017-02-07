<?php

namespace Louvre\BilletterieBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ControleNbBilletValidator extends ConstraintValidator
{
    public function validate($value, Constraint $contraint)
    {
        if ($value < 1) {
            $this->context->addViolation($contraint->message);
        }
    }
 }