<?php

namespace App\Message;

class UserMessage
{
    public const ALREADY_LOGGED_IN = 'Already logged in';
    public const NOT_LOGGED_IN = 'Not logged in';
    
    public const LOGIN_BAD_CREDENTIALS = 'Username or password is incorrect';

    public const REGISTER_USERNAME_USED = 'Username is being used';
}