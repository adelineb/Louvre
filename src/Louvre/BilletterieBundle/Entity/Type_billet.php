<?php

namespace Louvre\BilletterieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type_billet
 *
 * @ORM\Table(name="type_billet")
 * @ORM\Entity(repositoryClass="Louvre\BilletterieBundle\Repository\Type_billetRepository")
 */
class Type_billet
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
     * @ORM\OneToMany(targetEntity="Louvre\BilletterieBundle\Entity\Billet", mappedBy="typebillet")
     */
    private $billet;


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
     * @return Type_billet
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

    public function setBillet(Billet $billet)
    {
        $this->billet = $billet;
    }

    public function getBillet()
    {
        return $this->billet;
    }
}

