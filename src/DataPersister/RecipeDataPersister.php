<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Recipe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

final class RecipeDataPersister implements ContextAwareDataPersisterInterface {
    private $em;
    private $security;

    public function __construct(Security $security, EntityManagerInterface $em) {
        $this->em = $em;
        $this->security = $security;
    }

    public function supports($data, array $context = []): bool {
        return $data instanceof Recipe;
    }

    public function persist($data, array $context = []) {
        $data->setAuthor($this->security->getUser());
        $this->em->persist($data);
        return $data;
    }

    public function remove($data, array $context = []) {
        $this->em->remove($data);
        $this->em->flush();
    }
}