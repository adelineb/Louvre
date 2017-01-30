<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04/01/2017
 * Time: 16:46
 */

namespace Louvre\BilletterieBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;


class ClientModel
{
    /**
     * @var \string
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     minMessage = "Votre nom doit comporter au moins {{ limit }} caractères",
     *     maxMessage = "Votre nom ne doit pas comporter plus de {{ limit }} caractères."
     * )
     */
    public $nom;

    /**
     * @var \string
     */
    public $prenom;

    /**
     * @var \string
     * * @Assert\Country()
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
     * @var \string
     */
    public $tarif;

    /**
     * @var \integer
     */
    public $codetarif;

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

    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    public function getTarif()
    {
        return $this->tarif;
    }

    public function setCodeTarif($codetarif)
    {
        $this->codetarif = $codetarif;

        return $this;
    }

    public function getCodeTarif()
    {
        return $this->codetarif;
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