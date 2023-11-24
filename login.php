<?php
session_start();
 
require_once "db.php";
 
if (isset($_SESSION['user_id']) != "") {
    header("Location: dashboard.php");
}
 
if (isset($_POST['login'])) {
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
     
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Please Enter Valid Email ID";
    }
    if (strlen($password) < 6) {
        $password_error = "Password must be minimum of 6 characters";
    }
     
    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email . "' and password = '" . md5($password) . "'");
    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['user_id']     = $row['uid'];
        $_SESSION['user_name']   = $row['name'];
        $_SESSION['user_mobile'] = $row['mobile'];
        $_SESSION['user_email']  = $row['email'];
        header("Location: dashboard.php");


        $error_message = "Incorrect Email or Password!!!";

    }

}

?>
