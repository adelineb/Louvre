<?php

namespace Louvre\BilletterieBundle\Model;
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04/01/2017
 * Time: 12:35
 */

use Louvre\billetterieBundle\Validator\ControleDate;


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