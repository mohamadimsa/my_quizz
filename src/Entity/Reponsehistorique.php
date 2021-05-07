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
     * @ORM\ManyToOne(targetEntity=historique::class, inversedBy="reponsehistoriques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $historique;

    /**
     * @ORM\ManyToOne(targetEntity=question::class, inversedBy="reponsehistoriques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reponseUser;

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

    public function getQuestion(): ?question
    {
        return $this->question;
    }

    public function setQuestion(?question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getReponseUser(): ?string
    {
        return $this->reponseUser;
    }

    public function setReponseUser(string $reponseUser): self
    {
        $this->reponseUser = $reponseUser;

        return $this;
    }
}
