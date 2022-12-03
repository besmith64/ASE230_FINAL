<?php

//class
//controls user modification for admin role
require_once('../settings/settings.php');

class Contractor
{
    // Get All Contractor
    public static function get_contractor($connection)
    {
        $Contractor = [];
        $query = $connection->prepare('SELECT * FROM t_contractorslist WHERE is_deleted = 0');
        $query->execute();
        while ($data = $query->fetch()) {
            $Contractor[] = $data;
        }
        return $Contractor;
    }
    // function for deleting a specified Contractor
    public static function delete_contractor($connection, $Contractor_ID)
    {
        $query = $connection->prepare('UPDATE t_contractorslist SET is_deleted = 1, modifieddate = current_timestamp() WHERE Contractor_ID  = ?');
        $query->execute([$Contractor_ID]);
        return true;
    }
    //function for editing a Contractor
    public static function edit_contractor($connection, $Contractor_ID, $Contractor_Name, $Description)
    {
        $query = $connection->prepare('UPDATE t_contractorslist SET Contractor_Name = ?, Contractor_Description = ?, modifieddate = current_timestamp() WHERE Contractor_ID = ?');
        $query->execute([$Contractor_Name, $Description, $Contractor_ID]);
        return true;
    }
    //function for creating a new Contractor
    public static function create_contractor($connection, $array)
    {
        $Contractor = $array[0];
        $Description = $array[1];

        $query = $connection->prepare('INSERT INTO t_contractorslist (Contractor_Name,Contractor_Description) VALUES (?,?)');
        $query->execute([$Contractor, $Description]);
    }
}