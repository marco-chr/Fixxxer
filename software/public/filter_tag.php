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
        
        if(isset($_GET['by']))
            {
            $by=$_GET['by'];
            }
        if(isset($by) and $by=="asc")
            {
            $by="desc";
            }
        else{$by="asc";}    
        
        // main sql query
        $sqlstring  = "SELECT tags.id, tags.tag, tags.description, tags.plant, tags.area, tags.equip_type, tags.equip_subtype, tags.owner, tags.critical, tags.created, ";
        $sqlstring .= "serials.ser_code, serials.vendor, serials.model ";
        $sqlstring .= "FROM tags LEFT OUTER JOIN serials ";
        $sqlstring .= "ON tags.id = serials.tag_id";
        
        // variables
        $x = 0;
        $i = 0;
        // form seach fields 
        $searchfields =['tags.tag','tags.description','tags.plant','tags.area','tags.equip_type','tags.equip_subtype','tags.owner','tags.created','tags.basedate','tags.position','tags.critical'];
        
        // loop for adding extra items to SQL query based on search fields
        foreach($_POST['searchstring'] as $item)
        {
            if($item!=='')
            {
                if($x==0){
                
                $sqlstring .= " WHERE $searchfields[$i] LIKE '$item'";
                $x = 1;
                }
                else if($x==1){
                $sqlstring .= " AND WHERE $searchfields[$i]  LIKE '$item'";
                }
            }
            $i++;
        }
        // filter query
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
        
        
    }
    else
    {
        
        render("filter_form.php", ["title" => "Filter tags"]);
    }

?>
