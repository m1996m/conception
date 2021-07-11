<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaterniteRepository")
 */
class Maternite
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
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @ORM\Column(type="date")
     */
    private $debutGrossesse;

    /**
     * @ORM\Column(type="date")
     */
    private $accouchementPrevu;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Message", mappedBy="idMaternite")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordonnance", mappedBy="idMaternite")
     */
    private $ordonnances;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheSuivi", mappedBy="idMaternite")
     */
    private $ficheSuivis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consultation", mappedBy="idMaternite")
     */
    private $consultations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Convocation", mappedBy="idMaternite")
     */
    private $convocations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FichePatient", mappedBy="idMaternite")
     */
    private $fichePatients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RendezVous", mappedBy="idMaternite")
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

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getDebutGrossesse(): ?\DateTimeInterface
    {
        return $this->debutGrossesse;
    }

    public function setDebutGrossesse(\DateTimeInterface $debutGrossesse): self
    {
        $this->debutGrossesse = $debutGrossesse;

        return $this;
    }

    public function getAccouchementPrevu(): ?\DateTimeInterface
    {
        return $this->accouchementPrevu;
    }

    public function setAccouchementPrevu(\DateTimeInterface $accouchementPrevu): self
    {
        $this->accouchementPrevu = $accouchementPrevu;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $message->addIdMaternite($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            $message->removeIdMaternite($this);
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
            $ordonnance->setIdMaternite($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->contains($ordonnance)) {
            $this->ordonnances->removeElement($ordonnance);
            // set the owning side to null (unless already changed)
            if ($ordonnance->getIdMaternite() === $this) {
                $ordonnance->setIdMaternite(null);
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
            $ficheSuivi->setIdMaternite($this);
        }

        return $this;
    }

    public function removeFicheSuivi(FicheSuivi $ficheSuivi): self
    {
        if ($this->ficheSuivis->contains($ficheSuivi)) {
            $this->ficheSuivis->removeElement($ficheSuivi);
            // set the owning side to null (unless already changed)
            if ($ficheSuivi->getIdMaternite() === $this) {
                $ficheSuivi->setIdMaternite(null);
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
            $consultation->setIdMaternite($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->contains($consultation)) {
            $this->consultations->removeElement($consultation);
            // set the owning side to null (unless already changed)
            if ($consultation->getIdMaternite() === $this) {
                $consultation->setIdMaternite(null);
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
            $convocation->setIdMaternite($this);
        }

        return $this;
    }

    public function removeConvocation(Convocation $convocation): self
    {
        if ($this->convocations->contains($convocation)) {
            $this->convocations->removeElement($convocation);
            // set the owning side to null (unless already changed)
            if ($convocation->getIdMaternite() === $this) {
                $convocation->setIdMaternite(null);
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
            $fichePatient->setIdMaternite($this);
        }

        return $this;
    }

    public function removeFichePatient(FichePatient $fichePatient): self
    {
        if ($this->fichePatients->contains($fichePatient)) {
            $this->fichePatients->removeElement($fichePatient);
            // set the owning side to null (unless already changed)
            if ($fichePatient->getIdMaternite() === $this) {
                $fichePatient->setIdMaternite(null);
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
            $rendezVouse->setIdMaternite($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): self
    {
        if ($this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->removeElement($rendezVouse);
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getIdMaternite() === $this) {
                $rendezVouse->setIdMaternite(null);
            }
        }

        return $this;
    }
}
