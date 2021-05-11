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
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="reponsehistoriques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity=Reponse::class, inversedBy="reponsehistoriques")
     */
    private $reponse;

  

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

    public function getReponseuser(): ?reponse
    {
        return $this->reponse;
    }

    public function setReponseuser(?reponse $reponseuser): self
    {
        $this->reponse = $reponseuser;

        return $this;
    }


}
