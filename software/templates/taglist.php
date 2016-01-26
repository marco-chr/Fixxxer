<div style="overflow:auto;">
<table class="table table-striped">
<thead>
<tr>
        <?php $header="<a href='index.php?orderby=tag&by=".$by."'>Tag</a>"; ?><td><?= $header ?></td>
        <?php $header="<a href='index.php?orderby=description&by=".$by."'>Description</a>"; ?><td><?= $header ?></td>
        <?php $header="<a href='index.php?orderby=plant&by=".$by."'>Plant</a>"; ?><td><?= $header ?></td>
        <?php $header="<a href='index.php?orderby=area&by=".$by."'>Area</a>"; ?><td><?= $header ?></td>
        <?php $header="<a href='index.php?orderby=ser_code&by=".$by."'>Serial No.</a>"; ?><td><?= $header ?></td>
        <?php $header="<a href='index.php?orderby=vendor&by=".$by."'>Vendor</a>"; ?><td><?= $header ?></td>
        <?php $header="<a href='index.php?orderby=model&by=".$by."'>Model</a>"; ?><td><?= $header ?></td>
        <?php $header="<a href='index.php?orderby=equip_type&by=".$by."'>Equip. Type</a>"; ?><td><?= $header ?></td>
        <?php $header="<a href='index.php?orderby=equip_subtype&by=".$by."'>Equip. SubType</a>"; ?><td><?= $header ?></td>
        <?php $header="<a href='index.php?orderby=owner&by=".$by."'>Owner</a>"; ?><td><?= $header ?></td>
        <?php $header="<a href='index.php?orderby=critical&by=".$by."'>Critical</a>"; ?><td><?= $header ?></td>
        <?php $header="<a href='index.php?orderby=created&by=".$by."'>Created</a>"; ?><td><?= $header ?></td>
    </tr>
</thead>
<tbody>

<?php foreach ($positions as $position): ?>
   <tr>
        <?php $taglink="<a href='edit_tag.php?id=".$position["id"]."'>".$position["tag"]."</a>"; ?>
        <td><?= $taglink ?></td>
        <td><?= $position["description"] ?></td>
        <td><?= $position["plant"] ?></td>
        <td><?= $position["area"] ?></td>
        <td><?= $position["ser_code"] ?></td>
        <td><?= $position["vendor"] ?></td>
        <td><?= $position["model"] ?></td>
        <td><?= $position["equip_type"] ?></td>
        <td><?= $position["equip_subtype"] ?></td>
        <td><?= $position["owner"] ?></td>
        <td><?= $position["critical"] ?></td>
        <td><?= $position["created"] ?></td>
    </tr>
<?php endforeach ?>
</tbody>
</table
</div>
