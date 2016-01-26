<?php

require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");
    
confirm_logged(); 

    $sqlstring = "SELECT* FROM serials WHERE tag_id IS NULL";
    
    $rows = query($sqlstring);
    
    $positions = [];
    foreach ($rows as $row)
    {
        $positions[] = [
            "ser_code" => $row["ser_code"],
            "family" => $row["family"],
            "description" => $row["description"],
            "vendor" => $row["vendor"],
            "model" => $row["model"],
        ];
    }

    
    // render taglist
    render("serialslist.php",["positions" => $positions, "title" => "Serials"]);

?>
