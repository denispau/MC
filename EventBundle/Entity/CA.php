<?php
// src/MC/EventBundle/Entity/CA.php

namespace MC\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as  Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * CA
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MC\EventBundle\Entity\CARepository")
 * @UniqueEntity(fields="nomCA", message="Un club ou une association utilise déjà ce nom")
 */
class CA
{
   
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCA", type="string", length=255, unique=true)
     * @Assert\Length(min=2, minMessage="Le nom de l'aasociation ou du club doit faire au moins {{ limit }} caractères.")
     */

    private $nomCA;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptifCA", type="text")
     * @Assert\NotBlank()
     */
    private $descriptifCA;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomCA
     *
     * @param string $nomCA
     * @return CA
     */
    public function setNomCA($nomCA)
    {
        $this->nomCA = $nomCA;

        return $this;
    }

    /**
     * Get nomCA
     *
     * @return string 
     */
    public function getNomCA()
    {
        return $this->nomCA;
    }

    /**
     * Set descriptifCA
     *
     * @param string $descriptifCA
     * @return CA
     */
    public function setDescriptifCA($descriptifCA)
    {
        $this->descriptifCA = $descriptifCA;

        return $this;
    }

    /**
     * Get descriptifCA
     *
     * @return string 
     */
    public function getDescriptifCA()
    {
        return $this->descriptifCA;
    }
}