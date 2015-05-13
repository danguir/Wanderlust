<?php

namespace Site\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Album
 *
 * @ORM\Table(name="album")
 * @ORM\Entity(repositoryClass="Site\MediaBundle\Entity\AlbumRepository")
 * @UniqueEntity(fields="nom", message="Ce nom est déjà utilisé !")
 */
class Album
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    
    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var \DateTime $datetime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;
    
    /**
     * @ORM\ManyToOne(targetEntity="Site\MediaBundle\Entity\Date")
     * @ORM\JoinColumn(nullable=false)
     */
    private $annee;

    /**
     * @var string $couverture
     *
     * @ORM\Column(name="couverture", type="string", length=255)
     */
    private $couverture;

    /**
     * @var integer $etat
     *
     * @ORM\Column(name="etat", type="integer")
     */
    private $etat;
    
    public function __construct()
    {
        $this->datetime = new \DateTime('now');
        $this->etat = true;
        $this->couverture = 'Default.png';
    }



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
     * Set nom
     *
     * @param string $nom
     * @return Album
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
     * Set slug
     *
     * @param string $slug
     * @return Album
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return Album
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    
        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set couverture
     *
     * @param string $couverture
     * @return Album
     */
    public function setCouverture($couverture)
    {
        $this->couverture = $couverture;
    
        return $this;
    }

    /**
     * Get couverture
     *
     * @return string 
     */
    public function getCouverture()
    {
        return $this->couverture;
    }

    /**
     * Set etat
     *
     * @param integer $etat
     * @return Album
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    
        return $this;
    }

    /**
     * Get etat
     *
     * @return integer 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set annee
     *
     * @param \Site\MediaBundle\Entity\Date $annee
     * @return Album
     */
    public function setAnnee(\Site\MediaBundle\Entity\Date $annee)
    {
        $this->annee = $annee;
    
        return $this;
    }

    /**
     * Get annee
     *
     * @return \Site\MediaBundle\Entity\Date 
     */
    public function getAnnee()
    {
        return $this->annee;
    }
}