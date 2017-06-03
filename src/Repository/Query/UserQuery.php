<?php

namespace App\Repository\Query;

/**
 * Users Query.
 */
abstract class UserQuery
{
    const GET_USER_QUERY     = 'SELECT * FROM users WHERE id=:id';
    const GET_USERS_QUERY    = 'SELECT * FROM users ORDER BY id';
    const SEARCH_USERS_QUERY = 'SELECT * FROM users WHERE UPPER(name) LIKE :query ORDER BY id';
    const CREATE_USER_QUERY  = 'INSERT INTO users (name, email) VALUES (:name, :email)';
    const UPDATE_USER_QUERY  = 'UPDATE users SET name=:name, email=:email WHERE id=:id';
    const DELETE_USER_QUERY  = 'DELETE FROM users WHERE id=:id';
}
