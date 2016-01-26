<?php

// deactivate master form


require_once("../includes/session.php");
require_once("../includes/db_connection.php");
require_once("../includes/functions.php");
require_once("../includes/validation_functions.php");
require("../includes/constants.php");

confirm_logged();

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $master = $_POST["master"];
        
        $sqlstring  = "UPDATE maint_master SET ";
        $sqlstring .= "active = 0 ";
        $sqlstring .= "WHERE master = '$master' ";
        echo $sqlstring;
        $rows = query($sqlstring);
        redirect_to("master.php");
    }    
    
    else
    {
    
        $masters = query("SELECT * FROM maint_master");
        
        // render header
            require("../templates/header.php");
            ?>
            <div style="width:600px; height:200px; overflow:auto; margin:0 auto; ">
            
            <form action="deactivate.php" method="post" role="form">
            <fieldset>
             
             <div class="form-group">
                 <label>Maintenance Master:</label>
                 <select class="form-control" name="master">
                 <?php foreach ($masters as $master){
                 echo"<option value=\"".$master['master']."\">".$master['master']."</option>";}
                 ?>
                 </select>
             </div>
             
            
            </fieldset>
            </div> 
            <button type="submit" class="btn btn-default">Deactivate master</button>
            </form>
            
            
            <?php
            // render footer
            require("../templates/footer.php");
    }
?>
