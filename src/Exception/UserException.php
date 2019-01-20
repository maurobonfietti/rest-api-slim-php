<?php

namespace App\Exception;

/**
 * User Exception.
 */
class UserException extends BaseException
{
    const USER_NOT_FOUND = 'User not found.';
    const USER_NAME_NOT_FOUND = 'User name not found.';
    const USER_NAME_REQUIRED = 'The field "name" is required.';
    const USER_INFO_REQUIRED = 'Enter the data to update the user.';
    const USER_NAME_INVALID = 'Invalid name.';
    const USER_EMAIL_INVALID = 'Invalid email';
}
