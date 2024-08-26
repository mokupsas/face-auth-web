<?php

namespace App\Controller\API;

use App\Model\UserModel;
use App\DTO\Auth\RegisterDTO;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[Route('/api/auth')]
class Auth extends AbstractController
{
    public function __construct(
        private UserModel $userModel,
    ) {}

    #[Route('/register', name: 'api_auth_register', methods: ['POST'])]
    public function register(#[MapRequestPayload] RegisterDTO $registerDTO): JsonResponse
    {
        return $this->userModel->register($registerDTO);
    }
}
