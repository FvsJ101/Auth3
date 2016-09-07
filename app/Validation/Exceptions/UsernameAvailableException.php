<?php


namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;


class UsernameAvailableException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} is already taken',
        ),
    
    );
}