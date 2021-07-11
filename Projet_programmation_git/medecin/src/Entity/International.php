<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InternationalRepository")
 */
class International
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationalite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $maladie;

    /**
     * @ORM\Column(type="date")
     */
    private $debutMaladie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $financement;

    /**
     * @ORM\Column(type="date")
     */
    private $dateArrve;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Message", mappedBy="idInternational")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordonnance", mappedBy="idInternational")
     */
    private $ordonnances;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheSuivi", mappedBy="idIternational")
     */
    private $ficheSuivis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consultation", mappedBy="idInternational")
     */
    private $consultations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Convocation", mappedBy="idIinternational")
     */
    private $convocations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FichePatient", mappedBy="idInternational")
     */
    private $fichePatients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RendezVous", mappedBy="idInternational")
     */
    private $rendezVouses;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->ordonnances = new ArrayCollection();
        $this->ficheSuivis = new ArrayCollection();
        $this->consultations = new ArrayCollection();
        $this->convocations = new ArrayCollection();
        $this->fichePatients = new ArrayCollection();
        $this->rendezVouses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getMaladie(): ?string
    {
        return $this->maladie;
    }

    public function setMaladie(string $maladie): self
    {
        $this->maladie = $maladie;

        return $this;
    }

    public function getDebutMaladie(): ?\DateTimeInterface
    {
        return $this->debutMaladie;
    }

    public function setDebutMaladie(\DateTimeInterface $debutMaladie): self
    {
        $this->debutMaladie = $debutMaladie;

        return $this;
    }

    public function getFinancement(): ?string
    {
        return $this->financement;
    }

    public function setFinancement(string $financement): self
    {
        $this->financement = $financement;

        return $this;
    }

    public function getDateArrve(): ?string
    {
        return $this->dateArrve;
    }

    public function setDateArrve(string $dateArrve): self
    {
        $this->dateArrve = $dateArrve;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->addIdInternational($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            $message->removeIdInternational($this);
        }

        return $this;
    }

    /**
     * @return Collection|Ordonnance[]
     */
    public function getOrdonnances(): Collection
    {
        return $this->ordonnances;
    }

    public function addOrdonnance(Ordonnance $ordonnance): self
    {
        if (!$this->ordonnances->contains($ordonnance)) {
            $this->ordonnances[] = $ordonnance;
            $ordonnance->setIdInternational($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->contains($ordonnance)) {
            $this->ordonnances->removeElement($ordonnance);
            // set the owning side to null (unless already changed)
            if ($ordonnance->getIdInternational() === $this) {
                $ordonnance->setIdInternational(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FicheSuivi[]
     */
    public function getFicheSuivis(): Collection
    {
        return $this->ficheSuivis;
    }

    public function addFicheSuivi(FicheSuivi $ficheSuivi): self
    {
        if (!$this->ficheSuivis->contains($ficheSuivi)) {
            $this->ficheSuivis[] = $ficheSuivi;
            $ficheSuivi->setIdIternational($this);
        }

        return $this;
    }

    public function removeFicheSuivi(FicheSuivi $ficheSuivi): self
    {
        if ($this->ficheSuivis->contains($ficheSuivi)) {
            $this->ficheSuivis->removeElement($ficheSuivi);
            // set the owning side to null (unless already changed)
            if ($ficheSuivi->getIdIternational() === $this) {
                $ficheSuivi->setIdIternational(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Consultation[]
     */
    public function getConsultations(): Collection
    {
        return $this->consultations;
    }

    public function addConsultation(Consultation $consultation): self
    {
        if (!$this->consultations->contains($consultation)) {
            $this->consultations[] = $consultation;
            $consultation->setIdInternational($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->contains($consultation)) {
            $this->consultations->removeElement($consultation);
            // set the owning side to null (unless already changed)
            if ($consultation->getIdInternational() === $this) {
                $consultation->setIdInternational(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Convocation[]
     */
    public function getConvocations(): Collection
    {
        return $this->convocations;
    }

    public function addConvocation(Convocation $convocation): self
    {
        if (!$this->convocations->contains($convocation)) {
            $this->convocations[] = $convocation;
            $convocation->setIdIinternational($this);
        }

        return $this;
    }

    public function removeConvocation(Convocation $convocation): self
    {
        if ($this->convocations->contains($convocation)) {
            $this->convocations->removeElement($convocation);
            // set the owning side to null (unless already changed)
            if ($convocation->getIdIinternational() === $this) {
                $convocation->setIdIinternational(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FichePatient[]
     */
    public function getFichePatients(): Collection
    {
        return $this->fichePatients;
    }

    public function addFichePatient(FichePatient $fichePatient): self
    {
        if (!$this->fichePatients->contains($fichePatient)) {
            $this->fichePatients[] = $fichePatient;
            $fichePatient->setIdInternational($this);
        }

        return $this;
    }

    public function removeFichePatient(FichePatient $fichePatient): self
    {
        if ($this->fichePatients->contains($fichePatient)) {
            $this->fichePatients->removeElement($fichePatient);
            // set the owning side to null (unless already changed)
            if ($fichePatient->getIdInternational() === $this) {
                $fichePatient->setIdInternational(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RendezVous[]
     */
    public function getRendezVouses(): Collection
    {
        return $this->rendezVouses;
    }

    public function addRendezVouse(RendezVous $rendezVouse): self
    {
        if (!$this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses[] = $rendezVouse;
            $rendezVouse->setIdInternational($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): self
    {
        if ($this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->removeElement($rendezVouse);
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getIdInternational() === $this) {
                $rendezVouse->setIdInternational(null);
            }
        }

        return $this;
    }
}
