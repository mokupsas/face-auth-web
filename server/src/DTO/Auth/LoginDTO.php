<?php

namespace App\DTO\Auth;

use App\Message\ValidationMessage;
use Symfony\Component\Validator\Constraints as Assert;

class LoginDTO
{
    public function __construct(
        #[Assert\Sequentially([
            new Assert\NotBlank(message: ValidationMessage::BLANK),
            new Assert\Type(type: 'string', message: ValidationMessage::TYPE_STRING),
            new Assert\Regex(pattern: '/^[a-zA-Z\d]+$/', message: 'g'),
            new Assert\Length(min: 3, minMessage: ValidationMessage::LENGTH_MIN . ' 3'),
            new Assert\Length(max: 18, maxMessage: ValidationMessage::LENGTH_MAX . ' 18'),
        ])]
        public readonly mixed $username,

        #[Assert\Sequentially([
            new Assert\NotBlank(message: ValidationMessage::BLANK),
            new Assert\Type(type: 'string', message: ValidationMessage::TYPE_STRING),
            new Assert\Length(min: 3, minMessage: ValidationMessage::LENGTH_MIN . ' 3'),
            new Assert\Length(max: 128, maxMessage: ValidationMessage::LENGTH_MAX . ' 128'),
        ])]
        public readonly mixed $password,
    ) {
    }
}
