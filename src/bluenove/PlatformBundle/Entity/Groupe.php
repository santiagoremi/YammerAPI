<?php

namespace bluenove\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe")
 * @ORM\Entity(repositoryClass="bluenove\PlatformBundle\Repository\GroupeRepository")
 */
class Groupe {

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
     * @ORM\Column(name="id_groupe", type="integer", unique=true)
     */
    private $idGroupe;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="privacy", type="string", length=255)
     */
    private $privacy;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_members", type="integer", unique=false, nullable=true)
     */
    private $nbMembers;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_likes", type="integer", unique=false, nullable=true)
     */
    private $nbLikes;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_post", type="integer", unique=false, nullable=true)
     */
    private $nbPost;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_com", type="integer", unique=false, nullable=true)
     */
    private $nbCom;
    
       /**
     * @var int
     *
     * @ORM\Column(name="id_last_message", type="integer", unique=false, nullable=true)
     */
    private $idLastMessage;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_creation", type="datetime", unique=false, nullable=true)
     */
    private $dateCreation;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_last_publi", type="datetime", unique=false, nullable=true)
     */
    private $dateLastPubli;


    /**
     * @ORM\ManyToMany(targetEntity="bluenove\PlatformBundle\Entity\Users", cascade={"persist"}, inversedBy="Groupes")
     * @ORM\JoinTable(name="groupe_user")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Users;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idGroupe
     *
     * @param integer $idGroupe
     *
     * @return Groupe
     */
    public function setIdGroupe($idGroupe) {
        $this->idGroupe = $idGroupe;

        return $this;
    }

    /**
     * Get idGroupe
     *
     * @return int
     */
    public function getIdGroupe() {
        return $this->idGroupe;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Groupe
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set privacy
     *
     * @param string $privacy
     *
     * @return Groupe
     */
    public function setPrivacy($privacy) {
        $this->privacy = $privacy;

        return $this;
    }

    /**
     * Get privacy
     *
     * @return string
     */
    public function getPrivacy() {
        return $this->privacy;
    }

    /**
     * Set members
     *
     * @param integer $members
     *
     * @return Groupe
     */
    public function setMembers($members) {
        $this->members = $members;

        return $this;
    }

    /**
     * Get members
     *
     * @return int
     */
    public function getMembers() {
        return $this->members;
    }

    /**
     * Set nbMembers
     *
     * @param integer $nbMembers
     *
     * @return Groupe
     */
    public function setNbMembers($nbMembers) {
        $this->nbMembers = $nbMembers;

        return $this;
    }

    /**
     * Get nbMembers
     *
     * @return integer
     */
    public function getNbMembers() {
        return $this->nbMembers;
    }

    /**
     * Set nbLikes
     *
     * @param integer $nbLikes
     *
     * @return Groupe
     */
    public function setNbLikes($nbLikes) {
        $this->nbLikes = $nbLikes;

        return $this;
    }

    /**
     * Get nbLikes
     *
     * @return integer
     */
    public function getNbLikes() {
        return $this->nbLikes;
    }

    /**
     * Set nbPost
     *
     * @param integer $nbPost
     *
     * @return Groupe
     */
    public function setNbPost($nbPost) {
        $this->nbPost = $nbPost;

        return $this;
    }

    /**
     * Get nbPost
     *
     * @return integer
     */
    public function getNbPost() {
        return $this->nbPost;
    }

    /**
     * Set nbCom
     *
     * @param integer $nbCom
     *
     * @return Groupe
     */
    public function setNbCom($nbCom) {
        $this->nbCom = $nbCom;

        return $this;
    }

    /**
     * Get nbCom
     *
     * @return integer
     */
    public function getNbCom() {
        return $this->nbCom;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Groupe
     */
    public function setDateCreation($dateCreation) {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation() {
        return $this->dateCreation;
    }

    /**
     * Set dateLastPubli
     *
     * @param \DateTime $dateLastPubli
     *
     * @return Groupe
     */
    public function setDateLastPubli(\datetime $dateLastPubli) {
        $this->dateLastPubli = $dateLastPubli;

        return $this;
    }

    /**
     * Get dateLastPubli
     *
     * @return \DateTime
     */
    public function getDateLastPubli() {
        return $this->dateLastPubli;
    }

    /**
     * Set users
     *
     * @param \bluenove\PlatformBundle\Entity\Users $users
     *
     * @return Groupe
     */
    public function setUsers(\bluenove\PlatformBundle\Entity\Users $users) {
        $this->Users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \bluenove\PlatformBundle\Entity\Users
     */
    public function getUsers() {
        return $this->Users;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->Users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \bluenove\PlatformBundle\Entity\Users $user
     *
     * @return Groupe
     */
    public function addUser(\bluenove\PlatformBundle\Entity\Users $user) {
        $this->Users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \bluenove\PlatformBundle\Entity\Users $user
     */
    public function removeUser(\bluenove\PlatformBundle\Entity\Users $user) {
        $this->Users->removeElement($user);
    }


    /**
     * Set idLastMessage
     *
     * @param integer $idLastMessage
     *
     * @return Groupe
     */
    public function setIdLastMessage($idLastMessage)
    {
        $this->idLastMessage = $idLastMessage;

        return $this;
    }

    /**
     * Get idLastMessage
     *
     * @return integer
     */
    public function getIdLastMessage()
    {
        return $this->idLastMessage;
    }
}
