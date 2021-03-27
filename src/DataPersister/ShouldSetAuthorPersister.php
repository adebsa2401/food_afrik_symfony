<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Comment;
use App\Entity\Recipe;
use Symfony\Component\Security\Core\Security;

final class ShouldSetAuthorPersister implements ContextAwareDataPersisterInterface {
    private $security;
    private $decorated;

    public function __construct(ContextAwareDataPersisterInterface $decorated, Security $security) {
        $this->security = $security;
        $this->decorated = $decorated;
    }

    public function supports($data, array $context = []): bool {
        return $this->decorated->supports($data, $context) && (
            $data instanceof Recipe ||
            $data instanceof Comment
        );
    }

    public function persist($data, array $context = []) {
        $data->setAuthor($this->security->getUser());
        
        return $this->decorated->persist($data, $context);
    }

    public function remove($data, array $context = []) {
        $this->decorated->remove($data, $context);
    }
}
