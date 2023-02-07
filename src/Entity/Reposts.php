<?php

namespace App\Entity;

use App\Repository\RepostsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RepostsRepository::class)]
class Reposts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reason = null;

    #[ORM\ManyToOne(inversedBy: 'reposts')]
    private ?Commentaires $commentId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(string $reason): self
    {
        $this->reason = $reason;

        return $this;
    }

    public function getCommentId(): ?Commentaires
    {
        return $this->commentId;
    }

    public function setCommentId(?Commentaires $commentId): self
    {
        $this->commentId = $commentId;

        return $this;
    }
}
