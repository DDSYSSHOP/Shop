<?php 
/* Main page with two forms: sign up and log in */

require 'db.php';
session_start();
//print_r($_POST);
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
        echo "You have entered wrong password, try again!";
    }
	}
}


    elseif (isset($_POST['register'])) { //user registering
        
       

		// Escape all $_POST variables to protect against SQL injections
		$first_name = $mysqli->escape_string($_POST['firstname']);
		$last_name = $mysqli->escape_string($_POST['lastname']);
		$email = $mysqli->escape_string($_POST['email']);
		$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
		$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
			  
		// Check if user with that email already exists
		$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

		// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {
    
    $_SESSION['message'] = 'User with this email already exists!';
		echo "User with this email already exists!";
    
}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (first_name, last_name, email, password, hash) " 
            . "VALUES ('$first_name','$last_name','$email','$password', '$hash')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =
                
                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";
	// Set session variables to be used on profile.php page
		$_SESSION['email'] = $_POST['email'];
		$_SESSION['first_name'] = $_POST['firstname'];
		$_SESSION['last_name'] = $_POST['lastname'];
        // Send registration confirmation link (verify.php)
        $to      = $email;
        $subject = 'Account Verification ( clevertechie.com )';
		$headers  = "Content-type: text/html; charset=UTF-8 \r\n"; 
		$headers .= "From: Магазин DDSYS <info@ddsys.ru>\r\n"; 
		$headers .= "Reply-To: info@ddsys.ru\r\n"; 
        $message_body = '
        Hello '.$first_name.',
		

        Thank you for signing up!

        Please click this link to activate your account:

        http://test.ddsys.ru/login-system/verify.php?email='.$email.'&hash='.$hash;  

        mail( $to, $subject, $message_body, $headers );

        header("location: profile.php"); 

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        echo "Registration failed!";
    }

}
        
    }
}
?>