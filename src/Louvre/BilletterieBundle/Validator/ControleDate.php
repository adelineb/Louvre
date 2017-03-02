<?php

namespace Louvre\BilletterieBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ControleDate extends Constraint
{
    public $message1 = "Impossible de réserver à une date antérieure.";
    public $message2 = "Réservation impossible le Dimanche. Veuillez saisir une autre date.";
    public $message3 = "Réservation impossible les jours fériés. Veuillez saisir une autre date.";
    public $message4 = "Toutes les places ont été vendues pour la date selectionnée. Veuillez saisir une autre date.";
    public $message5 = "Uniquement les billets demi-journée peuvent être commandés à présent";
    public $message6 = "Vous devez commander au moins 1 billet.";

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
