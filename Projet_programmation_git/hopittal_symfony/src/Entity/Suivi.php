<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SuiviRepository")
 */
class Suivi
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="suivis")
     */
    private $patient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Personnel", inversedBy="suivis")
     */
    private $personnel;

    /**
     * @ORM\Column(type="datetime")
     */
    private $cretedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContenuSuivi", mappedBy="suivi")
     */
    private $contenuSuivis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recommandation", mappedBy="suivi")
     */
    private $recommandations;

    public function __construct()
    {
        $this->contenuSuivis = new ArrayCollection();
        $this->recommandations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getPersonnel(): ?Personnel
    {
        return $this->personnel;
    }

    public function setPersonnel(?Personnel $personnel): self
    {
        $this->personnel = $personnel;

        return $this;
    }

    public function getCretedAt(): ?\DateTimeInterface
    {
        return $this->cretedAt;
    }

    public function setCretedAt(\DateTimeInterface $cretedAt): self
    {
        $this->cretedAt = $cretedAt;

        return $this;
    }

    /**
     * @return Collection|ContenuSuivi[]
     */
    public function getContenuSuivis(): Collection
    {
        return $this->contenuSuivis;
    }

    public function addContenuSuivi(ContenuSuivi $contenuSuivi): self
    {
        if (!$this->contenuSuivis->contains($contenuSuivi)) {
            $this->contenuSuivis[] = $contenuSuivi;
            $contenuSuivi->setSuivi($this);
        }

        return $this;
    }

    public function removeContenuSuivi(ContenuSuivi $contenuSuivi): self
    {
        if ($this->contenuSuivis->contains($contenuSuivi)) {
            $this->contenuSuivis->removeElement($contenuSuivi);
            // set the owning side to null (unless already changed)
            if ($contenuSuivi->getSuivi() === $this) {
                $contenuSuivi->setSuivi(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Recommandation[]
     */
    public function getRecommandations(): Collection
    {
        return $this->recommandations;
    }

    public function addRecommandation(Recommandation $recommandation): self
    {
        if (!$this->recommandations->contains($recommandation)) {
            $this->recommandations[] = $recommandation;
            $recommandation->setSuivi($this);
        }

        return $this;
    }

    public function removeRecommandation(Recommandation $recommandation): self
    {
        if ($this->recommandations->contains($recommandation)) {
            $this->recommandations->removeElement($recommandation);
            // set the owning side to null (unless already changed)
            if ($recommandation->getSuivi() === $this) {
                $recommandation->setSuivi(null);
            }
        }

        return $this;
    }
}
