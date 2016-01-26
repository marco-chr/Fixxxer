<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php require("../includes/constants.php");?>

<?php confirm_logged(); ?>

<?php

if (isset($_POST['submit'])) {
  
  // validations for input fields username and password
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("username" => 20);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {
    // Create users

    $username = mysql_prep($_POST["username"]);
    $hashed_password = pwd_encrypt($_POST["password"]);
    
    $query  = "INSERT INTO admins (";
    $query .= "  username, password";
    $query .= ") VALUES (";
    $query .= "  '{$username}', '{$hashed_password}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // ok
      $_SESSION["message"] = "Admin created.";
      redirect_to("manage_admins.php");
    } else {
      // not ok
      $_SESSION["message"] = "Admin creation failed.";
    }
  }
} else {
      require("../templates/header.php");
      ?>
      <div style="width:600px; margin:0 auto;">
        <?php echo message(); ?>
        <?php echo form_errors($errors); ?>
          
        <form action="new_admin.php" method="post" role="form">
        <fieldset>
             <div class="form-group">   
             <label>Username:</label><input autofocus class="form-control" name="username" placeholder="username" type="text" align="left" value=""/>
             </div>
             <div class="form-group">   
             <label>Password:</label><input autofocus class="form-control" name="password" placeholder="password" type="password" align="left" value=""/>
             </div>
             <input type="submit" class="btn btn-default" name="submit" value="Create Admin" />
        </fieldset> 
        
        </form>
        <div class="form-group">
            <a href="manage_admins.php">Cancel</a>
        </div>
        
      </div>
      <?php
      // render footer
      require("../templates/footer.php");
  
}
?>
