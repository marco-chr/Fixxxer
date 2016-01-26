<?php

        $sqlstring  = "SELECT * FROM equip_types";
        $rows = query($sqlstring);
?>
<div style="width:600px; margin:0 auto;">
<form action="new_master.php" method="post" role="form" >
    <fieldset>
             
             <div class="form-group">   
             <label>Master:</label><input autofocus class="form-control" name="master" size="15" placeholder="master" type="text" align="left"/>
             </div>
             <div class="form-group">   
             <label>Rev:</label><input autofocus class="form-control" name="rev" size="3" placeholder="rev" type="text" align="left"/>
             </div>
             <div class="form-group"> 
             <label>SOP:</label><input autofocus class="form-control" name="sop" size="10" placeholder="sop" type="text"/>
             </div>
             <div class="form-group">
             <label>Equip Type:</label><select class="form-control" name="equip_type">
             <?php foreach ($rows as $row): ?>
             <option value="<?= $row['equip_type'] ?>"><?= $row['equip_type'] ?></option>
             <?php endforeach ?></select>
             </div>
             <div class="form-group"> 
             <label>Details:</label><textarea class="form-control" name="details" rows="3"></textarea>
             </div>
             <div class="form-group"> 
             <label>Remarks:</label><textarea class="form-control" name="remarks" rows="3"></textarea>
             </div>
             <div class="form-group">
             <label>Effective Date:</label><input autofocus class="form-control" name="effective" placeholder="effective" type="text"/>
             </div>
             
             <button type="submit" class="btn btn-default">Add Master</button>
             
             <span class="help-block">Click Add Master to define master work instructions in detail.</span>

             
    </fieldset>
</form>
</div>
