<?php

namespace bluenove\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="bluenove\PlatformBundle\Repository\UsersRepository")
 */
class Users {

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;
    
     /**
     * @var string
     *
     * @ORM\Column(name="job_title", type="string", length=255, unique=false, nullable=true)
     */
    private $jobTitle;
    
     /**
     * @var string
     *
     * @ORM\Column(name="departement", type="string", length=255, unique=false, nullable=true)
     */
    private $departement;
    
     /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=false, nullable=true)
     */
    private $email;

      /**
     * @var string
     *
     * @ORM\Column(name="network_name", type="string", length=255, unique=false, nullable=true)
     */
    private $networkName;
    
    
    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer", unique=true, nullable=true)
     */
    private $userId;
    
     /**
     * @var int
     *
     * @ORM\Column(name="phone_Numbers", type="integer", unique=false, nullable=true)
     */
    private $phoneNumbers;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_likes", type="integer", unique=false, nullable=true)
     */
    private $nbLikes;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_tem_likes", type="integer", unique=false, nullable=true)
     */
    private $nbTempLikes;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_post", type="integer", unique=false, nullable=true)
     */
    private $nbPost;
    /**
     * @var int
     *
     * @ORM\Column(name="nb_temp_post", type="integer", unique=false, nullable=true)
     */
    private $nbTempPost;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_com", type="integer", unique=false, nullable=true)
     */
    private $nbCom;
     /**
     * @var int
     *
     * @ORM\Column(name="nb_temp_com", type="integer", unique=false, nullable=true)
     */
    private $nbTempCom;
    
     /**
     * @var int
     *
     * @ORM\Column(name="nb_publi", type="integer", unique=false, nullable=true)
     */
    private $nbPubli;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date_last_publi", type="datetime", unique=false, nullable=true)
     */
    private $dateLastPubli;
      /**
     * @var datetime
     *
     * @ORM\Column(name="date_last_publi_temp", type="datetime", unique=false, nullable=true)
     */
    private $dateLastPubliTemp;
    
     /**
     * @var datetime
     *
     * @ORM\Column(name="date_inscription", type="datetime", unique=false, nullable=false)
     */
    private $dateInscription;
     /**
     * @var int
     *
     * @ORM\Column(name="app_G", type="integer", unique=false, nullable=true)
     */
    private $appG;
    
    /**
     * @ORM\ManyToMany(targetEntity="bluenove\PlatformBundle\Entity\Users", cascade={"persist"}, mappedBy="Users")
     */
    private $Groupes;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Users
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Users
     */
    public function setUserId($userId) {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Set nbPost
     *
     * @param integer $nbPost
     *
     * @return Users
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
     * @return Users
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
     * Set dateLastPubli
     *
     * @param \datetime $dateLastPubli
     *
     * @return Users
     */
    public function setDateLastPubli(\datetime $dateLastPubli) {
        $this->dateLastPubli = $dateLastPubli;

        return $this;
    }

    /**
     * Get dateLastPubli
     *
     * @return \datetime
     */
    public function getDateLastPubli() {
        return $this->dateLastPubli;
    }

    /**
     * Set nbLikes
     *
     * @param integer $nbLikes
     *
     * @return Users
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
     * Set nbTempLikes
     *
     * @param integer $nbTempLikes
     *
     * @return Users
     */
    public function setNbTempLikes($nbTempLikes)
    {
        $this->nbTempLikes = $nbTempLikes;

        return $this;
    }

    /**
     * Get nbTempLikes
     *
     * @return integer
     */
    public function getNbTempLikes()
    {
        return $this->nbTempLikes;
    }

    /**
     * Set nbTempPost
     *
     * @param integer $nbTempPost
     *
     * @return Users
     */
    public function setNbTempPost($nbTempPost)
    {
        $this->nbTempPost = $nbTempPost;

        return $this;
    }

    /**
     * Get nbTempPost
     *
     * @return integer
     */
    public function getNbTempPost()
    {
        return $this->nbTempPost;
    }

    /**
     * Set nbTempCom
     *
     * @param integer $nbTempCom
     *
     * @return Users
     */
    public function setNbTempCom($nbTempCom)
    {
        $this->nbTempCom = $nbTempCom;

        return $this;
    }

    /**
     * Get nbTempCom
     *
     * @return integer
     */
    public function getNbTempCom()
    {
        return $this->nbTempCom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Groupes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add groupe
     *
     * @param \bluenove\PlatformBundle\Entity\Users $groupe
     *
     * @return Users
     */
    public function addGroupe(\bluenove\PlatformBundle\Entity\Users $groupe)
    {
        $this->Groupes[] = $groupe;

        return $this;
    }

    /**
     * Remove groupe
     *
     * @param \bluenove\PlatformBundle\Entity\Users $groupe
     */
    public function removeGroupe(\bluenove\PlatformBundle\Entity\Users $groupe)
    {
        $this->Groupes->removeElement($groupe);
    }

    /**
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupes()
    {
        return $this->Groupes;
    }

    /**
     * Set jobTitle
     *
     * @param string $jobTitle
     *
     * @return Users
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get jobTitle
     *
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set departement
     *
     * @param string $departement
     *
     * @return Users
     */
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Get departement
     *
     * @return string
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Users
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

    /**
     * Set networkName
     *
     * @param string $networkName
     *
     * @return Users
     */
    public function setNetworkName($networkName)
    {
        $this->networkName = $networkName;

        return $this;
    }

    /**
     * Get networkName
     *
     * @return string
     */
    public function getNetworkName()
    {
        return $this->networkName;
    }

    /**
     * Set phoneNumbers
     *
     * @param integer $phoneNumbers
     *
     * @return Users
     */
    public function setPhoneNumbers($phoneNumbers)
    {
        $this->phoneNumbers = $phoneNumbers;

        return $this;
    }

    /**
     * Get phoneNumbers
     *
     * @return integer
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * Set nbPubli
     *
     * @param integer $nbPubli
     *
     * @return Users
     */
    public function setNbPubli($nbPubli)
    {
        $this->nbPubli = $nbPubli;

        return $this;
    }

    /**
     * Get nbPubli
     *
     * @return integer
     */
    public function getNbPubli()
    {
        return $this->nbPubli;
    }

    /**
     * Set dateInscription
     *
     * @param \DateTime $dateInscription
     *
     * @return Users
     */
    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription
     *
     * @return \DateTime
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set dateLastPubliTemp
     *
     * @param \DateTime $dateLastPubliTemp
     *
     * @return Users
     */
    public function setDateLastPubliTemp($dateLastPubliTemp)
    {
        $this->dateLastPubliTemp = $dateLastPubliTemp;

        return $this;
    }

    /**
     * Get dateLastPubliTemp
     *
     * @return \DateTime
     */
    public function getDateLastPubliTemp()
    {
        return $this->dateLastPubliTemp;
    }

    /**
     * Set appG
     *
     * @param integer $appG
     *
     * @return Users
     */
    public function setAppG($appG)
    {
        $this->appG = $appG;

        return $this;
    }

    /**
     * Get appG
     *
     * @return integer
     */
    public function getAppG()
    {
        return $this->appG;
    }
}
