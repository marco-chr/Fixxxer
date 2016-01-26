<?php

require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");
    
confirm_logged();  
 
    $today = (new \DateTime())->format('Y-m-d');
    $sqlstring = "SELECT* FROM service_call WHERE date = ?";
    
    $rows = query($sqlstring,$today);
    
    $positions = [];
    foreach ($rows as $row)
    {
        $positions[] = [
            "id" => $row["id"],
            "tag" => $row["tag"],
            "date" => $row["date"],
            "opened" => $row["opened"],
            "whours" => $row["whours"],
            "owner" => $row["owner"],
            "closedate" => $row["closedate"],
            "comment" => $row["comment"],
        ];
    }

    
    // render taglist
    render("scalllist.php",["positions" => $positions, "title" => "Daily Activities"]);

?>
