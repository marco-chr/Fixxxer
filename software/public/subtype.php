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
        if (empty($_POST["equip_subtype"]))
        {
            apologize("You must provide a equipment subtype name.");
        }
        else if (empty($_POST["description"]))
        {
            apologize("You must provide a description for the equipment subtype.");
        }
        
        $sqlstring  = "SELECT * FROM `equip_subtypes` WHERE equip_subtype = ?";
        $rows = query($sqlstring,$_POST["equip_subtype"]);
        if(!$rows)
        {
            $sqlstring  = "INSERT INTO `equip_subtypes`(`equip_subtype`,`description`,`parent_id`) ";
            $sqlstring .= "VALUES(?,?,?)";
        
            $rows = query($sqlstring,$_POST["equip_subtype"],$_POST["description"],$_POST["id"]);

            $link = "edit_equip.php?id=".$_POST["id"];
            redirect_to($link);
        }
        else
        {
            apologize("This equipment subtype already exists.");
        }
        
    }
    else
    {
        
            // render header
            require("../templates/header.php");
            ?>
            <div style="width:600px; margin:0 auto;">
            <form action="subtype.php" method="post" role="form">
            <fieldset>
            <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
            <label>Equipment Subtype:</label><input autofocus class="form-control" name="equip_subtype" size="10" placeholder="equipment subtype" type="text" align="left"/><br>
            <label>Description:</label><input autofocus class="form-control" name="description" size="25" placeholder="description" type="text"/><br>    
            </div>
            
            </fieldset>
            <button type="submit" class="btn btn-default">Add Equipment Subtype</button>
            </form>
            </div>
            <?php
            // render footer
            require("../templates/footer.php");
            
    }

?>
