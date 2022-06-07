<?php

namespace App\Entity;

use App\Repository\ListingRepository;
use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ListingRepository::class)
 * @ORM\Table(name="`listing`")
 */
class Listing
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mark;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $odometar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gear_box;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fuelf;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $owners;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $horse_power;

    /**
     * @ORM\Column(type="array")
     */
    private $path;

    /**
     * @ORM\Column(type="datetime",  nullable=false)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $year;

    /**
     * Many listing have one user. This is the owning side.
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="listing")
     */
    private $user;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?string
    {
        return $this->mark;
    }

    public function setMark(string $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getOdometar(): ?string
    {
        return $this->odometar;
    }

    public function setOdometar(string $odometar): self
    {
        $this->odometar = $odometar;

        return $this;
    }

    public function getGearBox(): ?string
    {
        return $this->gear_box;
    }

    public function setGearBox(string $gear_box): self
    {
        $this->gear_box = $gear_box;

        return $this;
    }

    public function getFuelf(): ?string
    {
        return $this->fuelf;
    }

    public function setFuelf(string $fuelf): self
    {
        $this->fuelf = $fuelf;

        return $this;
    }

    public function getOwners(): ?string
    {
        return $this->owners;
    }

    public function setOwners(string $owners): self
    {
        $this->owners = $owners;

        return $this;
    }

    public function getHorsePower(): ?string
    {
        return $this->horse_power;
    }

    public function setHorsePower(string $horse_power): self
    {
        $this->horse_power = $horse_power;

        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        if (!$this->created_at) {
            $this->created_at = new \DateTime();
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
