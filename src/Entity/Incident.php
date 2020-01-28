<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncidentRepository")
 */
class Incident
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $incidenttype;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @ORM\Column(type="array")
     */
    private $complainant = [];

    /**
     * @ORM\Column(type="array")
     */
    private $defendant = [];

    /**
     * @ORM\Column(type="text")
     */
    private $statement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIncidenttype(): ?string
    {
        return $this->incidenttype;
    }

    public function setIncidenttype(string $incidenttype): self
    {
        $this->incidenttype = $incidenttype;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getComplainant(): ?array
    {
        return $this->complainant;
    }

    public function setComplainant(array $complainant): self
    {
        $this->complainant = $complainant;

        return $this;
    }

    public function getDefendant(): ?array
    {
        return $this->defendant;
    }

    public function setDefendant(array $defendant): self
    {
        $this->defendant = $defendant;

        return $this;
    }

    public function getStatement(): ?string
    {
        return $this->statement;
    }

    public function setStatement(string $statement): self
    {
        $this->statement = $statement;

        return $this;
    }
}
