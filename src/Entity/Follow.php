<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FollowRepository;
use App\Traits\HasUuid;
use App\Traits\Timestampable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FollowRepository::class)
 * @ORM\Table(name="follows")
 * @ApiResource
 */
class Follow
{
    use Timestampable;
    use HasUuid;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="followeds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $follower;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="followers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $followed;

    public function getFollower(): ?User
    {
        return $this->follower;
    }

    public function setFollower(?User $follower): self
    {
        $this->follower = $follower;

        return $this;
    }

    public function getFollowed(): ?User
    {
        return $this->followed;
    }

    public function setFollowed(?User $followed): self
    {
        $this->followed = $followed;

        return $this;
    }
}
