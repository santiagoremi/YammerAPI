<?php

namespace bluenove\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaires
 *
 * @ORM\Table(name="commentaires")
 * @ORM\Entity(repositoryClass="bluenove\PlatformBundle\Repository\CommentairesRepository")
 */
class Commentaires {

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
     * @ORM\Column(name="idCommentaire", type="integer", length=255, unique=true)
     */
    private $idCommentaire;

    /**
     * @var int
     *
     * @ORM\Column(name="idMessages", type="integer", unique=false)
     */
    private $idMessages;

    /**
     * @var int
     *
     * @ORM\Column(name="idLikes", type="integer", unique=false,  nullable=true)
     */
    private $nbLikes;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", nullable=true)
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReception", type="datetime", nullable=true)
     */
    private $dateReception;

    /**
     * @ORM\ManyToOne(targetEntity="bluenove\PlatformBundle\Entity\Groupe",  cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Groupe;

    /**
     * @ORM\ManyToOne(targetEntity="bluenove\PlatformBundle\Entity\Users",  cascade={"persist"})
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
     * Set idCommentaire
     *
     * @param string $idCommentaire
     *
     * @return Commentaires
     */
    public function setIdCommentaire($idCommentaire) {
        $this->idCommentaire = $idCommentaire;

        return $this;
    }

    /**
     * Get idCommentaire
     *
     * @return string
     */
    public function getIdCommentaire() {
        return $this->idCommentaire;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Commentaires
     */
    public function setBody($body) {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody() {
        return $this->body;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Commentaires
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set dateReception
     *
     * @param \DateTime $dateReception
     *
     * @return Commentaires
     */
    public function setDateReception($dateReception) {
        $this->dateReception = $dateReception;

        return $this;
    }

    /**
     * Get dateReception
     *
     * @return \DateTime
     */
    public function getDateReception() {
        return $this->dateReception;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Commentaires
     */
    public function setLink($link) {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink() {
        return $this->link;
    }

    /**
     * Set messages
     *
     * @param \bluenove\PlatformBundle\Entity\Messages $messages
     *
     * @return Commentaires
     */
    public function setMessages(\bluenove\PlatformBundle\Entity\Messages $messages) {
        $this->Messages = $messages;

        return $this;
    }

    /**
     * Get messages
     *
     * @return \bluenove\PlatformBundle\Entity\Messages
     */
    public function getMessages() {
        return $this->Messages;
    }

    /**
     * Set users
     *
     * @param \bluenove\PlatformBundle\Entity\Users $users
     *
     * @return Commentaires
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
     * Set groupe
     *
     * @param \bluenove\PlatformBundle\Entity\Groupe $groupe
     *
     * @return Commentaires
     */
    public function setGroupe(\bluenove\PlatformBundle\Entity\Groupe $groupe) {
        $this->Groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return \bluenove\PlatformBundle\Entity\Groupe
     */
    public function getGroupe() {
        return $this->Groupe;
    }

    /**
     * Set idMessages
     *
     * @param integer $idMessages
     *
     * @return Commentaires
     */
    public function setIdMessages($idMessages) {
        $this->idMessages = $idMessages;

        return $this;
    }

    /**
     * Get idMessages
     *
     * @return integer
     */
    public function getIdMessages() {
        return $this->idMessages;
    }


    /**
     * Set nbLikes
     *
     * @param integer $nbLikes
     *
     * @return Commentaires
     */
    public function setNbLikes($nbLikes)
    {
        $this->nbLikes = $nbLikes;

        return $this;
    }

    /**
     * Get nbLikes
     *
     * @return integer
     */
    public function getNbLikes()
    {
        return $this->nbLikes;
    }
}
