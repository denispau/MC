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
  * @ORM\ManyToOne(targetEntity="CA", inversedBy="evenement")
  * @ORM\JoinColumn(name="CA_id", referencedColumnName="id")
  * @Assert\Valid()
  */

  /**
  * @ORM\ManyToOne(targetEntity="Theme", inversedBy="evenement")
  * @ORM\JoinColumn(name="Theme_id", referencedColumnName="id")
  */

  /**
  * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="evenement")
  * @ORM\JoinColumn(name="Utilisateur_id", referencedColumnName="id")
  */

  /**
  * @ORM\OneToOne(targetEntity="Image", mappedBy="evenement", @ORM\OneToOne(targetEntity="OC\PlatformBundle\Entity\Image", cascade={"persist"}))
  */

  protected $ca;
  protected $theme;
  protected $utilisateur;
  private $image;

  public function __construct()
{
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
     * @ORM\Column(name="nomEvenement", type="string", length=255)
     * @Assert\Length(min=2,  message="Le nom de l'événement doit faire au moins {{ limit }} caractères.")
     */
    private $nomEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="nomOrganisateur", type="string", length=255)
     * @Assert\Length(min=2, message="Le nom de l'organisateur doit faire au moins {{ limit }} caractères.")
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

    public function setImage(Image $image = null)
    {
      $this->image = $image;

      return $this;
    }

    public function getImage()
    {
      return $this->image;
    }
}