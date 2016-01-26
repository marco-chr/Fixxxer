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
        $ser_code=$_POST["ser_code"];
        $tag_id=$_POST["tag_id"];
        
        $sqlstring  = "UPDATE serials SET tag_id = NULL ";
        $sqlstring .= "WHERE tag_id = '$tag_id'";
        $rows = query($sqlstring);
        
        $sqlstring  = "UPDATE serials SET tag_id = '$tag_id' ";
        $sqlstring .= "WHERE ser_code = '$ser_code'";
        $rows = query($sqlstring);
        
        redirect_to("/");
        
        
    }
else
    {
        
        $rowcount = countrows("SELECT ser_code FROM serials WHERE tag_id = ?",$_GET["id"]);
            if($rowcount !== 0)
            {
                $serials = query("SELECT ser_code FROM serials WHERE tag_id = ?",$_GET["id"]);
                $serial = $serials[0];
                $currentserial=$serial['ser_code'];
            }
            else
            {
                $currentserial="";
            }
        $serials = query("SELECT ser_code FROM serials WHERE tag_id IS NULL");
        
        
            // render header
            require("../templates/header.php");
            ?>
            <div style="width:800px; margin:0 auto;">
            
            <form action="switch_serial.php" method="post" role="form">
            <fieldset>
                 <input type="hidden" name="tag_id" value="<?php echo $_GET['id']; ?>"/>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Current serial:</label>
                    <div class="col-sm-10">
                    <p class="form-control-static"><?= $currentserial ?></p>
                    </div>
                 </div>
                 <div class="form-group">
                 <label class="col-sm-2 control-label">Serial:</label>
                 <select autofocus class="form-control" name="ser_code">
                 <?php foreach ($serials as $serial): ?>
                 <option value="<?= $serial['ser_code'] ?>"><?= $serial['ser_code'] ?></option>
                 <?php endforeach ?>
                 </select>
                 </div>
                 <button type="submit" class="btn btn-default">Update Serial</button>
            </fieldset>
            </form>
            
            <dl class="dl-horizontal">
            <dt>Serial Switch</dt>
            <dd>This operation resets the current serial number and asset for the edited tag.</dd>
            </dl>
            </div>
            
            <?php
            // render footer
            require("../templates/footer.php");

        
    }

?>

