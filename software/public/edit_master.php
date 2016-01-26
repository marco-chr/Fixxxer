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
        if (empty($_POST["master"]))
        {
            apologize("You must provide a master name.");
        }
        else if (empty($_POST["equip_type"]))
        {
            apologize("You must provide an equipment type for the master.");
        }
        else if (empty($_POST["rev"]))
        {
            apologize("You must provide a revision code.");
        }

        $master = $_POST["master"];
        $rev = $_POST["rev"];
        $equip_type = $_POST["equip_type"];
        $sop = $_POST["sop"];
        $details = $_POST["details"];
        $remarks = $_POST["remarks"];
        $effective = $_POST["effective"];
        $master_id = $_POST["id"];
        
        $sqlstring  = "UPDATE maint_master SET ";
        $sqlstring .= "rev = '$rev', ";
        $sqlstring .= "equip_type = '$equip_type', ";
        $sqlstring .= "sop = '$sop', ";
        $sqlstring .= "details = '$details', ";
        $sqlstring .= "remarks = '$remarks', ";
        $sqlstring .= "effective = '$effective' ";
        $sqlstring .= "WHERE id = '$master_id'";
        
        
        $rows = query($sqlstring);
        
        $sqlstring = "SELECT * FROM equip_types WHERE equip_type = ?";
        $rows = query($sqlstring,$_POST["equip_type"]);
        $row = $rows[0];
        
        $equip_id = $row["id"];
        
        $masterlink="/edit_wins.php?master_id=".$master_id."&equip_id=".$equip_id;
        redirect_to($masterlink);
    
        
    }
    else
    {
     
        $rows = query("SELECT * FROM maint_master WHERE id= ?",$_GET["id"]);
        $row = $rows[0];
        
        $checks = query("SELECT * FROM work_ins WHERE master_id= ?",$_GET["id"]);
        
        $checkresult = countrows("SELECT * FROM work_ins WHERE master_id= ?",$_GET["id"]);
        $countresult = 0;
        foreach ($checks as $check){
        if ($check["equip_subtype"]==="")
            {
                $countresult++;
            }
        }
        
        $checkflag = 0;
        if ($countresult === $checkresult)
        {
            $checkflag = 1;
        }
        
        $equiptypes = query("SELECT * FROM equip_types");
        
        require("../templates/header.php");
        ?>
        
        <div style="width:600px; margin:0 auto;">
        <form action="edit_master.php" method="post" role="form" >
        <fieldset>
             <input type="hidden" name="id" value="<?php echo $row["id"]; ?>"/>
             <div class="form-group">   
             <label>Master:</label><input autofocus class="form-control" name="master"  value="<?php echo $row["master"]; ?>" size="15" placeholder="master" type="text" align="left"/>
             </div>
             <div class="form-group">   
             <label>Rev:</label><input autofocus class="form-control" name="rev"  value="<?php echo $row["rev"]; ?>" size="3" placeholder="rev" type="text" align="left"/>
             </div>
             <div class="form-group"> 
             <label>SOP:</label><input autofocus class="form-control" name="sop" value="<?php echo $row["sop"]; ?>" size="10" placeholder="sop" type="text"/>
             </div>
             <div class="form-group">
             <label>Equip Type:</label>
             <?php
             if ($checkflag === 1)
             {
                echo"<select class=\"form-control\" name=\"equip_type\">";
                foreach ($equiptypes as $equiptype){
                echo"<option value=\"".$equiptype['equip_type']."\">".$equiptype['equip_type']."</option>";
                }
                echo"</select>";
             }
             else
             {
                echo"<div class=\"col-sm-10\">";
                echo"<p class=\"form-control-static\">".$row['equip_type']."</p>";
                echo"</div>";
                
                echo"<input type=\"hidden\" name=\"equip_type\" value=\"".$row["equip_type"]."\"/>";
             }
             ?>
             </div>
             <div class="form-group"> 
             <label>Details:</label><textarea class="form-control" name="details" rows="3"><?php echo htmlspecialchars($row["details"]); ?></textarea>
             </div>
             <div class="form-group"> 
             <label>Remarks:</label><textarea class="form-control" name="remarks" rows="3"><?php echo htmlspecialchars($row["remarks"]); ?></textarea>
             </div>
             <div class="form-group">
             <label>Effective Date:</label><input autofocus class="form-control" name="effective" value="<?php echo $row["effective"]; ?>" placeholder="effective" type="text"/>
             </div>
             
        </fieldset>
             <button type="submit" class="btn btn-default">Edit Work instructions</button>
             <span class="help-block">Click Edit Master to edit master work instructions in detail.</span>
             <span class="help-block">If you can't edit equipment type, first reset equipment subtypes for this master.</span>
        </form>
        
        <div class="form-group">
            <?php $resetsubtype="<a href='reset_subtype.php?id=".$row["id"]."'>Reset subtypes</a>"; ?>
            <?= $resetsubtype ?>
        </div>        
        
        </div>
         
        <?php
        require("../templates/footer.php");  
        
    }

?>
