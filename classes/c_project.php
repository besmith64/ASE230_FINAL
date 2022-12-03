<?php

//class
//controls user modification for admin role
require_once('../settings/settings.php');

class Project
{
    // MAIN SECTION
    // Get All Projects
    public static function get_project($connection, $Project_ID)
    {
        $Project = [];
        $query = $connection->prepare('SELECT * FROM t_project WHERE is_deleted = 0 and Project_ID = ?');
        $query->execute([$Project_ID]);
        while ($data = $query->fetch()) {
            $Project[] = $data;
        }
        return $Project;
    }
    // function for deleting a specified Project
    public static function delete_project($connection, $Project_ID)
    {
        $query = $connection->prepare('UPDATE t_project SET is_deleted = 1, modifieddate = current_timestamp() WHERE Project_ID = ?');
        $query->execute([$Project_ID]);
        return true;
    }
    //function for editing a Project
    public static function edit_project($connection, $Project_ID, $Project_Name, $Description, $Location_ID, $Contractor_ID)
    {
        $query = $connection->prepare('UPDATE t_project SET Project_Name = ?, Project_Description = ?,Location_ID = ?, Contractor_ID = ?, modifieddate = current_timestamp() WHERE Project_ID = ?');
        $query->execute([$Project_Name, $Description, $Location_ID, $Contractor_ID, $Project_ID]);
        return true;
    }
    //function for creating a new Project
    public static function create_project($connection, $array)
    {
        $Project_Name = $array[0];
        $Description = $array[1];
        $Created_By = $array[2];
        $Location_ID = $array[3];
        $Contractor_ID = $array[4];

        $query = $connection->prepare('INSERT INTO t_project (Project_Name,Project_Description,Created_By,Location_ID,Contractor_ID) VALUES (?,?,?,?,?)');
        $query->execute([$Project_Name, $Description, $Created_By, $Location_ID, $Contractor_ID]);
    }

    // PROJECT FINANCIALS SECTION

    // Get All Projects financials
    public static function get_proj_financials($connection, $PMID)
    {
        $ProjectFinance = [];
        $query = $connection->prepare('SELECT * FROM t_projectfinancials WHERE is_deleted = 0 and PMID = ?');
        $query->execute([$PMID]);
        while ($data = $query->fetch()) {
            $ProjectFinance[] = $data;
        }
        return $ProjectFinance;
    }
    // function for deleting a specified Project financials
    public static function delete_proj_financials($connection, $PMID, $PFID)
    {
        $query = $connection->prepare('UPDATE t_projectfinancials SET is_deleted = 1, modifieddate = current_timestamp() WHERE PMID = ? AND PFID = ?');
        $query->execute([$PMID, $PFID]);
        return true;
    }
    //function for editing a Project financials
    public static function edit_proj_financials($connection, $PMID, $PFID, $Quantity_Used, $Paid_Amount)
    {
        $query = $connection->prepare('UPDATE t_projectfinancials SET Quantity_Used = ?, Paid_Amount = ?, modifieddate = current_timestamp() WHERE PMID = ? AND PFID = ?');
        $query->execute([$Quantity_Used, $Paid_Amount, $PMID, $PFID]);
        return true;
    }
    //function for creating a new Project financials
    public static function create_proj_financials($connection, $PMID)
    {
        $query = $connection->prepare('INSERT INTO t_projectfinancials (PMID) VALUES (?)');
        $query->execute([$PMID]);
    }
    // PROJECT LOCATION SECTION
    // Get All Projects location
    public static function get_proj_location($connection, $Project_ID)
    {
        $ProjectLoc = [];
        $query = $connection->prepare('SELECT * FROM t_projectlocation WHERE is_deleted = 0 and Project_ID = ?');
        $query->execute([$Project_ID]);
        while ($data = $query->fetch()) {
            $ProjectLoc[] = $data;
        }
        return $ProjectLoc;
    }
    // function for deleting a specified Project location
    public static function delete_proj_location($connection, $Location_ID)
    {
        $query = $connection->prepare('UPDATE t_projectlocation SET is_deleted = 1, modifieddate = current_timestamp() WHERE Location_ID = ?');
        $query->execute([$Location_ID]);
        return true;
    }
    //function for editing a Project location
    public static function edit_proj_location($connection, $Location_ID, $Address, $City, $State, $ZipCode)
    {
        $query = $connection->prepare('UPDATE t_projectlocation SET Address = ?, City = ?,  State = ?, ZipCode = ?, modifieddate = current_timestamp() WHERE Location_ID = ?');
        $query->execute([$Address, $City, $State, $ZipCode, $Location_ID]);
        return true;
    }
    //function for creating a new Project location
    public static function create_proj_location($connection, $array)
    {
        $Project_ID = $array[0];
        $Address = $array[1];
        $City = $array[2];
        $State = $array[3];
        $ZipCode = $array[4];

        $query = $connection->prepare('INSERT INTO t_projectlocation (Project_ID, Address, City, State, ZipCode) VALUES (?,?,?,?,?)');
        $query->execute([$Project_ID, $Address, $City, $State, $ZipCode]);
    }
    // PROJECT MATERIALS SECTION
    // Get All Project Materials
    public static function get_proj_materials($connection, $Project_ID)
    {
        $ProjMaterials = [];
        $query = $connection->prepare('SELECT * FROM t_projectmaterials WHERE is_deleted = 0 and Project_ID = ?');
        $query->execute([$Project_ID]);
        while ($data = $query->fetch()) {
            $ProjMaterials[] = $data;
        }
        return $ProjMaterials;
    }
    // function for deleting a specified material
    public static function delete_proj_material($connection, $Project_ID, $PMID)
    {
        $query = $connection->prepare('UPDATE t_projectmaterials SET is_deleted = 1, modifieddate = current_timestamp() WHERE Project_ID = ? and PMID = ?');
        $query->execute([$Project_ID, $PMID]);
        return true;
    }
    //function for editing a material
    public static function edit_proj_materials($connection, $Project_ID, $PMID, $Material_ID, $Quantity, $Project_Cost)
    {
        $query = $connection->prepare('UPDATE t_projectmaterials SET Material_ID = ?, Quantity = ?, Project_Cost = ?, modifieddate = current_timestamp() WHERE Project_ID = ? and PMID = ?');
        $query->execute([$Material_ID, $Quantity, $Project_Cost, $Project_ID, $PMID]);
        return true;
    }
    //function for creating a new material
    public static function create_proj_material($connection, $array)
    {
        $proj = new Project();
        $conn = $connection;
        $Project_ID = $array[0];
        $Material_ID = $array[1];
        $Quantity = $array[2];
        $Project_Cost = $array[3];

        $query = $connection->prepare('INSERT INTO t_projectmaterials (Project_ID,Material_ID,Quantity,Project_Cost) VALUES (?,?,?,?)');
        $query->execute([$Project_ID, $Material_ID, $Quantity, $Project_Cost]);
        $proj->create_proj_financials($conn, $Material_ID); // Create a Proj Financials field when material is added.
    }
}