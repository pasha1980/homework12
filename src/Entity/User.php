<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="users")
 */

class User
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string")
     */

    private $name;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $cratedAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $udatedAt;


    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Post", mappedBy="users")
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return \DateTime
     */
    public function getCratedAt(): \DateTime
    {
        return $this->cratedAt;
    }

    /**
     * @return \DateTime
     */
    public function getUdatedAt(): \DateTime
    {
        return $this->udatedAt;
    }

    /**
     * @param \DateTime $cratedAt
     */
    public function setCratedAt(\DateTime $cratedAt): void
    {
        $this->cratedAt = $cratedAt;
    }

    /**
     * @param \DateTime $udatedAt
     */
    public function setUdatedAt(\DateTime $udatedAt): void
    {
        $this->udatedAt = $udatedAt;
    }

}