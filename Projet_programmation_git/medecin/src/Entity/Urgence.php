<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UrgenceRepository")
 */
class Urgence
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
    private $financement;

    /**
     * @ORM\Column(type="date")
     */
    private $dateArrive;

    /**
     * @ORM\Column(type="time")
     */
    private $heure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $suivi;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Message", mappedBy="idUrgence")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordonnance", mappedBy="idUrgence")
     */
    private $ordonnances;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheSuivi", mappedBy="idUrgence")
     */
    private $ficheSuivis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consultation", mappedBy="idUrgence")
     */
    private $consultations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Convocation", mappedBy="idUrgence")
     */
    private $convocations;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FichePatient", mappedBy="idUrgence")
     */
    private $fichePatients;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Personnel", inversedBy="urgences")
     */
    private $idPersonnel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RendezVous", mappedBy="idUrgence")
     */
    private $rendezVouses;

    public function __construct()
    {
        $this->idPersonnel = new ArrayCollection();
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

    public function getFinancement(): ?string
    {
        return $this->financement;
    }

    public function setFinancement(string $financement): self
    {
        $this->financement = $financement;

        return $this;
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->dateArrive;
    }

    public function setDateArrive(\DateTimeInterface $dateArrive): self
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getSuivi(): ?string
    {
        return $this->suivi;
    }

    public function setSuivi(string $suivi): self
    {
        $this->suivi = $suivi;

        return $this;
    }

    /**
     * @return Collection|Personnel[]
     */
    public function getIdPersonnel(): Collection
    {
        return $this->idPersonnel;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
            $message->addIdUrgence($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            $message->removeIdUrgence($this);
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
            $ordonnance->setIdUrgence($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->contains($ordonnance)) {
            $this->ordonnances->removeElement($ordonnance);
            // set the owning side to null (unless already changed)
            if ($ordonnance->getIdUrgence() === $this) {
                $ordonnance->setIdUrgence(null);
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
            $ficheSuivi->setIdUrgence($this);
        }

        return $this;
    }

    public function removeFicheSuivi(FicheSuivi $ficheSuivi): self
    {
        if ($this->ficheSuivis->contains($ficheSuivi)) {
            $this->ficheSuivis->removeElement($ficheSuivi);
            // set the owning side to null (unless already changed)
            if ($ficheSuivi->getIdUrgence() === $this) {
                $ficheSuivi->setIdUrgence(null);
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
            $consultation->setIdUrgence($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->contains($consultation)) {
            $this->consultations->removeElement($consultation);
            // set the owning side to null (unless already changed)
            if ($consultation->getIdUrgence() === $this) {
                $consultation->setIdUrgence(null);
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
            $convocation->setIdUrgence($this);
        }

        return $this;
    }

    public function removeConvocation(Convocation $convocation): self
    {
        if ($this->convocations->contains($convocation)) {
            $this->convocations->removeElement($convocation);
            // set the owning side to null (unless already changed)
            if ($convocation->getIdUrgence() === $this) {
                $convocation->setIdUrgence(null);
            }
        }

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
            $fichePatient->setIdUrgence($this);
        }

        return $this;
    }

    public function removeFichePatient(FichePatient $fichePatient): self
    {
        if ($this->fichePatients->contains($fichePatient)) {
            $this->fichePatients->removeElement($fichePatient);
            // set the owning side to null (unless already changed)
            if ($fichePatient->getIdUrgence() === $this) {
                $fichePatient->setIdUrgence(null);
            }
        }

        return $this;
    }

    public function addIdPersonnel(Personnel $idPersonnel): self
    {
        if (!$this->idPersonnel->contains($idPersonnel)) {
            $this->idPersonnel[] = $idPersonnel;
        }

        return $this;
    }

    public function removeIdPersonnel(Personnel $idPersonnel): self
    {
        if ($this->idPersonnel->contains($idPersonnel)) {
            $this->idPersonnel->removeElement($idPersonnel);
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
            $rendezVouse->setIdUrgence($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): self
    {
        if ($this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->removeElement($rendezVouse);
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getIdUrgence() === $this) {
                $rendezVouse->setIdUrgence(null);
            }
        }

        return $this;
    }
}
