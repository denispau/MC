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
 * @UniqueEntity(fields="nomCA", message="Un club ou une association utilise dÃ©jÃ  ce nom")
 */
class CA
{
    /**
    * @ORM\OneToOne(targetEntity="Image", cascade={"persist"})
    */

    private $image;

    /**
    * @ORM\ManyToMany(targetEntity="Evenement", inversedBy="ca", cascade={"persist"})
    */
    
    private $evenements;

   /**
   * @ORM\ManyToMany(targetEntity="Contact")
   */

    private $contacts;  

   /**
   * @ORM\ManyToMany(targetEntity="Utilisateur", mappedBy="ca")
   */
   
   private $utilisateurs;  

   /**
   * @ORM\ManyToMany(targetEntity="Administrateur", inversedBy="cas")
   */

   private $administrateurs;

public function __construct()
{
 
  $this->evenements = new ArrayCollection();
  $this->image= new ArrayCollection();
  $this->contacts = new ArrayCollection();
  $this->utilisateurs = new ArrayCollection();
  $this->administrateurs = new ArrayCollection();
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
     * @Assert\Length(min=2, minMessage="Le nom de l'aasociation ou du club doit faire au moins {{ limit }} caractÃ¨res.")
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

    /**
     * Set image
     *
     * @param \MCEventBundle\Entity\Image $image
     * @return CA
     */
    public function setImage(\MCEventBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \MCEventBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add evenements
     *
     * @param \MC\EventBundle\Entity\Evenement $evenements
     * @return CA
     */
    public function addEvenement(\MC\EventBundle\Entity\Evenement $evenements)
    {
        $this->evenements[] = $evenements;

        return $this;
    }

    /**
     * Remove evenements
     *
     * @param \MC\EventBundle\Entity\Evenement $evenements
     */
    public function removeEvenement(\MC\EventBundle\Entity\Evenement $evenements)
    {
        $this->evenements->removeElement($evenements);
    }

    /**
     * Get evenements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvenements()
    {
        return $this->evenements;
    }

    /**
     * Add contacts
     *
     * @param \MC\EventBundle\Entity\Contact $contacts
     * @return CA
     */
    public function addContact(\MC\EventBundle\Entity\Contact $contacts)
    {
        $this->contacts[] = $contacts;

        return $this;
    }

    /**
     * Remove contacts
     *
     * @param \MC\EventBundle\Entity\Contact $contacts
     */
    public function removeContact(\MC\EventBundle\Entity\Contact $contacts)
    {
        $this->contacts->removeElement($contacts);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Add utilisateurs
     *
     * @param \MC\EventBundle\Entity\Utilisateur $utilisateurs
     * @return CA
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
     * Add administrateurs
     *
     * @param \MC\EventBundle\Entity\Administrateur $administrateurs
     * @return CA
     */
    public function addAdministrateur(\MC\EventBundle\Entity\Administrateur $administrateurs)
    {
        $this->administrateurs[] = $administrateurs;

        return $this;
    }

    /**
     * Remove administrateurs
     *
     * @param \MC\EventBundle\Entity\Administrateur $administrateurs
     */
    public function removeAdministrateur(\MC\EventBundle\Entity\Administrateur $administrateurs)
    {
        $this->administrateurs->removeElement($administrateurs);
    }

    /**
     * Get administrateurs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdministrateurs()
    {
        return $this->administrateurs;
    }
}
