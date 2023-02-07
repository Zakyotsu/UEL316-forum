<?php

namespace App\Entity;

use App\Repository\CommentairesRepository;
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
}
