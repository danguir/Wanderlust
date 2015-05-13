<?php

namespace Site\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site\NewsBundle\Entity\News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity
 */
class News
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
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=15)
     */
    private $titre;
    
    /**
     * @var string $contenu
     *
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;
    
    /**
     * @var datetime $date
     *
     * @ORM\Column(name="date", type="datetime", length=30)
     */
    private $date;

        /**
     * @var boolean $etat
     *
     * @ORM\Column(name="etat", type="boolean", length=30)
     */
    private $etat;

     /**
     * @ORM\ManyToOne(targetEntity="Site\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;

    public function __construct() {
        $this->date = new \DateTime('now');
        $this->etat = false;
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
     * Set titre
     *
     * @param string $titre
     * @return News
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     * @return News
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return News
     */
    public function setDate($date)
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

    /**
     * Set etat
     *
     * @param boolean $etat
     * @return News
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    
        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean 
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set auteur
     *
     * @param \Site\UtilisateurBundle\Entity\Utilisateur $auteur
     * @return News
     */
    public function setAuteur(\Site\UtilisateurBundle\Entity\Utilisateur $auteur)
    {
        $this->auteur = $auteur;
    
        return $this;
    }

    /**
     * Get auteur
     *
     * @return \Site\UtilisateurBundle\Entity\Utilisateur 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }
}