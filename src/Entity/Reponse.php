<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReponseRepository::class)
 */
class Reponse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="reponses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reponse;

    /**
     * @ORM\Column(type="integer")
     */
    private $indice_reponse;

    /**
     * @ORM\OneToMany(targetEntity=Reponsehistorique::class, mappedBy="reponseuser")
     */
    private $reponsehistoriques;

    public function __construct()
    {
        $this->reponsehistoriques = new ArrayCollection();
    }

   
    public function getId(): ?int
    {
        return $this->id;
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

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function getIndiceReponse(): ?int
    {
        return $this->indice_reponse;
    }

    public function setIndiceReponse(int $indice_reponse): self
    {
        $this->indice_reponse = $indice_reponse;

        return $this;
    }

    /**
     * @return Collection|Reponsehistorique[]
     */
    public function getReponsehistoriques(): Collection
    {
        return $this->reponsehistoriques;
    }

    public function addReponsehistorique(Reponsehistorique $reponsehistorique): self
    {
        if (!$this->reponsehistoriques->contains($reponsehistorique)) {
            $this->reponsehistoriques[] = $reponsehistorique;
            $reponsehistorique->setReponseuser($this);
        }

        return $this;
    }

    public function removeReponsehistorique(Reponsehistorique $reponsehistorique): self
    {
        if ($this->reponsehistoriques->removeElement($reponsehistorique)) {
            // set the owning side to null (unless already changed)
            if ($reponsehistorique->getReponseuser() === $this) {
                $reponsehistorique->setReponseuser(null);
            }
        }

        return $this;
    }

   
}
