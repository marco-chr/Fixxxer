<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php");?>
<?php require("../includes/constants.php");?>

<?php confirm_logged(); ?>
 
<?php
  $admin_set = find_all_admins();
?>

    <?php
    // render header
    require("../templates/header.php");?>
    <div style="width:800px; margin:0 auto;">
    <table align="center">
      <tr>
        <th style="text-align: left; width: 200px;">Username</th>
        <th colspan="2" style="text-align: left;">Actions</th>
      </tr>
    <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
      <tr>
        <td style="text-align: left;"><?php echo htmlentities($admin["username"]); ?></td>
        <td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">Edit</a></td>
        <td><a href="delete_admin.php?id=<?php echo urlencode($admin["id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
      </tr>
    <?php } ?>
    </table>
    </div>
    <br />
    <a href="new_admin.php">Add new admin</a>
    <?php
    // render footer
    require("../templates/footer.php");


