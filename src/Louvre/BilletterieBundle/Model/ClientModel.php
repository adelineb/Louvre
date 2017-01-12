<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04/01/2017
 * Time: 16:46
 */

namespace Louvre\BilletterieBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;


class ClientModel
{
    /**
     * @var \string
     */
    public $nom;

    /**
     * @var \string
     */
    public $prenom;

    /**
     * @var \string
     */
    public $pays;

    /**
     * @var \DateTime
     */
    public $datenaissance;

    /**
     * @var \integer
     */
    public $tarifreduit;

    /**
     * @var \integer
     */
    public $prix;

    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    public function getPays()
    {
        return $this->pays;
    }

    public function setDateNaissance(\Datetime $datenaissance)
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getDateNaissance()
    {
        return $this->datenaissance;
    }

    public function setTarifreduit($tarifreduit)
    {
        $this->tarifreduit = $tarifreduit;

        return $this;
    }

    public function getTarifreduit()
    {
        return $this->tarifreduit;
    }

    public function setPrix($tarifreduit)
    {
        $this->tarifreduit = $tarifreduit;

        return $this;
    }

    public function getPrix()
    {
        return $this->tarifreduit;
    }
}