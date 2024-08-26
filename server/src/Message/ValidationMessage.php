<?php

namespace App\Message;

class ValidationMessage
{
    public const BLANK = 'Empty field';

    public const TYPE_STRING = 'Must be a string';

    public const LENGTH_MIN = 'Minimum length';
    public const LENGTH_MAX = 'Minimum length';
    
    public const USERNAME_FORMAT = 'Letters and numbers only';
    public const PASSWORD_NOT_EQUAL = 'Passwords do not match';
}