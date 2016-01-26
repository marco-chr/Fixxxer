<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
$username ="";
$password ="";

if (isset($_POST['submit'])) {
  
  // validations for input fields username and password
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  if (empty($errors)) {
    // Login users
    $username=$_POST["username"];
    $password=$_POST["password"];
    $found = login($username,$password);

    if ($found) {
      // ok
      $_SESSION["admin_id"]=$found["id"];
      $_SESSION["username"]=$found["username"];
      redirect_to("index.php");
    } else {
      // not ok
      $_SESSION["message"] = "Username/Password wrong";
    }
  }
} else {
  // get request
  
} // end: if (isset($_POST['submit']))

?>

    <?php require("../templates/header.php"); ?>
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    
    
    <form action="login.php" method="post" class="form-inline" role="form">
    <fieldset>
    <div class="form-group"> 
      <label>Username:</label><input class="form-control" type="text" name="username" value="" />
      <label>Password:</label><input class="form-control" type="password" name="password" value="" />
      <input type="submit" class="btn btn-default" name="submit" value="Login" />
    </div>
    </fieldset>
    </form>
    <?php require("../templates/footer.php"); ?>

