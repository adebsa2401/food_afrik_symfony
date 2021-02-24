<?php

namespace App\Entity;

use App\Repository\CommentCommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentCommentRepository::class)
 * @ORM\Table(name="comments_comments")
 */
class CommentComment extends AbstractComment
{
    /**
     * @ORM\ManyToOne(targetEntity=AbstractComment::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $parentComment;

    public function getParentComment(): ?AbstractComment
    {
        return $this->parentComment;
    }

    public function setParentComment(?AbstractComment $parentComment): self
    {
        $this->parentComment = $parentComment;

        return $this;
    }
}
