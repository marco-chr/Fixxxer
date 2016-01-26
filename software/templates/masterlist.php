<div style="overflow:auto;">
<table class="table table-striped">
<thead>
<tr>
        <td>Master</td>
        <td>Revision</td>
        <td>Active</td>
        <td>Equipment Type</td>
        <td>SOP</td>
        <td>Effective</td>
        
    </tr>
</thead>
<tbody>

<?php foreach ($positions as $position): ?>
   <tr>
        <?php $taglink="<a href='edit_master.php?id=".$position["id"]."'>".$position["master"]."</a>"; ?>
        <td><?= $taglink ?></td>
        <td><?= $position["rev"] ?></td>
        <td><?= ($position["active"] ? 'yes' : 'no') ?></td>
        <td><?= $position["equip_type"] ?></td>
        <td><?= $position["sop"] ?></td>
        <td><?= $position["effective"] ?></td>
        
    </tr>
<?php endforeach ?>
</tbody>
</table
</div>
