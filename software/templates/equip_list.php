<div style="overflow:auto;">
<table class="table table-striped">
<thead>
<tr>
        <td>Tag</td>
        <td>Description</td>
        
    </tr>
</thead>
<tbody>

<?php foreach ($positions as $position): ?>
   <tr>
        <?php $taglink="<a href='edit_equip.php?id=".$position["id"]."'>".$position["equip_type"]."</a>"; ?>
        <td><?= $taglink ?></td>
        <td><?= $position["description"] ?></td>
        
    </tr>
<?php endforeach ?>
</tbody>
</table
</div>
