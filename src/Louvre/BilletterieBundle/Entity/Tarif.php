<?php

namespace Louvre\BilletterieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tarif
 *
 * @ORM\Table(name="tarif")
 * @ORM\Entity(repositoryClass="Louvre\BilletterieBundle\Repository\TarifRepository")
 */
class Tarif
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="tarif", type="integer")
     */
    private $tarif;

    /**
     * @var int
     *
     * @ORM\Column(name="age_mini", type="integer", nullable=true)
     */
    private $ageMini;

    /**
     * @var int
     *
     * @ORM\Column(name="age_maxi", type="integer", nullable=true)
     */
    private $ageMaxi;


    /**
     * @ORM\OneToMany(targetEntity="Louvre\BilletterieBundle\Entity\Client", mappedBy="tarif")
     */
    private $client;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Tarif
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set tarif
     *
     * @param integer $tarif
     *
     * @return Tarif
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return int
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set ageMini
     *
     * @param integer $ageMini
     *
     * @return Tarif
     */
    public function setAgeMini($ageMini)
    {
        $this->ageMini = $ageMini;

        return $this;
    }

    /**
     * Get ageMini
     *
     * @return int
     */
    public function getAgeMini()
    {
        return $this->ageMini;
    }

    /**
     * Set ageMaxi
     *
     * @param integer $ageMaxi
     *
     * @return Tarif
     */
    public function setAgeMaxi($ageMaxi)
    {
        $this->ageMaxi = $ageMaxi;

        return $this;
    }

    /**
     * Get ageMaxi
     *
     * @return int
     */
    public function getAgeMaxi()
    {
        return $this->ageMaxi;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
        //return $this;
    }

    public function getClient()
    {
        return $this->client;
    }
}

