<?php

require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");
confirm_logged();   

    if(isset($_GET['by']))
    {
    $by=$_GET['by'];
    }
    if(isset($by) and $by=="asc"){
    $by="desc";
    }else{$by="asc";}
    
    if(isset($_GET['orderby'])){
    $order=$_GET['orderby'];
    $sqlstring  = "SELECT tags.id, tags.tag, tags.description, tags.plant, tags.area, tags.equip_type, tags.equip_subtype, tags.owner, tags.critical, tags.created, ";
    $sqlstring .= "serials.ser_code, serials.vendor, serials.model ";
    $sqlstring .= "FROM tags LEFT OUTER JOIN serials ";
    $sqlstring .= "ON tags.id = serials.tag_id ORDER BY ".$order." ".$by;
    }
    else
    {
    $sqlstring  = "SELECT tags.id, tags.tag, tags.description, tags.plant, tags.area, tags.equip_type, tags.equip_subtype, tags.owner, tags.critical, tags.created, ";
    $sqlstring .= "serials.ser_code, serials.vendor, serials.model ";
    $sqlstring .= "FROM tags LEFT OUTER JOIN serials ";
    $sqlstring .= "ON tags.id = serials.tag_id";
    }
    
    $rows = query($sqlstring);
    
    $positions = [];
    foreach ($rows as $row)
    {
        $positions[] = [
            "id" => $row["id"],
            "tag" => $row["tag"],
            "description" => $row["description"],
            "plant" => $row["plant"],
            "area" => $row["area"],
            "equip_type" => $row["equip_type"],
            "equip_subtype" => $row["equip_subtype"],
            "ser_code" => $row["ser_code"],
            "vendor" => $row["vendor"],
            "model" => $row["model"],
            "owner" => $row["owner"],
            "critical" => $row["critical"],
            "created" => $row["created"],
        ];
    }

    
    // render taglist
    render("taglist.php",["positions" => $positions, "title" => "Tag List","by" => $by]);

?>
