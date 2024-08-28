<?php

namespace App\Controller\API;

use App\Model\UserModel;
use App\Message\UserMessage;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/users')]
#[IsGranted('IS_AUTHENTICATED', message: UserMessage::NOT_LOGGED_IN, statusCode: 401)]
class Users extends AbstractController
{
    public function __construct(
        private UserModel $userModel,
    ) {}

    #[Route('/me', name: 'api_user_me', methods: ['GET'])]
    public function me(): JsonResponse
    {
        return $this->userModel->getUserData($this->getUser());
    }
}
