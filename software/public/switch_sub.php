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

        $rows = query("SELECT * FROM equip_types WHERE id= ?",$_POST["id"]);
        $row = $rows[0];
        $equip_type = $row["equip_type"];
        $equip_subtype = $_POST["equip_subtype"];
        $editid = $_POST["tagid"];
        
        $sqlstring  = "UPDATE tags SET ";
        $sqlstring .= "equip_type = '$equip_type', ";
        $sqlstring .= "equip_subtype = '$equip_subtype' ";
        $sqlstring .= "WHERE id = '$editid' ";
        echo $sqlstring;
        $rows = query($sqlstring);
        redirect_to("/");
    }    
    
    else
    {
    
        $equip_id = str_replace("%20"," ",$_GET["id"]);
        
        $tag_id=$_GET["tagid"];
        
        $rows = query("SELECT * FROM equip_types WHERE equip_type= '$equip_id'");
        $row = $rows[0];
        
        $subtypes = query("SELECT * FROM equip_subtypes WHERE parent_id= ?",$row["id"]);
        
        // render header
            require("../templates/header.php");
            ?>
            <div style="width:600px; height:200px; overflow:auto; margin:0 auto; ">
            
            <form action="switch_sub.php" method="post" role="form">
            <fieldset>
             <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
             <input type="hidden" name="tagid" value="<?php echo $tag_id; ?>"/>
             <div class="form-group">
                 <label>Equipment subtype:</label>
                 <select class="form-control" name="equip_subtype">
                 <?php foreach ($subtypes as $subtype){
                 echo"<option value=\"".$subtype['equip_subtype']."\">".$subtype['equip_subtype']."</option>";}
                 ?>
                 </select>
             </div>
             
            
            </fieldset>
            </div> 
            <button type="submit" class="btn btn-default">Update subtype</button>
            </form>
            
            
            <?php
            // render footer
            require("../templates/footer.php");
    }
?>
