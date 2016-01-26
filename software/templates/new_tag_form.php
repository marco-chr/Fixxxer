<?php

        $sqlstring  = "SELECT ser_code FROM serials WHERE tag_id IS NULL";
        $rows = query($sqlstring);
?>
<div style="width:600px; margin:0 auto;">
<form action="new_tag.php" method="post" role="form" >
    <fieldset>
             
             <div class="form-group">   
             <label>Tag name:</label><input autofocus class="form-control" name="tag" size="10" placeholder="tagname" type="text" align="left"/>
             </div>
             <div class="form-group">   
             <label>Description:</label><input autofocus class="form-control" name="description" size="25" placeholder="description" type="text" align="left"/>
             </div>
             <div class="form-group"> 
             <label>Plant:</label><input autofocus class="form-control" name="plant" size="10" placeholder="plant" type="text"/>
             </div>
             <div class="form-group"> 
             <label>Area:</label><input autofocus class="form-control" name="area" size="10" placeholder="area" type="text"/>
             </div>
             <div class="form-group"> 
             <label>Equipment type:</label><input autofocus class="form-control" name="equip_type" size="25" placeholder="equipment type" type="text"/>
             </div>
             <div class="form-group">
             <label>Equipment subtype:</label><input autofocus class="form-control" name="equip_subtype" size="25" placeholder="equipment subtype" type="text"/>
             </div>
             <div class="form-group">
             <label>Owner:</label><input autofocus class="form-control" name="owner" size="15" placeholder="owner" type="text"/>
             </div>
             <div class="form-group">
             <label>Created:</label><input autofocus class="form-control" name="created" placeholder="created" type="text"/>
             </div>
             <div class="form-group">
             <label>Basedate:</label><input autofocus class="form-control" name="basedate" placeholder="basedate" type="text"/>
             </div>
             <div class="form-group">
             <label>Position:</label><input autofocus class="form-control" name="position" size="15" placeholder="position" type="text"/>
             </div>
             <div class="form-group">
             <label>Serial:</label><select class="form-control" name="ser_code">
             <?php foreach ($rows as $row): ?>
             <option value="<?= $row['ser_code'] ?>"><?= $row['ser_code'] ?></option>
             <?php endforeach ?></select>
             </div>
             <div class="checkbox">
             <label>Critical:</label><input type="checkbox" name="critical" value="1"/>
             </div>
             <button type="submit" class="btn btn-default">Add Tag</button>
             
    </fieldset>
</form>
</div>
