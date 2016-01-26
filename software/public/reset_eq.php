<?php

require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");

confirm_logged();


        
        $tag_id=$_GET["id"];
        
        $sqlstring  = "UPDATE tags SET equip_type = NULL, equip_subtype = NULL ";
        $sqlstring .= "WHERE `id` = $tag_id";
        
        $rows = query($sqlstring);
        

        
        redirect_to("/");
        


?>

