<?php

namespace Louvre\BilletterieBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ControleLimite extends Constraint
{
    public $message = "Le maximum de 1000 billets a été ateint.";
}
