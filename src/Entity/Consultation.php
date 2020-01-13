<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="string", length=255)
     */
    private $nom_medecin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_medecin;

    /**
     * @ORM\Column(type="integer")
     
     */
    private $taille;

    /**
     * @ORM\Column(type="integer")
     */
    private $tension;

    /**
     * @ORM\Column(type="integer")
     */
    private $temperature;

    /**
     * @ORM\Column(type="text")
     */
    private $examen;

    /**
     * @ORM\Column(type="integer")
     */
    private $poid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="consultations")
     
     */
    private $patients;

    /**
     * @ORM\Column(type="text")
     */
    private $conclusion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ordonnance", mappedBy="consultation")
     */
    private $ordonnances;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groupe_sanguin;

    public function __construct()
    {
        $this->ordonnances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMedecin(): ?string
    {
        return $this->nom_medecin;
    }

    public function setNomMedecin(string $nom_medecin): self
    {
        $this->nom_medecin = $nom_medecin;

        return $this;
    }

    public function getPrenomMedecin(): ?string
    {
        return $this->prenom_medecin;
    }

    public function setPrenomMedecin(string $prenom_medecin): self
    {
        $this->prenom_medecin = $prenom_medecin;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getTension(): ?int
    {
        return $this->tension;
    }

    public function setTension(int $tension): self
    {
        $this->tension = $tension;

        return $this;
    }

    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    public function setTemperature(int $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getExamen(): ?string
    {
        return $this->examen;
    }

    public function setExamen(string $examen): self
    {
        $this->examen = $examen;

        return $this;
    }

    public function getPoid(): ?int
    {
        return $this->poid;
    }

    public function setPoid(int $poid): self
    {
        $this->poid = $poid;

        return $this;
    }

    public function getPatients(): ?Patient
    {
        return $this->patients;
    }

    public function setPatients(?Patient $patients): self
    {
        $this->patients = $patients;

        return $this;
    }

    public function getConclusion(): ?string
    {
        return $this->conclusion;
    }

    public function setConclusion(string $conclusion): self
    {
        $this->conclusion = $conclusion;

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
            $ordonnance->setConsultation($this);
        }

        return $this;
    }

    public function removeOrdonnance(Ordonnance $ordonnance): self
    {
        if ($this->ordonnances->contains($ordonnance)) {
            $this->ordonnances->removeElement($ordonnance);
            // set the owning side to null (unless already changed)
            if ($ordonnance->getConsultation() === $this) {
                $ordonnance->setConsultation(null);
            }
        }

        return $this;
    }

    public function getGroupeSanguin(): ?string
    {
        return $this->groupe_sanguin;
    }

    public function setGroupeSanguin(string $groupe_sanguin): self
    {
        $this->groupe_sanguin = $groupe_sanguin;

        return $this;
    }
}
