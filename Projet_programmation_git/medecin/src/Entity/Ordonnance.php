<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdonnanceRepository")
 */
class Ordonnance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="ordonnances")
     */
    private $idPatient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Urgence", inversedBy="ordonnances")
     */
    private $idUrgence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Maternite", inversedBy="ordonnances")
     */
    private $idMaternite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\International", inversedBy="ordonnances")
     */
    private $idInternational;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnel", inversedBy="ordonnances")
     */
    private $idPersonnel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPatient(): ?Patient
    {
        return $this->idPatient;
    }

    public function setIdPatient(?Patient $idPatient): self
    {
        $this->idPatient = $idPatient;

        return $this;
    }

    public function getIdUrgence(): ?Urgence
    {
        return $this->idUrgence;
    }

    public function setIdUrgence(?Urgence $idUrgence): self
    {
        $this->idUrgence = $idUrgence;

        return $this;
    }

    public function getIdMaternite(): ?Maternite
    {
        return $this->idMaternite;
    }

    public function setIdMaternite(?Maternite $idMaternite): self
    {
        $this->idMaternite = $idMaternite;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getIdInternational(): ?International
    {
        return $this->idInternational;
    }

    public function setIdInternational(?International $idInternational): self
    {
        $this->idInternational = $idInternational;

        return $this;
    }

    public function getIdPersonnel(): ?Personnel
    {
        return $this->idPersonnel;
    }

    public function setIdPersonnel(?Personnel $idPersonnel): self
    {
        $this->idPersonnel = $idPersonnel;

        return $this;
    }
}
