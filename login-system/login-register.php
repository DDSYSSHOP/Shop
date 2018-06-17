<?php 
/* Main page with two forms: sign up and log in */

require 'db.php';
session_start();
print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

       $email = $mysqli->escape_string($_POST['email']);
	   $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
			if ( $result->num_rows == 0 ){ // User doesn't exist
			$_SESSION['message'] = "User with that email doesn't exist!";
    echo "User with that email doesn't exist!";
}
        
    else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];
        
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: profile.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
	}
}


    elseif (isset($_POST['register'])) { //user registering
        
        require 'register.php';
        
    }
}
?>