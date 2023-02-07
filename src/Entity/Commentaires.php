<?php

namespace App\Entity;

use App\Repository\CommentairesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentairesRepository::class)]
class Commentaires
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $contenu = null;

    #[ORM\Column]
    private ?int $signalement = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    private ?Utilisateur $relation = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    private ?Post $postRelation = null;

    #[ORM\OneToMany(mappedBy: 'commentId', targetEntity: Reposts::class)]
    private Collection $reposts;

    public function __construct()
    {
        $this->reposts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getSignalement(): ?int
    {
        return $this->signalement;
    }

    public function setSignalement(int $signalement): self
    {
        $this->signalement = $signalement;

        return $this;
    }

    public function getRelation(): ?Utilisateur
    {
        return $this->relation;
    }

    public function setRelation(?Utilisateur $relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    public function getPostRelation(): ?Post
    {
        return $this->postRelation;
    }

    public function setPostRelation(?Post $postRelation): self
    {
        $this->postRelation = $postRelation;

        return $this;
    }

    /**
     * @return Collection<int, Reposts>
     */
    public function getReposts(): Collection
    {
        return $this->reposts;
    }

    public function addRepost(Reposts $repost): self
    {
        if (!$this->reposts->contains($repost)) {
            $this->reposts->add($repost);
            $repost->setCommentId($this);
        }

        return $this;
    }

    public function removeRepost(Reposts $repost): self
    {
        if ($this->reposts->removeElement($repost)) {
            // set the owning side to null (unless already changed)
            if ($repost->getCommentId() === $this) {
                $repost->setCommentId(null);
            }
        }

        return $this;
    }
}
