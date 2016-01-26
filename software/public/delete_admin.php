<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php confirm_logged(); ?>
<?php

    $admin = find_admin_by_id($_GET["id"]);
    if (!$admin) {
    redirect_to("manage_admins.php");
    }
    
    $id = $admin["id"];
    $query  = "DELETE FROM admins WHERE id={$id} LIMIT 1";
    $result = mysqli_query($connection, $query);
    
    if ($result) {
      // ok
      $_SESSION["message"] = "Admin deleted.";
      redirect_to("manage_admins.php");
    } else {
      // not ok
      $_SESSION["message"] = "Admin deletion failed.";
      redirect_to("manage_admins.php");
    }
