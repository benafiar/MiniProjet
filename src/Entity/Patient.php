<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatientRepository")
 * @UniqueEntity(fields={"cin"}, message="invalide Cin car il existe déjà !")
 
 * @UniqueEntity(fields={"numero_telephone"}, message="invalide tel car il existe déjà !")
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
     * @ORM\Column(type="date")
     */
    public $date_creation_fiche;

    /**
     * @ORM\Column(type="integer")
     
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="3",minMessage="votre nom doit faire minumin 3 caracteres")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(min="4",minMessage="votre nom doit faire minumin 4 caracteres")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @ORM\Column(type="date")
     */
    public $date_naissance;

    /**
     * @ORM\Column(type="integer")
     */
    public $numero_telephone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consultation", mappedBy="patients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $consultations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RDV", mappedBy="patients")
     */
    private $rendez_vous;

    public function __construct()
    {
        $this->consultations = new ArrayCollection();
        $this->rendez_vous = new ArrayCollection();
    }

    
    public function getId()
    {
        return $this->id;
    }

    public function getDateCreationFiche()
    {
        return $this->date_creation_fiche;
    }

    public function setDateCreationFiche(\DateTimeInterface $date_creation_fiche)
    {
        $this->date_creation_fiche = $date_creation_fiche;

        return $this;
    }

    public function getCin()
    {
        return $this->cin;
    }

    public function setCin(int $cin)
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse) 
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getProfession()
    {
        return $this->profession;
    }

    public function setProfession(string $profession)
    {
        $this->profession = $profession;

        return $this;
    }

    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance)
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getNumeroTelephone()
    {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone(int $numero_telephone)
    {
        $this->numero_telephone = $numero_telephone;

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
            $consultation->setPatients($this);
        }

        return $this;
    }

    public function removeConsultation(Consultation $consultation): self
    {
        if ($this->consultations->contains($consultation)) {
            $this->consultations->removeElement($consultation);
            // set the owning side to null (unless already changed)
            if ($consultation->getPatients() === $this) {
                $consultation->setPatients(null);
            }
        }

        return $this;
        
    }
    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection|RDV[]
     */
    public function getRendezVous(): Collection
    {
        return $this->rendez_vous;
    }

    public function addRendezVous(RDV $rendezVous): self
    {
        if (!$this->rendez_vous->contains($rendezVous)) {
            $this->rendez_vous[] = $rendezVous;
            $rendezVous->setPatients($this);
        }

        return $this;
    }

    public function removeRendezVous(RDV $rendezVous): self
    {
        if ($this->rendez_vous->contains($rendezVous)) {
            $this->rendez_vous->removeElement($rendezVous);
            // set the owning side to null (unless already changed)
            if ($rendezVous->getPatients() === $this) {
                $rendezVous->setPatients(null);
            }
        }

        return $this;
    }

    

  

   

    

    
}

