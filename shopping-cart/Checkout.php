<?php
require '../login-system/db.php';

session_start();
if (isset($_SESSION['logged_in']))
{
 $order_id = mt_rand(0,10000);	
 
 //return print_r ($_SESSION['shopping_cart']);
 $user_email = $mysqli->escape_string($_SESSION['email']);
foreach($_SESSION['shopping_cart'] as $keys => $products){

$product_id = $mysqli->escape_string($products['id']);
$product_name = $mysqli->escape_string($products['name']);
$quantity = $mysqli->escape_string($products['quantity']);
$price = $mysqli->escape_string($products['price']);
 

$sql = "INSERT INTO Cart (user_email, product_id, order_id, product_name, quantity, price) " 
            . "VALUES ('$user_email', '$product_id','$order_id','$product_name','$quantity', '$price')";
			mysqli_set_charset($mysqli, 'utf8');
			$mysqli->query($sql) or die("Ошибка " . $mysqli->error); 
			

 }
} else{ 
echo "You need login.";
 header("location: ../index4.php");
}

?>