<?php

namespace App\Entity;

use App\Repository\ReponsehistoriqueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReponsehistoriqueRepository::class)
 */
class Reponsehistorique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Historique::class, inversedBy="reponsehistoriques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $historique;

    /**
     * @ORM\Column(type="json")
     */
    private $reponse = [];

   

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHistorique(): ?historique
    {
        return $this->historique;
    }

    public function setHistorique(?historique $historique): self
    {
        $this->historique = $historique;

        return $this;
    }

    public function getReponse(): ?array
    {
        return $this->reponse;
    }

    public function setReponse(array $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

   


   


}
