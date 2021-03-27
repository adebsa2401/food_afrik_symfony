<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ChainDataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class UserDataPersister implements ContextAwareDataPersisterInterface {
    private $passwordEncoder;

    public function __construct(ContextAwareDataPersisterInterface $decorated, UserPasswordEncoderInterface $passwordEncoder) {
        $this->passwordEncoder = $passwordEncoder;
        $this->decorated = $decorated;
    }

    public function supports($data, array $context = []): bool {
        return $this->decorated->supports($data, $context) &&
            $data instanceof User;
    }

    public function persist($data, array $context = []) {
        if($data->getPassword()) {
            $data->setPassword($this->passwordEncoder->encodePassword($data, $data->getPassword()));
            $data->eraseCredentials();
        }

        return $this->decorated->persist($data, $context);
    }

    public function remove($data, array $context = []) {
        $this->decorated->remove($data, $context);
    }
}
