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
        if (empty($_POST["tag"]))
        {
            apologize("You must provide a tag name.");
        }
        else if (empty($_POST["description"]))
        {
            apologize("You must provide a description for the tag.");
        }
        else if (empty($_POST["plant"]))
        {
            apologize("You must provide a plant code.");
        }
        else if (empty($_POST["area"]))
        {
            apologize("You must provide a plant area code.");
        }
        else if (empty($_POST["basedate"]))
        {
            apologize("You must provide a basedate.");
        }
        else if (empty($_POST["created"]))
        {
            apologize("You must provide a creation date.");
        }
        else if (empty($_POST["critical"]))
        {
            $critical = 0;
        }
        else if (!empty($_POST["critical"]))
        {
            $critical = $_POST["critical"];
        }
        
        $active = 1;
        $editid = $_POST["id"];
        $tag = $_POST["tag"];
        $description = $_POST["description"];
        $plant = $_POST["plant"];
        $area = $_POST["area"];
        $equip_type = $_POST["equip_type"];
        $equip_subtype = $_POST["equip_subtype"];
        $owner = $_POST["owner"];
        $created = $_POST["created"];
        $basedate = $_POST["basedate"];
        $position = $_POST["position"];
        $ser_code = $_POST["ser_code"];
       
        
        $sqlstring  = "UPDATE tags SET ";
        $sqlstring .= "tag = '$tag', ";
        $sqlstring .= "description = '$description', ";
        $sqlstring .= "plant = '$plant', ";
        $sqlstring .= "area = '$area', ";
        $sqlstring .= "equip_type = '$equip_type', ";
        $sqlstring .= "equip_subtype = '$equip_subtype', ";
        $sqlstring .= "critical = '$critical', ";
        $sqlstring .= "created = '$created', ";
        $sqlstring .= "basedate = '$basedate', ";
        $sqlstring .= "owner = '$owner', ";
        $sqlstring .= "active = '$active', ";
        $sqlstring .= "position = '$position' ";
        $sqlstring .= "WHERE id = '$editid' ";
        
        $rows = query($sqlstring);
        
        $sqlstring  = "UPDATE serials SET tag_id = '$editid' ";
        $sqlstring .= "WHERE ser_code = '$ser_code'";
        $rows = query($sqlstring);
        
        redirect_to("/");
    
        
    }
    else
    {
        
        $rows = query("SELECT * FROM tags WHERE id= ?",$_GET["id"]);
        $serials = query("SELECT ser_code FROM serials WHERE tag_id = ?",$_GET["id"]);
        $equiptypes = query("SELECT * FROM equip_types");
        
        if (count($rows) == 1)
        {
            // first (and only) row
            $row = $rows[0];
            
            
            // find maintenance master for tag
            $rowcount = countrows("SELECT * FROM maint_master WHERE maint_master.equip_type = ?",$row["equip_type"]);
            if($rowcount !== 0)
            {
                $masters = query("SELECT * FROM maint_master WHERE maint_master.equip_type = ?",$row["equip_type"]);
                $master = $masters[0];
                $maintmaster=$master['master'];
            }
            else
            {
                $maintmaster="";
            }
            
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
            
            // render header
            require("../templates/header.php");
            ?>
            <div style="width:800px; height:400px; overflow:auto; margin:0 auto; ">
            
            <form action="edit_tag.php" method="post" role="form">
            <fieldset>
                 <input id="tagid" type="hidden" name="id" value="<?php echo $row["id"]; ?>"/>
             <div class="form-group">
                <label>Tag name:</label>
                <input autofocus class="form-control" name="tag" size="10" placeholder="tagname" type="text" align="left" value="<?php echo $row["tag"]; ?>"/>
             </div>
             <div class="form-group">
                <label>Description:</label>
                <input autofocus class="form-control" name="description" size="25" placeholder="description" type="text" align="left" value="<?php echo $row["description"]; ?>"/>
             </div>
             <div class="form-group">
                 <label>Plant:</label>
                 <input autofocus class="form-control" name="plant" size="10" placeholder="plant" type="text" value="<?php echo $row["plant"]; ?>"/>
             </div>
             <div class="form-group">
                 <label>Area:</label>
                 <input autofocus class="form-control" name="area" size="10" placeholder="area" type="text" value="<?php echo $row["area"]; ?>"/>
             </div>
             <div class="form-group">
                 <label>Equipment type:</label>
                 <select id="equip_type" class="form-control" name="equip_type" onchange="if (this.selectedIndex){
                 var tagid = document.getElementById('tagid').value;
                 var id = document.getElementById('equip_type');
                 var eqid = id.options[id.selectedIndex].value;
                 window.open('switch_sub.php?tagid='+tagid+'&id='+eqid); return false; } ">
                 <?php foreach ($equiptypes as $equiptype){
                 if ($equiptype['equip_type'] === $row['equip_type']) {
                 echo"<option value=\"".$equiptype['equip_type']."\" selected>".$equiptype['equip_type']."</option>";}
                 else {
                 echo"<option value=\"".$equiptype['equip_type']."\">".$equiptype['equip_type']."</option>";}
                 }?>
                 </select>
             </div>
             <div class="form-group">
                 <label class="col-sm-2 control-label">Equipment subtype:</label>
                 <div class="col-sm-10">
                 <?php if ($row['equip_subtype'] > ''){ ?>
                 <p class="form-control-static"><?php echo "<a href='switch_sub.php?tagid=".$row['id']."&id=".$row['equip_type']."'>".$row['equip_subtype']."</a>"; ?></p>
                 <?php }
                 else { ?>
                 <p class="form-control-static"><?php echo "<a href='switch_sub.php?tagid=".$row['id']."&id=".$row['equip_type']."'>Add subtype</a>"; ?></p>
     
                 <?php } ?>
                 </div>
             </div>
             <div class="form-group">
                 <label>Owner:</label>
                 <input autofocus class="form-control" name="owner" size="15" placeholder="equipment type" type="text" value="<?php echo $row["owner"]; ?>"/>
             </div>
             <div class="form-group">
                 <label>Created:</label>
                 <input autofocus class="form-control" name="created" placeholder="created" type="text" value="<?php echo $row["created"]; ?>"/>
             </div>
             <div class="form-group">
                 <label>Basedate:</label>
                 <input autofocus class="form-control" name="basedate" placeholder="basedate" type="text" value="<?php echo $row["basedate"]; ?>"/>
             </div>
             <div class="form-group">
                 <label>Position:</label>
                 <input autofocus class="form-control" name="position" size="15" placeholder="position" type="text" value="<?php echo $row["position"]; ?>"/>
             </div>

             <div class="form-group">
                 <label class="col-sm-2 control-label">Serial:</label>
                 <div class="col-sm-10">
                 <p class="form-control-static"><?= $currentserial ?></p>
             </div>
             <div class="form-group">
                <label class="col-sm-2 control-label">Maintenance Master:</label>
                <div class="col-sm-10">
                <p class="form-control-static"><?= $maintmaster ?></p>
                </div>
             </div>
             <div class="form-group">
                 <label class="col-sm-2 control-label">Critical:</label>
                 <input type="checkbox" name="critical" value="1" <?php if($row["critical"] ===1){echo "checked";} ?>/>
             </div>
            
            </fieldset>
            </div> 
            <button type="submit" class="btn btn-default">Update Tag</button>
            </form>
            <div class="form-group">
            <?php $editserial="<a href='switch_serial.php?id=".$_GET["id"]."'>Switch serial</a>"; ?>
            <?= $editserial ?>
            </div>
            <div class="form-group">
            <?php $reseteq="<a href='reset_eq.php?id=".$_GET["id"]."'>Reset Equipment</a>"; ?>
            <?= $reseteq ?>
            </div>
            <?php
            // insert service calls list in a scrollable div
            
            $servicecalls=query("SELECT * FROM service_call WHERE tag= ?",$row["tag"]);
            ?>
            <div style="overflow:auto;height:200px;">
            <table class="table table-striped">
            <thead>
            <tr>
                    <td>call id</td>
                    <td>open date</td>
                    <td>status</td>
                    <td>whours</td>
                    <td>close date</td>
                    <td>comment</td>
                </tr>
            </thead>
            <tbody>

            <?php foreach ($servicecalls as $servicecall): ?>
               <tr>
                    <?php $scalllink="<a href='edit_scall.php?id=".$servicecall["id"]."'>".$servicecall["id"]."</a>"; ?>
                    <td><?= $scalllink ?></td>
                    <td><?= $servicecall["date"] ?></td>
                    <td><?= $servicecall["opened"] ?></td>
                    <td><?= $servicecall["whours"] ?></td>
                    <td><?= $servicecall["closedate"] ?></td>
                    <td><?= $servicecall["comment"] ?></td>
                   
                </tr>
            <?php endforeach ?>
            </tbody>
            </table
            </div>
            
            <?php
            // render footer
            require("../templates/footer.php");
            
            
            
        }
        else
        {
        // else apologize
        apologize("Tag edit error");
        }
        
    }

?>
