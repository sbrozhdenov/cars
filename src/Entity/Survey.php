<?php

namespace App\Entity;

use App\Repository\SurveyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SurveyRepository::class)
 */
class Survey
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
    private $eng;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gear_box;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horse_power;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $body_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $end_date;

    /**
     * Many listing have one user. This is the owning side.
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="survey")
     */
    private $user;

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

    public function getEng(): ?string
    {
        return $this->eng;
    }

    public function setEng(string $eng): self
    {
        $this->eng = $eng;

        return $this;
    }

    public function getGearBox(): ?string
    {
        return $this->gear_box;
    }

    public function setGearBox(?string $gear_box): self
    {
        $this->gear_box = $gear_box;

        return $this;
    }

    public function getHorsePower(): ?string
    {
        return $this->horse_power;
    }

    public function setHorsePower(?string $horse_power): self
    {
        $this->horse_power = $horse_power;

        return $this;
    }

    public function getBodyType(): ?string
    {
        return $this->body_type;
    }

    public function setBodyType(string $body_type): self
    {
        $this->body_type = $body_type;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getEndDate(): ?string
    {
        return $this->end_date;
    }

    public function setEndDate(string $end_date): self
    {
        $this->end_date = $end_date;

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
