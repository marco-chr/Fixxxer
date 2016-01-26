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
        
        $editid = $_POST["id"];
        $opened = $_POST["opened"];
        $whours = $_POST["whours"];
        $owner = $_POST["owner"];
        $closedate = $_POST["closedate"];
        $comment = $_POST["comment"];
        
        
        $sqlstring  = "UPDATE service_call SET ";
        $sqlstring .= "opened = '$opened', ";
        $sqlstring .= "whours = '$whours', ";
        $sqlstring .= "owner = '$owner', ";
        $sqlstring .= "closedate = '$closedate', ";
        $sqlstring .= "comment = '$comment' ";
        $sqlstring .= "WHERE id = '$editid' ";
        
        $rows = query($sqlstring);
        redirect_to("service.php");
    
        
    }
    else
    {
        
        $rows = query("SELECT * FROM service_call WHERE id= ?",$_GET["id"]);
        $wins = query("SELECT * FROM service_wins WHERE service_id = ?",$_GET["id"]);
        $winscount = countrows("SELECT * FROM service_wins WHERE service_id = ?",$_GET["id"]);
        
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];
            
            // render header
            require("../templates/header.php");
            ?>
            <div style="width:800px; overflow:auto; margin:0 auto; ">
            
            <form action="edit_scall.php" method="post" role="form">
            <fieldset>
              <input type="hidden" name="id" value="<?php echo $row["id"]; ?>"/>
             <div class="form-group">
                <label class="col-sm-2 control-label">Service call:</label>
                <div class="col-sm-10">
                <p class="form-control-static"><?php echo $row["id"]; ?></p>
                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Tag name:</label>
                <div class="col-sm-10">
                <p class="form-control-static"><?php echo $row["tag"]; ?></p>
                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Open date:</label>
                <div class="col-sm-10">
                <p class="form-control-static"><?php echo $row["date"]; ?></p>
                </div>
             </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Status  (open/close):</label>
                <input type="checkbox" name="opened" value="1" <?php if($row["opened"] ===1){echo "checked";} ?>/> 
                
             </div>
             <div class="form-group">
                 <label>Work Hours:</label>
                 <input autofocus class="form-control" name="whours" size="15" placeholder="Work Hours type" type="text" value="<?php echo $row["whours"]; ?>"/>
             </div>
             <div class="form-group">
                 <label>Owner:</label>
                 <input autofocus class="form-control" name="owner" placeholder="owner" type="text" value="<?php echo $row["owner"]; ?>"/>
             </div>
             <div class="form-group">
                 <label>Closedate:</label>
                 <input autofocus class="form-control" name="closedate" placeholder="YYYY-MM-DD" type="text" value="<?php echo $row["closedate"]; ?>"/>
             </div>
             <div class="form-group"> 
             <label>Comment:</label><textarea class="form-control" name="comment" rows="3"><?php echo htmlspecialchars($row["comment"]); ?></textarea>
             </div>
            
            </fieldset>
           
            <button type="submit" class="btn btn-default">Update Service Call</button>
            </form>
            
            
            
            <table class="table table-striped">
            <thead>
            <tr>
                    <td>number</td>
                    <td>work instruction</td>
                    
                </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            <?php foreach ($wins as $win): ?>
               <tr>
                
                    <td><?= $i ?></td>
                    <td><?= $win["wins"] ?></td>
                   
               </tr>
            <?php $i++; ?>   
            <?php endforeach ?>
            </tbody>
            </table>
            </div>
            
            <?php
            // render footer
            require("../templates/footer.php");
            
            
            
        }
        else
        {
        // else apologize
        apologize("Service call edit error");
        }
        
    }

?>
