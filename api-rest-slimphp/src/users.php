<?php

class users
{
    public static function getUsers($db)
    {
        $sth = $db->prepare('SELECT * FROM users ORDER BY id');
        $sth->execute();
        $users = $sth->fetchAll();

        return $users;
    }
}
