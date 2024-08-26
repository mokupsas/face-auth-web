<?php

namespace App\Model;

use App\DTO\Auth\RegisterDTO;
use App\Entity\User;
use App\Message\UserMessage;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserModel
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
        private UserRepository $userRepository,
    ) {}

    public function register(RegisterDTO $registerDTO): JsonResponse
    {
        if ($this->userRepository->findOneBy(['username' => $registerDTO->username]))
            return new JsonResponse(['message' => UserMessage::REGISTER_USERNAME_USED]);

        try {
            $user = new User();
            $user->setUsername($registerDTO->username);
            $user->setPassword(
                $this->passwordHasher->hashPassword(
                    $user,
                    $registerDTO->password
                )
            );

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (Exception $e) {
            throw new HttpException($e->getMessage());
        }

        return new JsonResponse(['success' => true, 'loggedIn' => true]);
    }
}
