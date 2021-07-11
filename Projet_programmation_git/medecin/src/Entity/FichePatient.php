<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FichePatientRepository")
 */
class FichePatient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Maternite", inversedBy="fichePatients")
     */
    private $idMaternite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\International", inversedBy="fichePatients")
     */
    private $idInternational;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Urgence", inversedBy="fichePatients")
     */
    private $idUrgence;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="fichePatients")
     */
    private $idPatient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnel", inversedBy="fichePatients")
     */
    private $idPersonnel;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdInternational(): ?International
    {
        return $this->idInternational;
    }

    public function setIdInternational(?International $idInternational): self
    {
        $this->idInternational = $idInternational;

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

    public function getIdPatient(): ?Patient
    {
        return $this->idPatient;
    }

    public function setIdPatient(?Patient $idPatient): self
    {
        $this->idPatient = $idPatient;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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
