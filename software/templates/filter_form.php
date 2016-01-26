<div style="width:600px; margin:0 auto;">
<form action="filter_tag.php" method="post" role="form" >
    <fieldset>
             
             <div class="form-group">   
             <label>Tag name:</label><input autofocus class="form-control" name="searchstring[]" size="10" placeholder="tagname" type="text" />
             </div>
             <div class="form-group">   
             <label>Description:</label><input autofocus class="form-control" name="searchstring[]" size="25" placeholder="description" type="text" />
             </div>
             <div class="form-group"> 
             <label>Plant:</label><input autofocus class="form-control" name="searchstring[]" size="10" placeholder="plant" type="text"/>
             </div>
             <div class="form-group"> 
             <label>Area:</label><input autofocus class="form-control" name="searchstring[]" size="10" placeholder="area" type="text"/>
             </div>
             <div class="form-group"> 
             <label>Equipment type:</label><input autofocus class="form-control" name="searchstring[]" size="25" placeholder="equipment type" type="text"/>
             </div>
             <div class="form-group">
             <label>Equipment subtype:</label><input autofocus class="form-control" name="searchstring[]" size="25" placeholder="equipment subtype" type="text"/>
             </div>
             <div class="form-group">
             <label>Owner:</label><input autofocus class="form-control" name="searchstring[]" size="15" placeholder="owner" type="text"/>
             </div>
             <div class="form-group">
             <label>Created:</label><input autofocus class="form-control" name="searchstring[]" placeholder="created" type="text"/>
             </div>
             <div class="form-group">
             <label>Basedate:</label><input autofocus class="form-control" name="searchstring[]" placeholder="basedate" type="text"/>
             </div>
             <div class="form-group">
             <label>Position:</label><input autofocus class="form-control" name="searchstring[]" size="15" placeholder="position" type="text"/>
             </div>
             <div class="form-group">
             <label>Critical:</label><input type="checkbox" name="searchstring[]" value="1"/>
             </div>
     </fieldset>
     <button type="submit" class="btn btn-default">Query</button>
</form>
</div>
