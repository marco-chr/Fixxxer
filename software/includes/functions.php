<?php

  /**
  * Find admins.
  */
  function find_all_admins() {
    global $connection;
    
    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "ORDER BY username ASC";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    return $admin_set;
  }
  
  /**
  * Find admins.
  */
  function find_admin_by_id($admin_id) {
    global $connection;
    
    $safe_admin_id = mysqli_real_escape_string($connection, $admin_id);
    
    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE id = {$safe_admin_id} ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
      return null;
    }    
  }
  
  /**
  * Find admins.
  */
    function find_admin_by_username($admin_username) {
    global $connection;
    
    $safe_admin_username = mysqli_real_escape_string($connection, $admin_username);
    
    $query = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE username = '{$safe_admin_username}' ";
    $query .= "LIMIT 1";
    $admin_set = mysqli_query($connection, $query);
    confirm_query($admin_set);
    if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
    } else {
      return null;
    }    
  }
  
  function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
  }

  function mysql_prep($string) {
    global $connection;
    
    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string;
  }
  
  function confirm_query($result_set) {
    if (!$result_set) {
      die("Database query failed.");
    }
  }

  function form_errors($errors=array()) {
    $output = "";
    if (!empty($errors)) {
      $output .= "<div class=\"error\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach ($errors as $key => $error) {
        $output .= "<li>";
        $output .= htmlentities($error);
        $output .= "</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }
  
  function pwd_encrypt($password) {
  
     $hash_format = "$2y$10$";
     $salt_length = 22;
     $salt = generate_salt($salt_length);
     $formatsalt = $hash_format . $salt;
     $hash = crypt($password,$formatsalt);
     return $hash;
  }

  function generate_salt($length) {
  
     $rnd = md5(uniqid(mt_rand(),true));
     $base64 = base64_encode($rnd);
     $base642 = str_replace('+','.',$base64);
     $salt = substr($base642,0,$length);
     return $salt;
  }
   
  function pwd_check($password,$existing) {
     
     $hash = crypt($password,$existing);
     echo $hash;
     echo $existing;
     
     if ($hash === $existing) {
            return true;
     } else {
       return false;
     }            
  }
  
  function login($username,$password) {
     $admin= find_admin_by_username($username);   
     if ($admin) {
        if (pwd_check($password,$admin["password"])) {
           return $admin; } 
        else {
            // password wrong
            return false;
        }
     }
     else {
       // username wrong
       return false;
     }   
     
  }
  
  function confirm_logged() {
   if (!isset($_SESSION['admin_id']))
    {
        redirect_to("login.php"); 
    } 
  }
  
  /**
  * Renders template, passing in values.
  */
    function render($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("../templates/$template"))
        {
            // extract variables into local scope
            extract($values);

            // render header
            require("../templates/header.php");

            // render template
            require("../templates/$template");

            // render footer
            require("../templates/footer.php");
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }   

    /**
     * Executes SQL statement, possibly with parameters, returning
     * an array of all rows in result set or false on (non-fatal) error.
     */
    function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            trigger_error($handle->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);
        
        
        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }
    /**
     * Executes SQL statement, possibly with parameters, returning
     * the number or rows resulting from the query or false on (non-fatal) error.
     */
    function countrows(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            trigger_error($handle->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);
        $count = $statement->rowCount();
        
        // return result set's rows, if any
        if ($results !== false)
        {
            return $count;
        }
        else
        {
            return false;
        }
    }

    /**
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render("apology.php", ["message" => $message]);
        exit;
    }
?>
