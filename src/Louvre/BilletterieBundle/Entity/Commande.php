<?php

namespace Louvre\BilletterieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="Louvre\BilletterieBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="coderesa", type="string", length=255)
     */
    private $coderesa;

    /**
     * @ORM\OneToMany(targetEntity="Louvre\BilletterieBundle\Entity\Billet", mappedBy="commande", cascade={"persist"})
     *
     */
    private $billets;

    public function __construct() {
        $this->billets = new ArrayCollection();
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
     * Set email
     *
     * @param string $email
     *
     * @return Commande
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
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
        return $this->coderesa;
    }

    public function addBillet(Billet $billet)
    {
        $this->billets[] = $billet;
        $billet->setCommande($this);
        return $this;
    }

    public function getBillets()
    {
        return $this->billets;
    }
}

