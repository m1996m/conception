<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsultationRepository")
 */
class Consultation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="consultations")
     */
    private $idPatient;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\International", inversedBy="consultations")
     */
    private $idInternational;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Maternite", inversedBy="consultations")
     */
    private $idMaternite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Urgence", inversedBy="consultations")
     */
    private $idUrgence;

    /**
     * @ORM\Column(type="text")
     */
    private $diagnostic;

    /**
     * @ORM\Column(type="text")
     */
    private $resultat;

    /**
     * @ORM\Column(type="date")
     */
    private $dateConsultation;

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


    public function getIdInternational(): ?International
    {
        return $this->idInternational;
    }

    public function setIdInternational(?International $idInternational): self
    {
        $this->idInternational = $idInternational;

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

    public function getIdUrgence(): ?Urgence
    {
        return $this->idUrgence;
    }

    public function setIdUrgence(?Urgence $idUrgence): self
    {
        $this->idUrgence = $idUrgence;

        return $this;
    }

    public function getDiagnostic(): ?string
    {
        return $this->diagnostic;
    }

    public function setDiagnostic(string $diagnostic): self
    {
        $this->diagnostic = $diagnostic;

        return $this;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }

    public function getDateConsultation(): ?string
    {
        return $this->dateConsultation;
    }

    public function setDateConsultation(string $dateConsultation): self
    {
        $this->dateConsultation = $dateConsultation;

        return $this;
    }
}
