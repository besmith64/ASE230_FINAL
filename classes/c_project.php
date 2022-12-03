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
    public static function create_proj_financials($connection, $array)
    {
        $PMID = $array[0];
        $Quantity_Used = $array[1];
        $Paid_Amount = $array[2];

        $query = $connection->prepare('INSERT INTO t_projectfinancials (PMID,Quantity_Used,Paid_Amount) VALUES (?,?,?)');
        $query->execute([$PMID, $Quantity_Used, $Paid_Amount]);
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
    public static function delete_proj_location($connection, $PMID, $PFID)
    {
        $query = $connection->prepare('UPDATE t_projectlocation SET is_deleted = 1, modifieddate = current_timestamp() WHERE PMID = ? AND PFID = ?');
        $query->execute([$PMID, $PFID]);
        return true;
    }
    //function for editing a Project location
    public static function edit_proj_location($connection, $PMID, $PFID, $Quantity_Used, $Paid_Amount)
    {
        $query = $connection->prepare('UPDATE t_projectlocation SET Quantity_Used = ?, Paid_Amount = ?, modifieddate = current_timestamp() WHERE PMID = ? AND PFID = ?');
        $query->execute([$Quantity_Used, $Paid_Amount, $PMID, $PFID]);
        return true;
    }
    //function for creating a new Project location
    public static function create_proj_location($connection, $array)
    {
        $PMID = $array[0];
        $Quantity_Used = $array[1];
        $Paid_Amount = $array[2];

        $query = $connection->prepare('INSERT INTO t_projectlocation () VALUES ()');
        $query->execute([]);
    }
    // PROJECT MATERIALS SECTION

}