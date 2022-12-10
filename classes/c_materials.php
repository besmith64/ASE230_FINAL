<?php

//class

class Materials
{
    // Get All Mateerials
    public static function get_materials($connection)
    {
        $Materials = [];
        $query = $connection->prepare('SELECT * FROM t_materialslist WHERE is_deleted = 0');
        $query->execute();
        while ($data = $query->fetch()) {
            $Materials[] = $data;
        }
        return $Materials;
    }
    // function for deleting a specified material
    public static function delete_material($connection, $Material_ID)
    {
        $query = $connection->prepare('UPDATE t_materialslist SET is_deleted = 1, modifieddate = current_timestamp() WHERE Material_ID = ?');
        $query->execute([$Material_ID]);
        return true;
    }
    // function for editing a material
    public static function edit_materials($connection, $Material_ID, $Material, $Description, $Cost)
    {
        $query = $connection->prepare('UPDATE t_materialslist SET Material_Name = ?, Material_Description = ?, Material_Cost = ?, modifieddate = current_timestamp() WHERE Material_ID = ?');
        $query->execute([$Material, $Description, $Cost, $Material_ID]);
        return true;
    }
    // function for creating a new material
    public static function create_material($connection, $array)
    {
        $Material = $array[0];
        $Description = $array[1];
        $Cost = $array[2];

        $query = $connection->prepare('INSERT INTO t_materialslist (Material_Name,Material_Description,Material_Cost) VALUES (?,?,?)');
        $query->execute([$Material, $Description, $Cost]);
    }
}