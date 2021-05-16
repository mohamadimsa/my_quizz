<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\HistoriqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoriqueRepository::class)
 */
class Historique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="historiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Users;

    /**
     * @ORM\ManyToOne(targetEntity=Quizz::class, inversedBy="historiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quizz;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="historiques")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $score;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Reponsehistorique::class, mappedBy="historique")
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

    public function getUsers(): ?User
    {
        return $this->Users;
    }

    public function setUsers(?User $Users): self
    {
        $this->Users = $Users;

        return $this;
    }

    public function getQuizz(): ?quizz
    {
        return $this->quizz;
    }

    public function setQuizz(?quizz $quizz): self
    {
        $this->quizz = $quizz;

        return $this;
    }

    public function getCategories(): ?categories
    {
        return $this->categories;
    }

    public function setCategories(?categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
            $reponsehistorique->setHistorique($this);
        }

        return $this;
    }

    public function removeReponsehistorique(Reponsehistorique $reponsehistorique): self
    {
        if ($this->reponsehistoriques->removeElement($reponsehistorique)) {
            // set the owning side to null (unless already changed)
            if ($reponsehistorique->getHistorique() === $this) {
                $reponsehistorique->setHistorique(null);
            }
        }

        return $this;
    }
}
