<?php

namespace Louvre\BilletterieBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Billet
 *
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="Louvre\BilletterieBundle\Repository\BilletRepository")
 */
class Billet
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
     * @var int
     *
     * @ORM\Column(name="prix_billet", type="integer")
     */
    private $prixBillet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Louvre\BilletterieBundle\Entity\Type_billet", inversedBy="billet")
     * @ORM\JoinColumn(name="typebillet_id", nullable=false)
     */
    private $typebillet;

    /**
     * @ORM\OneToOne(targetEntity="Louvre\BilletterieBundle\Entity\Client")
     */
    private $client;


    /**
     * @ORM\ManyToOne(targetEntity="Louvre\BilletterieBundle\Entity\Commande", inversedBy="billets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;



    public function __construct()
    {
        $this->date = new \Datetime();
        $this->typebillet = new ArrayCollection();
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
     * Set prixBillet
     *
     * @param integer $prixBillet
     *
     * @return Billet
     */
    public function setPrixBillet($prixBillet)
    {
        $this->prixBillet = $prixBillet;

        return $this;
    }

    /**
     * Get prixBillet
     *
     * @return int
     */
    public function getPrixBillet()
    {
        return $this->prixBillet;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Billet
     */
    public function setDate(\Datetime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
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

    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setCommande(Commande $commande)
    {
        $this->commande = $commande;
        //return $this;
    }

    public function getCommande()
    {
        return $this->commande;
    }

}

