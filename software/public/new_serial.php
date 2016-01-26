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
        if (empty($_POST["ser_code"]))
        {
            apologize("You must provide a serial code.");
        }
        else if (empty($_POST["family"]))
        {
            apologize("You must provide a family for the serial.");
        }
        
        
        $sqlstring  = "INSERT INTO `serials`(`ser_code`, `family`, `description`, `vendor`, `model`) ";
        $sqlstring .= "VALUES(?,?,?,?,?)";
        
        $rows = query($sqlstring,$_POST["ser_code"],$_POST["family"],$_POST["description"],$_POST["vendor"],$_POST["model"]);

        redirect_to("/");
    
        
    }
    else
    {
        
        render("new_serial_form.php", ["title" => " New Serial"]);
    }

?>
