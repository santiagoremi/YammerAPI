<?php

namespace bluenove\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * test2
 *
 * @ORM\Table(name="test2")
 * @ORM\Entity(repositoryClass="bluenove\PlatformBundle\Repository\test2Repository")
 */
class test2
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
     * @var array
     *
     * @ORM\Column(name="array", type="array")
     */
    private $array;


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
     * Set array
     *
     * @param array $array
     *
     * @return test2
     */
    public function setArray($array)
    {
        $this->array = $array;

        return $this;
    }

    /**
     * Get array
     *
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }
}

