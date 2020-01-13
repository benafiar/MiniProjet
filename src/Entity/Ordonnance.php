<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdonnanceRepository")
 */
class Ordonnance
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
    private $Nom_Medicament;

    /**
     * @ORM\Column(type="integer")
     */
    private $Dosa_Medicament;

    /**
     * @ORM\Column(type="integer")
     */
    private $Quantite_Medicament;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pasologie_medicament;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Consultation", inversedBy="ordonnances")
     */
    private $consultation;

    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getNomMedicament(): ?string
    {
        return $this->Nom_Medicament;
    }

    public function setNomMedicament(string $Nom_Medicament): self
    {
        $this->Nom_Medicament = $Nom_Medicament;

        return $this;
    }

    public function getDosaMedicament(): ?int
    {
        return $this->Dosa_Medicament;
    }

    public function setDosaMedicament(int $Dosa_Medicament): self
    {
        $this->Dosa_Medicament = $Dosa_Medicament;

        return $this;
    }

    public function getQuantiteMedicament(): ?int
    {
        return $this->Quantite_Medicament;
    }

    public function setQuantiteMedicament(int $Quantite_Medicament): self
    {
        $this->Quantite_Medicament = $Quantite_Medicament;

        return $this;
    }

    public function getPasologieMedicament(): ?string
    {
        return $this->Pasologie_medicament;
    }

    public function setPasologieMedicament(string $Pasologie_medicament): self
    {
        $this->Pasologie_medicament = $Pasologie_medicament;

        return $this;
    }

    public function getConsultation(): ?Consultation
    {
        return $this->consultation;
    }

    public function setConsultation(?Consultation $consultation): self
    {
        $this->consultation = $consultation;

        return $this;
    }
}
