<?php

namespace App\Validation;

use App\Message\UserMessage;
use Respect\Validation\Validator as v;

/**
 * User Validation.
 */
abstract class UserValidation
{
    /**
     * Validate and sanitize a username.
     *
     * @param string $name
     * @return string
     * @throws \Exception
     */
    protected static function validateName($name)
    {
        if (!v::alnum()->length(2, 100)->validate($name)) {
            throw new \Exception(UserMessage::USER_NAME_INVALID, 400);
        }

        return $name;
    }

    /**
     * Validate and sanitize a email address.
     *
     * @param string $emailValue
     * @return string
     * @throws \Exception
     */
    protected static function validateEmail($emailValue)
    {
        $email = filter_var($emailValue, FILTER_SANITIZE_EMAIL);
        if (!v::email()->validate($email)) {
            throw new \Exception(UserMessage::USER_EMAIL_INVALID, 400);
        }

        return $email;
    }

    /**
     * Validate and sanitize input data when create new user.
     *
     * @param array $input
     * @return string
     * @throws \Exception
     */
    public static function validateInputOnCreateUser($input)
    {
        if (!isset($input['name'])) {
            throw new \Exception(UserMessage::USER_NAME_REQUIRED, 400);
        }
        $name = self::validateName($input['name']);
        $email = null;
        if (isset($input['email'])) {
            $email = self::validateEmail($input['email']);
        }

        return ['name' => $name, 'email' => $email];
    }

    /**
     * Validate and sanitize input data when update a user.
     *
     * @param array $input
     * @param object $user
     * @return string
     * @throws \Exception
     */
    public static function validateInputOnUpdateUser($input, $user)
    {
        if (!isset($input['name']) && !isset($input['email'])) {
            throw new \Exception(UserMessage::USER_INFO_REQUIRED, 400);
        }
        $name = $user->name;
        if (isset($input['name'])) {
            $name = self::validateName($input['name']);
        }
        $email = $user->email;
        if (isset($input['email'])) {
            $email = self::validateEmail($input['email']);
        }

        return ['name' => $name, 'email' => $email];
    }
}
