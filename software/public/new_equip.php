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
        if (empty($_POST["equip_type"]))
        {
            apologize("You must provide a equipment type name.");
        }
        else if (empty($_POST["description"]))
        {
            apologize("You must provide a description for the equipment type.");
        }
        
        $sqlstring  = "SELECT * FROM `equip_types` WHERE equip_type = ?";
        $rows = query($sqlstring,$_POST["equip_type"]);
        if(!$rows)
        {
            $sqlstring  = "INSERT INTO `equip_types`(`equip_type`,`description`) ";
            $sqlstring .= "VALUES(?,?)";
        
            $rows = query($sqlstring,$_POST["equip_type"],$_POST["description"]);

            redirect_to("/");
        }
        else
        {
            apologize("This equipment type already exists.");
        }
        
    }
    else
    {
        
        render("new_equip_form.php", ["title" => " New Equipment Type"]);
    }

?>
