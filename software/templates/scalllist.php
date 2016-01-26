<div style="overflow:auto;">
<table class="table table-striped">
<thead>
<tr>
        <td>Service call No.</td>
        <td>Tag</td>
        <td>Date</td>
        <td>Opened</td>
        <td>Work Hours</td>
        <td>Owner</td>
        <td>Close date</td>
        <td>Comment</td>
    </tr>
</thead>
<tbody>

<?php foreach ($positions as $position): ?>
   <tr>
        <?php $taglink="<a href='edit_scall.php?id=".$position["id"]."'>".$position["id"]."</a>"; ?>
        <td><?= $taglink ?></td>
        <td><?= $position["tag"] ?></td>
        <td><?= $position["date"] ?></td>
        <td><?= $position["opened"] ?></td>
        <td><?= $position["whours"] ?></td>
        <td><?= $position["owner"] ?></td>
        <td><?= $position["closedate"] ?></td>
        <td><?= $position["comment"] ?></td>
    </tr>
<?php endforeach ?>
</tbody>
</table
</div>
