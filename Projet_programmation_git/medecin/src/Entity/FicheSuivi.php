<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheSuiviRepository")
 */
class FicheSuivi
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="ficheSuivis")
     */
    private $idPatient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Maternite", inversedBy="ficheSuivis")
     */
    private $idMaternite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\International", inversedBy="ficheSuivis")
     */
    private $idIternational;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Urgence", inversedBy="ficheSuivis")
     */
    private $idUrgence;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnel", inversedBy="ficheSuivis")
     */
    private $idPersonnel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avi;

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


    public function getIdMaternite(): ?Maternite
    {
        return $this->idMaternite;
    }

    public function setIdMaternite(?Maternite $idMaternite): self
    {
        $this->idMaternite = $idMaternite;

        return $this;
    }

    public function getIdIternational(): ?International
    {
        return $this->idIternational;
    }

    public function setIdIternational(?International $idIternational): self
    {
        $this->idIternational = $idIternational;

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

    public function getIdPersonnel(): ?Personnel
    {
        return $this->idPersonnel;
    }

    public function setIdPersonnel(?Personnel $idPersonnel): self
    {
        $this->idPersonnel = $idPersonnel;

        return $this;
    }

    public function getAvi(): ?string
    {
        return $this->avi;
    }

    public function setAvi(?string $avi): self
    {
        $this->avi = $avi;

        return $this;
    }
}
