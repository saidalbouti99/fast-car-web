<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    // header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define 

$new_password = $confirm_password = $old_password="";
$new_password_err = $confirm_password_err = $old_password_err=  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
     if(empty(trim($_POST["old_password"]))){
        $old_password_err = "Please enter your old password.";
    } else{
        $old_password = trim($_POST["old_password"]);
    }

    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
     if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT fld_staff_num, password FROM tbl_staffs_a167552_pt2 ";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            // $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            // $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                // if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["fld_staff_num"];
                        // $username = $row["username"];
                        $password2 = $row["password"];
                        if($old_password==$password2){
                            // Password is correct, so start a new session
                            // session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            // $_SESSION["fld_staff_num"] = $id;
                                                      
                            
                            // Redirect user to welcome page
                            // header("location: login.php");
                        } else{
                            // Display an error message if password is not valid
                            $old_password_err = "The password you entered was not valid.";
                        }
                    }
                 else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE tbl_staffs_a167552_pt2 SET password = :password WHERE fld_staff_num = :id";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":id", $param_id, PDO::PARAM_STR);
            
            // Set parameters
            $param_password = $new_password;
            $param_id = $_SESSION["fld_staff_num"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){

                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                 // $_SESSION['message'] = "Change Password Successful";
                header("Location: login.php?Message=Change Password Successful" . urlencode($Message));
                // header("location: login.php");
               // echo '<script>alert("Change Password Successful")</script>'; 


                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }

    </style>

<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include_once 'nav_bar.php'; ?>
    <div class="wrapper">

        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($old_password_err)) ? 'has-error' : ''; ?>">
                <label>Old Password</label>
                <input type="password" name="old_password" class="form-control" value="<?php echo $old_password; ?>">
                <span class="help-block"><?php echo $old_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link" href="index.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>

