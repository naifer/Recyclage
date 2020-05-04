<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ForumRepository")
 */
class Forum
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $titre;

    /**
       * @ORM\ManyToOne(targetEntity="App\Entity\Cotegory")
       */

    private $categorie;

    /**
     * @ORM\Column(type="text")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbvue;

    /**
     * @ORM\Column(type="integer")
     */
    private $nblike;

    /**
     * @ORM\Column(type="text")
     */
    private $descrption;

    /**
     * @ORM\Column(type="text")
     */
    private $img;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="forum", orphanRemoval=true)
     */
    private $comments;



  public function __construct()
  {
      $this->comments = new ArrayCollection();
  }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCategorie(): ?Cotegory
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbvue(): ?int
    {
        return $this->nbvue;
    }

    public function setNbvue(int $nbvue): self
    {
        $this->nbvue = $nbvue;

        return $this;
    }

    public function getNblike(): ?int
    {
        return $this->nblike;
    }

    public function setNblike(int $nblike): self
    {
        $this->nblike = $nblike;

        return $this;
    }

    public function getDescrption(): ?string
    {
        return $this->descrption;
    }

    public function setDescrption(string $descrption): self
    {
        $this->descrption = $descrption;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }
  

    public function __toString(){
       // to show the name of the Category in the select
       return $this->titre;
       // to show the id of the Category in the select
       // return $this->id;
   }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setForum($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getForum() === $this) {
                $comment->setForum(null);
            }
        }

        return $this;
    }
}
