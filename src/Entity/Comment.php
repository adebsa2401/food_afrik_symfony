<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\CommentRepository;
use App\Traits\HasUuid;
use App\Traits\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 * @ORM\Table(name="comments")
 * @ApiResource(
 *     itemOperations = {
 *         "get",
 *         "put" = {
 *             "security" = "object.author === user"
 *         },
 *         "delete" = {
 *             "security" = "object.author === user"
 *         }
 *     },
 *     collectionOperations = {
 *         "get",
 *         "post" = {
 *             "security" = "is_granted('ROLE_USER') && object.recipe.commentable"
 *         }
 *     }
 * )
 */
class Comment
{
    use Timestampable, HasUuid;

    /**
     * @ORM\Column(type="text")
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @ApiProperty(writable = false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=Comment::class, inversedBy="childComments")
     */
    private $parentComment;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="parentComment")
     * @ApiProperty(writable = false)
     */
    private $childComments;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    public function __construct()
    {
        $this->childComments = new ArrayCollection();
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getParentComment(): ?self
    {
        return $this->parentComment;
    }

    public function setParentComment(?self $parentComment): self
    {
        $this->parentComment = $parentComment;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChildComments(): Collection
    {
        return $this->childComments;
    }

    public function addChildComment(self $childComment): self
    {
        if (!$this->childComments->contains($childComment)) {
            $this->childComments[] = $childComment;
            $childComment->setParentComment($this);
        }

        return $this;
    }

    public function removeChildComment(self $childComment): self
    {
        if ($this->childComments->removeElement($childComment)) {
            // set the owning side to null (unless already changed)
            if ($childComment->getParentComment() === $this) {
                $childComment->setParentComment(null);
            }
        }

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
