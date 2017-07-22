<?php

namespace App\Validation;

use App\Exception\UserException;

/**
 * User Validation.
 */
abstract class UserValidation extends BaseValidation
{
    /**
     * Validate and sanitize input data when create new user.
     *
     * @param array|object|null $input
     * @return array
     * @throws \Exception
     */
    public static function validateInputOnCreateUser($input)
    {
        if (!isset($input['name'])) {
            throw new UserException(UserException::USER_NAME_REQUIRED, 400);
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
     * @param array|object|null $input
     * @param object $user
     * @return array
     * @throws \Exception
     */
    public static function validateInputOnUpdateUser($input, $user)
    {
        if (!isset($input['name']) && !isset($input['email'])) {
            throw new UserException(UserException::USER_INFO_REQUIRED, 400);
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
