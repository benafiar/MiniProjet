<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RDVRepository")
 * @UniqueEntity(
 *  fields={"date_RDV"},
 * message="Desole ! il y a un rendez-vous a cette date."
 * )
  * @UniqueEntity(fields={"nom_patient"}, message="votre rdv est déjà confirmer!")
 */

class RDV
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
    private $nom_patient;

    /**
     * @ORM\Column(type="date")
     */
    private $date_RDV;

    /**
     * @ORM\Column(type="time")
     */
    private $heure_RDV;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaire;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="rendez_vous")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patients;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPatient(): ?string
    {
        return $this->nom_patient;
    }

    public function setNomPatient(string $nom_patient): self
    {
        $this->nom_patient = $nom_patient;

        return $this;
    }

    public function getDateRDV(): ?\DateTimeInterface
    {
        return $this->date_RDV;
    }

    public function setDateRDV(\DateTimeInterface $date_RDV): self
    {
        $this->date_RDV = $date_RDV;

        return $this;
    }

    public function getHeureRDV(): ?\DateTimeInterface
    {
        return $this->heure_RDV;
    }

    public function setHeureRDV(\DateTimeInterface $heure_RDV): self
    {
        $this->heure_RDV = $heure_RDV;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

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
}
