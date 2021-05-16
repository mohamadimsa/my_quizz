<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use App\Repository\QuizzRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuizzRepository::class)
 */
class Quizz
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="quizzs")
     */
    public $categories;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="quizz")
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity=Historique::class, mappedBy="quizz")
     */
    private $historiques;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->historiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

 


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    
    
    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function addCategories(int $id , CategoriesRepository $categoriesRepository){

        $categorieId = $categoriesRepository->findBy([
            "id" => $id
        ]);
        return $this->categories = $categorieId[0]->getId();
 }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

    

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }



    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuizz() === $this) {
                $question->setQuizz(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Historique[]
     */
    public function getHistoriques(): Collection
    {
        return $this->historiques;
    }

    public function addHistorique(Historique $historique): self
    {
        if (!$this->historiques->contains($historique)) {
            $this->historiques[] = $historique;
            $historique->setQuizz($this);
        }

        return $this;
    }

    public function removeHistorique(Historique $historique): self
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getQuizz() === $this) {
                $historique->setQuizz(null);
            }
        }

        return $this;
    }
}
