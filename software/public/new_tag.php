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
        if (empty($_POST["tag"]))
        {
            apologize("You must provide a tag name.");
        }
        else if (empty($_POST["description"]))
        {
            apologize("You must provide a description for the tag.");
        }
        else if (empty($_POST["plant"]))
        {
            apologize("You must provide a plant code.");
        }
        else if (empty($_POST["area"]))
        {
            apologize("You must provide a plant area code.");
        }
        else if (empty($_POST["basedate"]))
        {
            apologize("You must provide a basedate.");
        }
        else if (empty($_POST["created"]))
        {
            apologize("You must provide a creation date.");
        }
        else if (empty($_POST["critical"]))
        {
            $critical = 0;
        }
        else if (!empty($_POST["critical"]))
        {
            $critical = 1;
        }
        
        $active = 1;
        
        $sqlstring  = "INSERT INTO `tags`(`tag`, `description`, `plant`, `area`, `equip_type`, `equip_subtype`, `owner`, `critical`, `created`, `basedate`, `active`, `position`) ";
        $sqlstring .= "VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        
        $rows = query($sqlstring,$_POST["tag"],$_POST["description"],$_POST["plant"],$_POST["area"],$_POST["equip_type"],$_POST["equip_subtype"],$_POST["owner"],$critical,$_POST["created"],$_POST["basedate"],$active,$_POST["position"]);
        
        $sqlstring = "SELECT * FROM tags WHERE id=(SELECT max(id) FROM tags)";
        $rows = query($sqlstring);
        
        $row = $rows[0];
        $tag_id = $row["id"];
        $ser_id = $_POST["ser_code"];
        $sqlstring  = "UPDATE serials SET tag_id = '$tag_id' ";
        $sqlstring .= "WHERE ser_code = '$ser_id'";
        $rows = query($sqlstring);
        
        redirect_to("/");
    
        
    }
    else
    {
        
        render("new_tag_form.php", ["title" => " New Tag"]);
    }

?>
