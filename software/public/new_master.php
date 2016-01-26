<?php

require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");

confirm_logged();

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["master"]))
        {
            apologize("You must provide a master name.");
        }
        else if (empty($_POST["equip_type"]))
        {
            apologize("You must provide an equipment type for the master.");
        }
        else if (empty($_POST["rev"]))
        {
            apologize("You must provide a revision code.");
        }


        $active = 0;
        
        $sqlstring  = "INSERT INTO `maint_master`(`master`, `rev`, `equip_type`, `sop`, `details`, `remarks`, `effective`,`active`) ";
        $sqlstring .= "VALUES(?,?,?,?,?,?,?,?)";
        
        $rows = query($sqlstring,$_POST["master"],$_POST["rev"],$_POST["equip_type"],$_POST["sop"],$_POST["details"],$_POST["remarks"],$_POST["effective"],$active);
        
        $sqlstring = "SELECT * FROM maint_master WHERE id=(SELECT max(id) FROM maint_master)";
        $rows = query($sqlstring);
        $row = $rows[0];
        
        $master_id = $row["id"];
        
        $sqlstring = "SELECT * FROM equip_types WHERE equip_type = ?";
        $rows = query($sqlstring,$_POST["equip_type"]);
        $row = $rows[0];
        
        $equip_id = $row["id"];
        
        $masterlink="/new_wins.php?master_id=".$master_id."&equip_id=".$equip_id;
        redirect_to($masterlink);
    
        
    }
    else
    {
        
        render("new_master_form.php", ["title" => " New Master"]);
    }

?>
