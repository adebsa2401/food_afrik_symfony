<?php

namespace App\Entity;

use App\Repository\RecipeCommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeCommentRepository::class)
 * @ORM\Table(name="recipes_comments")
 */
class RecipeComment extends AbstractComment
{
    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

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
