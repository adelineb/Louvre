<?php

namespace Louvre\BilletterieBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ControleDate extends Constraint
{
    public $message = "Impossible de réserver à une date antérieure.";
}