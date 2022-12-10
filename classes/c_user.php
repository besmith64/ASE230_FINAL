<?php

//class
//controls user modification for admin role

class User
{
    // Get All Users
    public static function get_users($connection)
    {
        $Users = [];
        $query = $connection->prepare('SELECT * FROM t_user WHERE is_deleted = 0');
        $query->execute();
        while ($data = $query->fetch()) {
            $Users[] = $data;
        }
        return $Users;
    }
    // function for deleting a specified user
    public static function delete_user($connection, $UID)
    {
        $query = $connection->prepare('UPDATE t_user SET is_deleted = 1, modifieddate = current_timestamp() WHERE UID = ?');
        $query->execute([$UID]);
        return true;
    }
    //function for editing a users information
    public static function edit_user($connection, $UID, $GID, $email, $fname, $lname)
    {
        $query = $connection->prepare('UPDATE t_user SET GID = ?, email = ?, firstname = ?, lastname = ?, modifieddate = current_timestamp() WHERE UID = ?');
        $query->execute([$GID, $email, $fname, $lname, $UID]);
    }
}