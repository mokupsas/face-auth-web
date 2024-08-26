<?php

namespace App\Controller\API;

use App\DTO\Auth\LoginDTO;
use App\Model\UserModel;
use App\DTO\Auth\RegisterDTO;
use App\Message\UserMessage;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/auth')]
class Auth extends AbstractController
{
    public function __construct(
        private UserModel $userModel,
    ) {}

    #[Route('/register', name: 'api_auth_register', methods: ['POST'])]
    public function register(#[MapRequestPayload] RegisterDTO $registerDTO): JsonResponse
    {
        if ($this->getUser()) throw new AccessDeniedException(UserMessage::ALREADY_LOGGED_IN);

        return $this->userModel->register($registerDTO);
    }

    #[Route('/login', name: 'api_auth_login', methods: ['POST'])]
    public function login(#[MapRequestPayload] LoginDTO $loginDTO): JsonResponse
    {
        if ($this->getUser()) throw new AccessDeniedException(UserMessage::ALREADY_LOGGED_IN);

        return $this->userModel->login($loginDTO);
    }

    #[Route('/logout', name: 'api_auth_logout', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED', message: UserMessage::NOT_LOGGED_IN, statusCode: 401)]
    public function logout(): JsonResponse
    {
        return $this->userModel->logout();
    }
}
