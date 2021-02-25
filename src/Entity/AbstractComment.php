<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Traits\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 * @ORM\HasLifecycleCallbacks
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="target", type="string")
 * @ORM\DiscriminatorMap({"recipe": "RecipeComment", "comment": "CommentComment"})
 * @ApiResource
 */
abstract class AbstractComment
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    protected $author;

    /**
     * The comment content
     * 
     * @ORM\Column(type="text")
     */
    protected $comment;

    /**
     * List of comments related to this one
     * 
     * @ORM\OneToMany(targetEntity=CommentComment::class, mappedBy="parentComment", orphanRemoval=true)
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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
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

    /**
     * @return Collection|CommentComment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(CommentComment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setParentComment($this);
        }

        return $this;
    }

    public function removeComment(CommentComment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getParentComment() === $this) {
                $comment->setParentComment(null);
            }
        }

        return $this;
    }
}
