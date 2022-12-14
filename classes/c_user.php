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
    // Get Users by ID
    public static function get_users_by_id($connection, $ID)
    {
        $query = $connection->prepare('SELECT * FROM t_user WHERE is_deleted = 0 and UID = ?');
        $query->execute([$ID]);
        $data = $query->fetch();
        return $data;
    }
    // function for deleting a specified user
    public static function delete_user($connection, $UID)
    {
        $query = $connection->prepare('UPDATE t_user SET is_deleted = 1, modifieddate = current_timestamp() WHERE UID = ?');
        $query->execute([$UID]);
        return true;
    }
    //function for editing a users information
    public static function edit_user($connection, $UID, $GID, $fname, $lname)
    {
        $query = $connection->prepare('UPDATE t_user SET GID = ?, firstname = ?, lastname = ?, modifieddate = current_timestamp() WHERE UID = ?');
        $query->execute([$GID, $fname, $lname, $UID]);
    }
}