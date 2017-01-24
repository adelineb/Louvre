<?php

namespace Louvre\BilletterieBundle\Model;

use Louvre\billetterieBundle\Validator\ControleDateValidator;
use Louvre\billetterieBundle\Validator\ControleLimite;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Louvre\BilletterieBundle\Validator\ControleDate;

/**
 * Class BilletModel
 *
 */
class BilletModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var \DateTime
     * @ControleDate()
     */
    private $date;

    /**
     * @var \integer
     */
    private $typebillet;

    /**
     * @var \integer
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