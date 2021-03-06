<?php

namespace Louvre\BilletterieBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="Louvre\BilletterieBundle\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\Length(
     *     min=2,
     *     max=50,
     *     minMessage = "Votre nom doit comporter au moins {{ limit }} caractères",
     *     maxMessage = "Votre nom ne doit pas comporter plus de {{ limit }} caractères."
     * )
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=3)
     */
    private $pays;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissance", type="date")
     */
    private $dateNaissance;


    /**
     * @ORM\ManyToOne(targetEntity="Louvre\BilletterieBundle\Entity\Tarif", inversedBy="client")
     * @ORM\JoinColumn(name="tarif_id", nullable=false)
     */
    private $tarif;


    public function __construct()
    {
        $this->dateNaissance = new \Datetime();
        $this->tarif = new ArrayCollection();
    }

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Client
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Client
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Client
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Client
     */
    public function setDateNaissance(\Datetime $dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

   public function getDateNaissance()
    {
        return $this->dateNaissance;
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
}

