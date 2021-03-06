<?php

namespace MC\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as  Assert;

/**
 * Evenement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MC\EventBundle\Entity\EvenementRepository")
 */
class Evenement
{
     /**
     * @ORM\OneToOne(targetEntity="Image", cascade={"persist"})
     */
     private $image;

    /**
    * @ORM\ManyToMany(targetEntity="Utilisateur", mappedBy="evenement")
    */ 
    
    private $utilisateurs;

    /**
    * @ORM\ManyToMany(targetEntity="CA", mappedBy="evenement")
    */
   
    private $cas;

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
     * @ORM\Column(name="nomEvenement", type="string", length=255)
     * @Assert\Length(min=2,  minMessage="Le nom de l'�v�nement doit faire au moins {{ limit }} caract�res.")
     */
    private $nomEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="nomOrganisateur", type="string", length=255)
     * @Assert\Length(min=2, minMessage="Le nom de l'organisateur doit faire au moins {{ limit }} caract�res.")
     */
    private $nomOrganisateur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     * @Assert\DateTime()
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     * @Assert\Datetime()
     */
    private $dateFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureDebut", type="time")
     * @Assert\Time()
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="heureFin", type="time")
     * @Assert\Time()
     */
    private $heureFin;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptif", type="text")
     */
    private $descriptif;


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
     * Set nomEvenement
     *
     * @param string $nomEvenement
     * @return Evenement
     */
    public function setNomEvenement($nomEvenement)
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

    /**
     * Get nomEvenement
     *
     * @return string 
     */
    public function getNomEvenement()
    {
        return $this->nomEvenement;
    }

    /**
     * Set nomOrganisateur
     *
     * @param string $nomOrganisateur
     * @return Evenement
     */
    public function setNomOrganisateur($nomOrganisateur)
    {
        $this->nomOrganisateur = $nomOrganisateur;

        return $this;
    }

    /**
     * Get nomOrganisateur
     *
     * @return string 
     */
    public function getNomOrganisateur()
    {
        return $this->nomOrganisateur;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Evenement
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Evenement
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     * @return Evenement
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime 
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     * @return Evenement
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime 
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     * @return Evenement
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string 
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }


    /**
     * Set image
     *
     * @param \MC\EventBundle\Entity\Image $image
     * @return Evenement
     */
    public function setImage(\MC\EventBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \MC\EventBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisateurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cas = new ArrayCollection();
    }

    /**
     * Add utilisateurs
     *
     * @param \MC\EventBundle\Entity\Utilisateur $utilisateurs
     * @return Evenement
     */
    public function addUtilisateur(\MC\EventBundle\Entity\Utilisateur $utilisateurs)
    {
        $this->utilisateurs[] = $utilisateurs;

        return $this;
    }

    /**
     * Remove utilisateurs
     *
     * @param \MC\EventBundle\Entity\Utilisateur $utilisateurs
     */
    public function removeUtilisateur(\MC\EventBundle\Entity\Utilisateur $utilisateurs)
    {
        $this->utilisateurs->removeElement($utilisateurs);
    }

    /**
     * Get utilisateurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUtilisateurs()
    {
        return $this->utilisateurs;
    }

    /**
     * Add cas
     *
     * @param \MC\EventBundle\Entity\CA $cas
     * @return Evenement
     */
    public function addCa(\MC\EventBundle\Entity\CA $cas)
    {
        $this->cas[] = $cas;

        return $this;
    }

    /**
     * Remove cas
     *
     * @param \MC\EventBundle\Entity\CA $cas
     */
    public function removeCa(\MC\EventBundle\Entity\CA $cas)
    {
        $this->cas->removeElement($cas);
    }

    /**
     * Get cas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCas()
    {
        return $this->cas;
    }
}
