<?php

require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");

php confirm_logged();

        $rows = query("SELECT * FROM work_ins WHERE master_id= ?",$_GET["id"]);
        
        foreach ($rows as $row){

        $sqlquery = query("UPDATE work_ins SET equip_subtype='' WHERE master_id = ?",$row["id"]);

        }

        $masterlink="/edit_master.php?id=".$_GET["id"];
        redirect_to($masterlink);
?>
