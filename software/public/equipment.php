<?php

require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");

confirm_logged();
    
    $sqlstring  = "SELECT * FROM equip_types";
    $rows = query($sqlstring);
    
    $positions = [];
    foreach ($rows as $row)
    {
        $positions[] = [
            "id" => $row["id"],
            "equip_type" => $row["equip_type"],
            "description" => $row["description"],
            ];
    }

    
    // render taglist
    render("equip_list.php",["positions" => $positions, "title" => "Equipment Type List"]);

?>
