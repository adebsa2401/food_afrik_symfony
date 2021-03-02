<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserDataPersister implements ContextAwareDataPersisterInterface {
    private $passwordEncoder;
    private $em;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        EntityManagerInterface $em
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
    }

    public function supports($data, array $context=[]): bool {
        return $data instanceof User;
    }

    public function persist($data, array $context = []) {
        if($data->getPassword()) {
            $data->setPassword($this->passwordEncoder->encodePassword($data, $data->getPassword()));
            $data->eraseCredentials();
        }

        $this->em->persist($data);
        $this->em->flush();

        return $data;
    }

    public function remove($data, array $context = []) {
        $this->em->remove($data);
        $this->em->flush();
    }
}