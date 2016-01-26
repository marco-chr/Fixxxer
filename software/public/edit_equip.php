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
        
        if (empty($_POST["description"]))
        {
            apologize("You must provide a description for the equipment type.");
        }
        
        $description = $_POST["description"];
        $editid = $_POST["id"];
        $subdescription = $_POST["subdescription"];
        $subid = $_POST["subid"];
        
        $sqlstring  = "UPDATE equip_types SET ";
        $sqlstring .= "description = '$description' ";
        $sqlstring .= "WHERE id = '$editid' ";
        $rows = query($sqlstring);
        
        $subtypes_count = countrows("SELECT * FROM equip_subtypes WHERE parent_id = ?",$editid);
        
        for ($i=0;$i<$subtypes_count;$i++)
        {
        $sqlstring  = "UPDATE equip_subtypes SET ";
        $sqlstring .= "description = '$subdescription[$i]'";
        $sqlstring .= "WHERE id = '$subid[$i]' ";
        
        $rows = query($sqlstring);        
        }
        redirect_to("/");
    
        
    }
    else
    {
        
        $rows = query("SELECT * FROM equip_types WHERE id= ?",$_GET["id"]);
        $subtypes = query("SELECT * FROM equip_subtypes WHERE parent_id = ?",$_GET["id"]);
        
        
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];
        
            // render header
            require("../templates/header.php");
            ?>

            <form action="edit_equip.php" method="post" class="form-horizontal" role="form">
            <fieldset>
            <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
            <label>Equipment Type:</label><div align="left"> <?php echo $row["equip_type"]; ?></div><br>
            <label>Description:</label><input autofocus class="form-control" name="description" size="25" placeholder="description" type="text" align="left" value="<?php echo $row["description"]; ?>"/><br>
            </br>
            </br>
            </div>
            <?php foreach ($subtypes as $subtype): ?>
            <div class="form-group">
            <input type="hidden" name="subid[]" value="<?php echo $subtype["id"]; ?>"/>
            <label>Equipment SubType:</label><div align="left"><?php echo $subtype["equip_subtype"]; ?></div><br>
            <label>Description:</label><input autofocus class="form-control" name="subdescription[]" size="25" placeholder="description" type="text" align="left" value="<?php echo $subtype["description"]; ?>"/><br>
            </div>
            <?php endforeach ?>
            
            <div class="form-group">
            <button type="submit" class="btn btn-default">Update Equipment Type</button>
            </div>
            </fieldset>
            </form>
            
            <div class="form-group">
            <?php $subtypelink="<a href='subtype.php?id=".$_GET["id"]."'>Add new subtype</a>"; ?>
            <?= $subtypelink ?>
            </div>
            
            
            <?php
            // render footer
            require("../templates/footer.php");
            
            
            
        }
        else
        {
        // else apologize
        apologize("Equipment tag edit error");
        }
        
    }

?>
