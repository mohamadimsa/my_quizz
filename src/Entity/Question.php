<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
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
    private $question;

    /**
     * @ORM\ManyToOne(targetEntity=Quizz::class, inversedBy="questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quizz; 

    /**
     * @ORM\OneToMany(targetEntity=Reponse::class, mappedBy="question")
     */
    private $reponses;

    /**
     * @ORM\OneToMany(targetEntity=Reponsehistorique::class, mappedBy="question")
     */
    private $reponsehistoriques;

    /**
     * @ORM\Column(type="integer")
     */
    private $index_question;

    public function __construct()
    {
        $this->reponses = new ArrayCollection();
        $this->reponsehistoriques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

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

    /**
     * @return Collection|Reponse[]
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses[] = $reponse;
            $reponse->setQuestion($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getQuestion() === $this) {
                $reponse->setQuestion(null);
            }
        }

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
            $reponsehistorique->setQuestion($this);
        }

        return $this;
    }

    public function removeReponsehistorique(Reponsehistorique $reponsehistorique): self
    {
        if ($this->reponsehistoriques->removeElement($reponsehistorique)) {
            // set the owning side to null (unless already changed)
            if ($reponsehistorique->getQuestion() === $this) {
                $reponsehistorique->setQuestion(null);
            }
        }

        return $this;
    }

    public function getIndexQuestion(): ?int
    {
        return $this->index_question;
    }

    public function setIndexQuestion(int $index_question): self
    {
        $this->index_question = $index_question;

        return $this;
    }
}
