<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonnelRepository")
 */
class Personnel
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
     * @ORM\Column(type="string", length=255)
     */
    private $fonction;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $specialite;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Urgence", mappedBy="idPersonnel")
     */
    private $urgences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FichePatient", mappedBy="idPersonnel")
     */
    private $fichePatients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="idPersonnel")
     */
    private $messages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordonnance", mappedBy="idPersonnel")
     */
    private $ordonnances;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheSuivi", mappedBy="idPersonnel")
     */
    private $ficheSuivis;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Convocation", mappedBy="idPersonnel")
     */
    private $convocations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Convocation", mappedBy="idPersonnel")
     */
    private $convocation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RendezVous", mappedBy="idPersonnel")
     */
    private $rendezVouses;

    public function __construct()
    {
        $this->urgences = new ArrayCollection();
        $this->fichePatients = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->ordonnances = new ArrayCollection();
        $this->ficheSuivis = new ArrayCollection();
        $this->convocations = new ArrayCollection();
        $this->convocation = new ArrayCollection();
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

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * @return Collection|Urgence[]
     */
    public function getUrgences(): Collection
    {
        return $this->urgences;
    }

    public function addUrgence(Urgence $urgence): self
    {
        if (!$this->urgences->contains($urgence)) {
            $this->urgences[] = $urgence;
            $urgence->addIdPersonnel($this);
        }

        return $this;
    }

    public function removeUrgence(Urgence $urgence): self
    {
        if ($this->urgences->contains($urgence)) {
            $this->urgences->removeElement($urgence);
            $urgence->removeIdPersonnel($this);
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
            $fichePatient->setIdPersonnel($this);
        }

        return $this;
    }

    public function removeFichePatient(FichePatient $fichePatient): self
    {
        if ($this->fichePatients->contains($fichePatient)) {
            $this->fichePatients->removeElement($fichePatient);
            // set the owning side to null (unless already changed)
            if ($fichePatient->getIdPersonnel() === $this) {
                $fichePatient->setIdPersonnel(null);
            }
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
            $message->setIdPersonnel($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getIdPersonnel() === $this) {
                $message->setIdPersonnel(null);
            }
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
            $ordonnance->setIdPersonnel($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->contains($ordonnance)) {
            $this->ordonnances->removeElement($ordonnance);
            // set the owning side to null (unless already changed)
            if ($ordonnance->getIdPersonnel() === $this) {
                $ordonnance->setIdPersonnel(null);
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
            $ficheSuivi->setIdPersonnel($this);
        }

        return $this;
    }

    public function removeFicheSuivi(FicheSuivi $ficheSuivi): self
    {
        if ($this->ficheSuivis->contains($ficheSuivi)) {
            $this->ficheSuivis->removeElement($ficheSuivi);
            // set the owning side to null (unless already changed)
            if ($ficheSuivi->getIdPersonnel() === $this) {
                $ficheSuivi->setIdPersonnel(null);
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
            $convocation->setIdPersonnel($this);
        }

        return $this;
    }

    public function removeConvocation(Convocation $convocation): self
    {
        if ($this->convocations->contains($convocation)) {
            $this->convocations->removeElement($convocation);
            // set the owning side to null (unless already changed)
            if ($convocation->getIdPersonnel() === $this) {
                $convocation->setIdPersonnel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Convocation[]
     */
    public function getConvocation(): Collection
    {
        return $this->convocation;
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
            $rendezVouse->setIdPersonnel($this);
        }

        return $this;
    }

    public function removeRendezVouse(RendezVous $rendezVouse): self
    {
        if ($this->rendezVouses->contains($rendezVouse)) {
            $this->rendezVouses->removeElement($rendezVouse);
            // set the owning side to null (unless already changed)
            if ($rendezVouse->getIdPersonnel() === $this) {
                $rendezVouse->setIdPersonnel(null);
            }
        }

        return $this;
    }
}
