<?php

namespace App\Model;

use App\DTO\Auth\LoginDTO;
use App\DTO\Auth\RegisterDTO;
use App\Entity\User;
use App\Message\UserMessage;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserModel
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
        private UserRepository $userRepository,
        private Security $security,
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
            throw new Exception($e->getMessage());
        }

        // log the user in on the current firewall
        $this->security->login($user);

        return new JsonResponse(['success' => true, 'loggedIn' => true]);
    }

    public function login(LoginDTO $loginDTO): JsonResponse
    {
        if (!$user = $this->userRepository->findOneBy(['username' => $loginDTO->username]))
            return new JsonResponse(['message' => UserMessage::LOGIN_BAD_CREDENTIALS]);

        if (!$this->passwordHasher->isPasswordValid($user, $loginDTO->password))
            return new JsonResponse(['message' => UserMessage::LOGIN_BAD_CREDENTIALS]);

        $this->security->login($user);

        return new JsonResponse(['success' => true]);
    }

    public function logout(): JsonResponse
    {
        try {
            $this->security->logout(false);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return new JsonResponse(['success' => true]);
    }

    public function getUserData(User $user): JsonResponse
    {
        return new JsonResponse([
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }
}
