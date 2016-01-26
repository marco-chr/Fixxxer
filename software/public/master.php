<?php

require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");

confirm_logged();
    
    $sqlstring  = "SELECT * FROM maint_master";
    
    $rows = query($sqlstring);
    
    $positions = [];
    foreach ($rows as $row)
    {
        $positions[] = [
            "id" => $row["id"],
            "master" => $row["master"],
            "rev" => $row["rev"],
            "active" => $row["active"],
            "equip_type" => $row["equip_type"],
            "sop" => $row["sop"],
            "details" => $row["details"],
            "remarks" => $row["remarks"],
            "effective" => $row["effective"]
          
        ];
    }

    
    // render taglist
    render("masterlist.php",["positions" => $positions, "title" => "Maintenance Masters"]);

?>
