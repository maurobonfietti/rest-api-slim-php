<?php

namespace App\Exception;

/**
 * User Exception.
 */
class UserException extends BaseException
{
    const USER_NOT_FOUND = 'Not found.';
    const USER_NAME_NOT_FOUND = 'Not found';
    const USER_NAME_REQUIRED = 'Fields required.';
    const USER_INFO_REQUIRED = 'Enter the data to update the user.';
    const USER_NAME_INVALID = 'Error in user.';
    const USER_EMAIL_INVALID = 'Error email.';

    /**
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
