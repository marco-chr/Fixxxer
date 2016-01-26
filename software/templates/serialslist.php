<div style="overflow:auto;">
<table class="table table-striped">
<thead>
<tr>
        <td>Serial</td>
        <td>Description</td>
        <td>Family</td>
        <td>Vendor</td>
        <td>Model</td>
        
    </tr>
</thead>
<tbody>

<?php foreach ($positions as $position): ?>
   <tr>
        <td><?= $position["ser_code"] ?></td>
        <td><?= $position["description"] ?></td>
        <td><?= $position["family"] ?></td>
        <td><?= $position["vendor"] ?></td>
        <td><?= $position["model"] ?></td>
        
    </tr>
<?php endforeach ?>
</tbody>
</table
</div>
