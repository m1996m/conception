<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConvocationRepository")
 */
class Convocation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="convocations")
     */
    private $idPatient;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Urgence", inversedBy="convocations")
     */
    private $idUrgence;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Maternite", inversedBy="convocations")
     */
    private $idMaternite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\International", inversedBy="convocations")
     */
    private $idIinternational;

    /**
     * @ORM\Column(type="text")
     */
    private $intitule;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateConvocation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnel", inversedBy="convocation")
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

    public function getIdIinternational(): ?International
    {
        return $this->idIinternational;
    }

    public function setIdIinternational(?International $idIinternational): self
    {
        $this->idIinternational = $idIinternational;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getDateConvocation(): ?\DateTimeInterface
    {
        return $this->dateConvocation;
    }

    public function setDateConvocation(\DateTimeInterface $dateConvocation): self
    {
        $this->dateConvocation = $dateConvocation;

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
