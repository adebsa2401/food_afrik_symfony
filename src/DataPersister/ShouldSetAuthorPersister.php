<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Comment;
use App\Entity\Recipe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

final class ShouldSetAuthorPersister implements ContextAwareDataPersisterInterface {
    private $em;
    private $security;

    public function __construct(Security $security, EntityManagerInterface $em) {
        $this->em = $em;
        $this->security = $security;
    }

    public function supports($data, array $context = []): bool {
        return $data instanceof Recipe ||
            $data instanceof Comment;
    }

    public function persist($data, array $context = []) {
        $data->setAuthor($this->security->getUser());
        $this->em->persist($data);
        $this->em->flush();
        return $data;
    }

    public function remove($data, array $context = []) {
        $this->em->remove($data);
        $this->em->flush();
    }
}
