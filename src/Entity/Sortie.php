<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SortieRepository::class)
 */
class Sortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateHeureDebut;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbInscriptionMax;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateLimiteInscription;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $infosSortie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat")
     * @ORM\JoinColumn(name="etat_id", referencedColumnName="id")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="organisateur", referencedColumnName="id")
     * @ORM\Column(unique=true)
     */
    private $organisateur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="inscrit", referencedColumnName="id")
     * @ORM\Column(unique=true, nullable=true)
     */
    private $inscrit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu")
     * @ORM\JoinColumn(name="lieu_id", referencedColumnName="id")
     */
    private $lieu;

    /**
     * @ORM\ManyToOne (targetEntity="App\Entity\Campus")
     * @ORM\JoinColumn(name="campOrganisateur", referencedColumnName="id")
     *
     */
    private $siteOrganisateur;

    /**
     * Sortie constructor.
     * @param $inscrit
     */
    public function __construct()
    {
        $this->inscrit = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSiteOrganisateur()
    {
        return $this->siteOrganisateur;
    }

    /**
     * @param mixed $siteOrganisateur
     */
    public function setSiteOrganisateur($siteOrganisateur): void
    {
        $this->siteOrganisateur = $siteOrganisateur;
    }



    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu): void
    {
        $this->lieu = $lieu;
    }


    /**
     * @return ArrayCollection
     */
    public function getInscrit(): ArrayCollection
    {
        return $this->inscrit;
    }

    /**
     * @param ArrayCollection $inscrit
     */
    public function setInscrit(ArrayCollection $inscrit): void
    {
        $this->inscrit = $inscrit;
    }

    /**
     * @return mixed
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param mixed $organisateur
     */
    public function setOrganisateur($organisateur): void
    {
        $this->organisateur = $organisateur;
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

    public function getDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->dateHeureDebut;
    }

    public function setDateHeureDebut(\DateTimeInterface $dateHeureDebut): self
    {
        $this->dateHeureDebut = $dateHeureDebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getNbInscriptionMax(): ?int
    {
        return $this->nbInscriptionMax;
    }

    public function setNbInscriptionMax(int $nbInscriptionMax): self
    {
        $this->nbInscriptionMax = $nbInscriptionMax;

        return $this;
    }

    public function getDateLimiteInscription(): ?\DateTimeInterface
    {
        return $this->dateLimiteInscription;
    }

    public function setDateLimiteInscription(\DateTimeInterface $dateLimiteInscription): self
    {
        $this->dateLimiteInscription = $dateLimiteInscription;

        return $this;
    }

    public function getInfosSortie(): ?string
    {
        return $this->infosSortie;
    }

    public function setInfosSortie(?string $infosSortie): self
    {
        $this->infosSortie = $infosSortie;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
