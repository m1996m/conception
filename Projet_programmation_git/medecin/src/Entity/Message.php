<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Patient", inversedBy="messages")
     */
    private $idPatient;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Urgence", inversedBy="messages")
     */
    private $idUrgence;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Maternite", inversedBy="messages")
     */
    private $idMaternite;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\International", inversedBy="messages")
     */
    private $idInternational;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="date")
     */
    private $createAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnel", inversedBy="messages")
     */
    private $idPersonnel;

    public function __construct()
    {
        $this->idPatient = new ArrayCollection();
        $this->idPersonnel = new ArrayCollection();
        $this->idUrgence = new ArrayCollection();
        $this->idMaternite = new ArrayCollection();
        $this->idInternational = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Patient[]
     */
    public function getIdPatient(): Collection
    {
        return $this->idPatient;
    }

    public function addIdPatient(Patient $idPatient): self
    {
        if (!$this->idPatient->contains($idPatient)) {
            $this->idPatient[] = $idPatient;
        }

        return $this;
    }

    public function removeIdPatient(Patient $idPatient): self
    {
        if ($this->idPatient->contains($idPatient)) {
            $this->idPatient->removeElement($idPatient);
        }

        return $this;
    }


    /**
     * @return Collection|Urgence[]
     */
    public function getIdUrgence(): Collection
    {
        return $this->idUrgence;
    }

    public function addIdUrgence(Urgence $idUrgence): self
    {
        if (!$this->idUrgence->contains($idUrgence)) {
            $this->idUrgence[] = $idUrgence;
        }

        return $this;
    }

    public function removeIdUrgence(Urgence $idUrgence): self
    {
        if ($this->idUrgence->contains($idUrgence)) {
            $this->idUrgence->removeElement($idUrgence);
        }

        return $this;
    }

    /**
     * @return Collection|Maternite[]
     */
    public function getIdMaternite(): Collection
    {
        return $this->idMaternite;
    }

    public function addIdMaternite(Maternite $idMaternite): self
    {
        if (!$this->idMaternite->contains($idMaternite)) {
            $this->idMaternite[] = $idMaternite;
        }

        return $this;
    }

    public function removeIdMaternite(Maternite $idMaternite): self
    {
        if ($this->idMaternite->contains($idMaternite)) {
            $this->idMaternite->removeElement($idMaternite);
        }

        return $this;
    }

    /**
     * @return Collection|International[]
     */
    public function getIdInternational(): Collection
    {
        return $this->idInternational;
    }

    public function addIdInternational(International $idInternational): self
    {
        if (!$this->idInternational->contains($idInternational)) {
            $this->idInternational[] = $idInternational;
        }

        return $this;
    }

    public function removeIdInternational(International $idInternational): self
    {
        if ($this->idInternational->contains($idInternational)) {
            $this->idInternational->removeElement($idInternational);
        }

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

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

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
