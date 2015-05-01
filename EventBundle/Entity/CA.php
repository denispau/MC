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
    * @ORM\ManyToOne(targetEntity="Evenement", mappedBy="ca")
    */
    /**
    * @ORM\ManyToOne(targetEntity="Theme", mappedBy="ca")
    */
    /**
    * @ORM\ManyToOne(targetEntity="Utilisateur", mappedBy="ca")
    */
    /**
    * @ORM\OneToOne(targetEntity="Image", mappedBy="ca", cascade={"persist"}))
    */
    /**
    * @ORM\ManyToOne (targetEntity=Contact", inversedBy="ca")
    * @ORM\JoinColumn(name="Contact_id", referencedColumnName ="id")
    */

 private $evenement;
 private $theme;
 private $utilisateur;
 private $image;
 protected $contact;

 public function __construct()
 {
    $this->evenement = new ArrayCollection();
    $this->theme = new ArrayCollection();
    $this->utilisateur = new ArrayCollection();
    $this->image = new ArrayCollection();
 }
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
     * @Assert\Length(min=2, message="Le nom de l'aasociation ou du club doit faire au moins {{ limit }} caractères.")
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
     * @var string
     *
     * @ORM\Column(name="logoCA", type="string", length=255)
     * @Assert\Url()
     */
    private $logoCA;


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

   
   public function setEvenement(Evenement $evenement = null)
   {
        $this->evenement = $evenement;

        return $this;
   }

   public function getEvenement()
   {
        return $this->evenement;
   }

   public function setTheme(Theme $theme = null)
    {
        $this->theme=$theme;

        return $this;
    }

    public function getTheme()
    {
        return $this->theme;
    }

    public function setUtilisateur(Utilisateur $utilisateur = null)
    {
        $this->utilisateur=$utilisateur;

        return $this;
    }

    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    public function setImage(Image $image = null)
    {
        $this->image=$image;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }
}