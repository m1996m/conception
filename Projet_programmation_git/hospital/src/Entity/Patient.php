<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     */
    private $user;

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
    private $adresse;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $genre;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Urgence", mappedBy="patient")
     */
    private $personnel;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Maternite", mappedBy="patient")
     */
    private $maternites;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\International", mappedBy="patient")
     */
    private $internationals;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\FichePatient", mappedBy="patient")
     */
    private $fichePatients;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Message", mappedBy="patient")
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Consultation", mappedBy="patient")
     */
    private $consultations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RendezVous", mappedBy="patient")
     */
    private $rendezVouses;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Suivi", mappedBy="patient")
     */
    private $suivis;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ordonnance", mappedBy="patient")
     */
    private $ordonnances;

    public function __construct()
    {
        $this->personnel = new ArrayCollection();
        $this->maternites = new ArrayCollection();
        $this->internationals = new ArrayCollection();
        $this->fichePatients = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->consultations = new ArrayCollection();
        $this->rendezVouses = new ArrayCollection();
        $this->suivis = new ArrayCollection();
        $this->ordonnances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

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

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Urgence[]
     */
    public function getPersonnel(): Collection
    {
        return $this->personnel;
    }

    public function addPersonnel(Urgence $personnel): self
    {
        if (!$this->personnel->contains($personnel)) {
            $this->personnel[] = $personnel;
            $personnel->addPatient($this);
        }

        return $this;
    }

    public function removePersonnel(Urgence $personnel): self
    {
        if ($this->personnel->contains($personnel)) {
            $this->personnel->removeElement($personnel);
            $personnel->removePatient($this);
        }

        return $this;
    }

    /**
     * @return Collection|Maternite[]
     */
    public function getMaternites(): Collection
    {
        return $this->maternites;
    }

    public function addMaternite(Maternite $maternite): self
    {
        if (!$this->maternites->contains($maternite)) {
            $this->maternites[] = $maternite;
            $maternite->addPatient($this);
        }

        return $this;
    }

    public function removeMaternite(Maternite $maternite): self
    {
        if ($this->maternites->contains($maternite)) {
            $this->maternites->removeElement($maternite);
            $maternite->removePatient($this);
        }

        return $this;
    }

    /**
     * @return Collection|International[]
     */
    public function getInternationals(): Collection
    {
        return $this->internationals;
    }

    public function addInternational(International $international): self
    {
        if (!$this->internationals->contains($international)) {
            $this->internationals[] = $international;
            $international->addPatient($this);
        }

        return $this;
    }

    public function removeInternational(International $international): self
    {
        if ($this->internationals->contains($international)) {
            $this->internationals->removeElement($international);
            $international->removePatient($this);
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
            $fichePatient->addPatient($this);
        }

        return $this;
    }

    public function removeFichePatient(FichePatient $fichePatient): self
    {
        if ($this->fichePatients->contains($fichePatient)) {
            $this->fichePatients->removeElement($fichePatient);
            $fichePatient->removePatient($this);
        }

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
            $message->addPatient($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            $message->removePatient($this);
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
            $consultation->addPatient($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->contains($consultation)) {
            $this->consultations->removeElement($consultation);
            $consultation->removePatient($this);
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
            $rendezVouse->addPatient($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): self
    {
        if ($this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->removeElement($rendezVouse);
            $rendezVouse->removePatient($this);
        }

        return $this;
    }

    /**
     * @return Collection|Suivi[]
     */
    public function getSuivis(): Collection
    {
        return $this->suivis;
    }

    public function addSuivi(Suivi $suivi): self
    {
        if (!$this->suivis->contains($suivi)) {
            $this->suivis[] = $suivi;
            $suivi->addPatient($this);
        }

        return $this;
    }

    public function removeSuivi(Suivi $suivi): self
    {
        if ($this->suivis->contains($suivi)) {
            $this->suivis->removeElement($suivi);
            $suivi->removePatient($this);
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
            $ordonnance->addPatient($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->contains($ordonnance)) {
            $this->ordonnances->removeElement($ordonnance);
            $ordonnance->removePatient($this);
        }

        return $this;
    }
}
