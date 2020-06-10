<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Post
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="posts")
 */

class Post
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
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", length=2000)
     */
    private $text;

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
     * @var User|null
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts")
     */
    private $users;

    /**
     * @return User|null
     */
    public function getUsers(): ?User
    {
        return $this->users;
    }

    /**
     * @param User|null $users
     */
    public function setUsers(?User $users): void
    {
        $this->users = $users;
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
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return \DateTime
     */
    public function getCratedAt(): \DateTime
    {
        return $this->cratedAt;
    }

    /**
     * @param \DateTime $cratedAt
     */
    public function setCratedAt(\DateTime $cratedAt)
    {
        $this->cratedAt = $cratedAt;
    }

    /**
     * @return \DateTime
     */
    public function getUdatedAt(): \DateTime
    {
        return $this->udatedAt;
    }

    /**
     * @param \DateTime $udatedAt
     */
    public function setUdatedAt(\DateTime $udatedAt)
    {
        $this->udatedAt = $udatedAt;
    }
}