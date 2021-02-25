<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use App\Traits\HasUuid;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=LikeRepository::class)
 * @ORM\Table(name="likes")
 * @ORM\HasLifecycleCallbacks
 */
class Like
{
    use Timestampable;
    use HasUuid;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="likes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="likes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }
}
