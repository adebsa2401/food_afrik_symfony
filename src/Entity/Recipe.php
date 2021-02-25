<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RecipeRepository;
use App\Traits\HasUuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Traits\Timestampable;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 * @ORM\Table(name="recipes")
 * @ORM\HasLifecycleCallbacks
 * @ApiResource
 */
class Recipe
{
    use Timestampable;
    use HasUuid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity=RecipeComment::class, mappedBy="recipe", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Like::class, mappedBy="recipe", orphanRemoval=true)
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity=AssetQuantity::class, mappedBy="recipe")
     */
    private $assetQuantities;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->assetQuantities = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection|RecipeComment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(RecipeComment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setRecipe($this);
        }

        return $this;
    }

    public function removeComment(RecipeComment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getRecipe() === $this) {
                $comment->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Like[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setRecipe($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getRecipe() === $this) {
                $like->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AssetQuantity[]
     */
    public function getAssetQuantities(): Collection
    {
        return $this->assetQuantities;
    }

    public function addAssetQuantity(AssetQuantity $assetQuantity): self
    {
        if (!$this->assetQuantities->contains($assetQuantity)) {
            $this->assetQuantities[] = $assetQuantity;
            $assetQuantity->setRecipe($this);
        }

        return $this;
    }

    public function removeAssetQuantity(AssetQuantity $assetQuantity): self
    {
        if ($this->assetQuantities->removeElement($assetQuantity)) {
            // set the owning side to null (unless already changed)
            if ($assetQuantity->getRecipe() === $this) {
                $assetQuantity->setRecipe(null);
            }
        }

        return $this;
    }
}
