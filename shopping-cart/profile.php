<?php
session_start();


// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1  and $_SESSION['active'] != 1) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  echo "You need login";  
  header("location: ../index4.php");
}
require '../login-system/db.php';
$user_email = $_SESSION['email'];
$sql_menu = "SELECT DISTINCT  `order_id`,`created` FROM `Cart` WHERE user_email='$user_email'";
$sql_id = "SELECT DISTINCT  `order_id` FROM Cart WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= `created`";

	mysqli_set_charset($mysqli, 'utf8');
		
	$result_menu = $mysqli->query($sql_menu) or die("Ошибка " . $mysqli->error); 
	
	while ($row_menu =mysqli_fetch_assoc($result_menu)) :
	$row_id = $row_menu['order_id'];
	$sql = "SELECT  product_name, ordered, product_id, quantity, price FROM Cart WHERE user_email='$user_email' AND order_id='$row_id'";
	$result = $mysqli->query($sql) or die("Ошибка " . $mysqli->error);

	//print_r ($row_id);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart (working)</title>
        <link rel="stylesheet" type="text/css" href="cart.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="../Script/Script.js"></script>
    </head>
	<body>
	
	
        <div class="container">
        
        <div style="clear:both"></div>  
        <br />  
        <div class="table-responsive">  
        <table class="table">  
            <tr><th colspan="5"><h3>Order Details  №  <?php echo $row_menu['order_id']  ."  Time:  ". $row_menu['created'];  ?></h3></th></tr>   
        <tr>  
             <th width="40%">Product Name</th>  
             <th width="10%">Quantity</th>  
             <th width="20%">Price</th>  
             <th width="15%">Total</th>  
             <th width="5%">Action</th>  
        </tr>  
<?php
	  if($result): 
	  
			 $total = 0;  
			 $countinput = 0;
			 $counttotal = 0;
			 
			 
			while ($row =mysqli_fetch_assoc($result)) :
			

			 if ($row['ordered']) {
				 $productpayd =  disabled;
			 } else {
				 
				$productpayd =  enabled;
			 }
			 
			 
			?>
			<tr>  
           <td class="input_name"><?php echo $row['product_name']; ?></td> 
		   
           <td class="input_count"><input class="input_count_form" type="number" oninput="countvalue(<?php echo $row['product_id']; ?>,'<?php echo $row[' product_name'];?>',<?php echo $row['price']; ?>,this.value)"  min="0" max="100" value =<?php echo $row['quantity']; ?> <?php echo $productpayd; ?> ></td>  
           <td class="input_price">$ <?php echo $row['price']; ?></td>  
           <td  class="input_sum">$ <?php echo number_format($row['quantity'] * $row['price'], 2); ?></td>  
           <td class="input_remove">
               <a onclick="delcart(<?php echo $row['id']; ?>)">
                    <div class="btn-danger">Remove</div>
               </a>
           </td>  
        </tr>  
		

 <?php  
                  $total = $total + ($row['quantity'] * $row['price']); 
				 // $counttotal   +=   $product['quantity'];
				  //$_SESSION['shopping_count'] = $counttotal;
				 // pre_r ($counttotal);
				  
               endwhile; 
			 
        ?> 
		
        <tr>  
             <td colspan="3" align="right">Total</td>  
             <td class="input_total" align="right">$ <?php echo number_format($total, 2); ?></td>  
			
             <td></td>  
        </tr>  
        <tr>
            <!-- Show checkout button only if the shopping cart is not empty -->
            <td colspan="5">
             <?php 
                if (isset($_SESSION['shopping_cart'])):
                if (count($_SESSION['shopping_cart']) > 0):
             ?>
                <a onclick="Checkout()" class="button">Checkout</a> 
             <?php endif; endif; ?>
            </td>
        </tr>
        <?php   
        endif;
		endwhile;
        ?>  
        </table>  
         </div>
        </div>
	</body>
	</html>