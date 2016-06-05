<?php

namespace bluenove\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes")
 * @ORM\Entity(repositoryClass="bluenove\PlatformBundle\Repository\LikesRepository")
 */
class Likes
{
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
     * @ORM\Column(name="count", type="integer", unique=false, nullable=true)
     */
    private $count;

    /**
     * @ORM\ManyToOne(targetEntity="bluenove\PlatformBundle\Entity\Users",  cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Users;

     /**
     * @ORM\ManyToOne(targetEntity="bluenove\PlatformBundle\Entity\Groupe",  cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Groupe;
    
     /**
     * @ORM\ManyToOne(targetEntity="bluenove\PlatformBundle\Entity\Messages",  cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $Messages;
    
     /**
     * @ORM\ManyToOne(targetEntity="bluenove\PlatformBundle\Entity\Commentaires",  cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $Commentaires;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

 
    /**
     * Set users
     *
     * @param \bluenove\PlatformBundle\Entity\Users $users
     *
     * @return Likes
     */
    public function setUsers(\bluenove\PlatformBundle\Entity\Users $users)
    {
        $this->Users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \bluenove\PlatformBundle\Entity\Users
     */
    public function getUsers()
    {
        return $this->Users;
    }

    /**
     * Set messages
     *
     * @param \bluenove\PlatformBundle\Entity\Messages $messages
     *
     * @return Likes
     */
    public function setMessages(\bluenove\PlatformBundle\Entity\Messages $messages)
    {
        $this->Messages = $messages;

        return $this;
    }

    /**
     * Get messages
     *
     * @return \bluenove\PlatformBundle\Entity\Messages
     */
    public function getMessages()
    {
        return $this->Messages;
    }

    /**
     * Set groupe
     *
     * @param \bluenove\PlatformBundle\Entity\Groupe $groupe
     *
     * @return Likes
     */
    public function setGroupe(\bluenove\PlatformBundle\Entity\Groupe $groupe)
    {
        $this->Groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return \bluenove\PlatformBundle\Entity\Groupe
     */
    public function getGroupe()
    {
        return $this->Groupe;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return Likes
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set commentaires
     *
     * @param \bluenove\PlatformBundle\Entity\Commentaires $commentaires
     *
     * @return Likes
     */
    public function setCommentaires(\bluenove\PlatformBundle\Entity\Commentaires $commentaires = null)
    {
        $this->Commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return \bluenove\PlatformBundle\Entity\Commentaires
     */
    public function getCommentaires()
    {
        return $this->Commentaires;
    }
}
