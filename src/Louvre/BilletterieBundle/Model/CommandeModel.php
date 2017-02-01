<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04/01/2017
 * Time: 16:31
 */

namespace Louvre\BilletterieBundle\Model;


class CommandeModel
{
    /**
     * @var \integer
     */
    private $paiement;

    /**
     * @var \string
     */
    private $email;

    /**
     * @var \string
     */
    private $coderesa;


    public function setPaiement($paiement)
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getPaiement()
    {
        return $this->paiement;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setCoderesa($coderesa)
    {
        $this->coderesa = $coderesa;

        return $this;
    }

    public function getCoderesa()
    {
        return $this->xcoderesa;
    }

}