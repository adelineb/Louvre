<?php

namespace Louvre\BilletterieBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Louvre\BilletterieBundle\Validator as AcmeAssert;
use Louvre\BilletterieBundle\Validator\ControleNbBillet;

/**
 * Class BilletModel
 * @AcmeAssert\ControleDate()
 */
class BilletModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \integer
     */
    private $typebillet;

    /**
     * @var \integer
     * @Assert\Range(min=1, minMessage="Vous devez réserver au moins 1 billet")
     * @ControleNbBillet
     */
    private $nbbillet;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDate(\Datetime $date)
    {
        $this->date = $date;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setTypebillet($typebillet)
    {
        $this->typebillet = $typebillet;

        return $this;
    }

    public function getTypebillet()
    {
        return $this->typebillet;
    }

    public function setNbbillet($nbbillet)
    {
        $this->nbbillet = $nbbillet;

        return $this;
    }

    public function getNbbillet()
    {
        return $this->nbbillet;
    }

}