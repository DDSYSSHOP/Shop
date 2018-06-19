<?php
require '../login-system/db.php';

session_start();

if ( $_SESSION['logged_in'] != 1 AND  $_SESSION['active'] = 0) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
      
  echo "You need activate account";
  header("location: login-system/error.php");
} 


$product_ids = array();
//unset($_SESSION['shopping_cart']);
//session_destroy();
//pre_r($_GET);
//check if Add to Cart button has been submitted
if(filter_input(INPUT_POST, 'add_to_cart')){
    if(isset($_SESSION['shopping_cart'])){
        
        //keep track of how mnay products are in the shopping cart
        $count = count($_SESSION['shopping_cart']);
        
        //create sequantial array for matching array keys to products id's
        $product_ids = array_column($_SESSION['shopping_cart'], 'id');
        
        if (!in_array(filter_input(INPUT_POST, 'id'), $product_ids)){
        $_SESSION['shopping_cart'][$count] = array
            (
                'id' => filter_input(INPUT_POST, 'id'),
                'name' => filter_input(INPUT_POST, 'name'),
                'price' => filter_input(INPUT_POST, 'price'),
                'quantity' => filter_input(INPUT_POST, 'quantity')
				
            );   
        }
        else { //product already exists, increase quantity
            //match array key to id of the product being added to the cart
            for ($i = 0; $i < count($product_ids); $i++){
                if ($product_ids[$i] == filter_input(INPUT_POST, 'id')){
                    //add item quantity to the existing product in the array
                    $_SESSION['shopping_cart'][$i]['quantity'] = filter_input(INPUT_POST, 'quantity');
                }
            }
        }
        
    }
    else { //if shopping cart doesn't exist, create first product with array key 0
        //create array using submitted form data, start from key 0 and fill it with values
        $_SESSION['shopping_cart'][0] = array
        (
            'id' => filter_input(INPUT_POST, 'id'),
            'name' => filter_input(INPUT_POST, 'name'),
            'price' => filter_input(INPUT_POST, 'price'),
            'quantity' => filter_input(INPUT_POST, 'quantity')
			
			
        );
    }

}
if(filter_input(INPUT_GET, 'action') == 'delete'){
    //loop through all products in the shopping cart until it matches with GET id variable
    foreach($_SESSION['shopping_cart'] as $key => $product){
        if ($product['id'] == filter_input(INPUT_GET, 'id')){
			 
            //remove product from the shopping cart when it matches with the GET id
            unset($_SESSION['shopping_cart'][$key]);
        }
    }
    //reset session array keys so they match with $product_ids numeric array
    $_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

//pre_r($_SESSION['shopping_cart']['quantity']);

//pre_r ($cart = count($_SESSION['shopping_cart']) );
//pre_r ($mysqli); 
function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
unset($_SESSION);
//unset ($_SESSION['shopping_count']);
session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart (working)</title>
        
        
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script src="Script.js"></script>
    </head>
	<body>
	
	
        <div class="container">
        
        <div style="clear:both"></div>  
        <br />  
        <div class="table-responsive">  
        <table class="table">  
            <tr><th colspan="5"><h3>Order Details</h3></th></tr>   
        <tr>  
             <th width="40%">Product Name</th>  
             <th width="10%">Quantity</th>  
             <th width="20%">Price</th>  
             <th width="15%">Total</th>  
             <th width="5%">Action</th>  
        </tr>  
        <?php   
        if(!empty($_SESSION['shopping_cart'])):  
            
             $total = 0;  
			 $countinput = 0;
			 $counttotal = 0;
			 
             foreach($_SESSION['shopping_cart'] as $key => $product): 
				 

        ?>  
        <tr>  
           <td class="input_name"><?php echo $product['name']; ?></td>  
           <td class="input_count"><input class="input_count_form" type="number" oninput="countvalue(<?php echo $product['id']; ?>,'<?php echo $product['name'];?>',<?php echo $product['price']; ?>,this.value)"  min="1" max="100" value =<?php echo $product['quantity']; ?> ></td>  
           <td class="input_price" >$ <?php echo $product['price']; ?></td>  
           <td class="input_sum">$ <?php echo number_format($product['quantity'] * $product['price'], 0); ?></td>  
           <td  class="input_remove">
               <a onclick="delcart(<?php echo $product['id']; ?>,<?php echo $cart = count($_SESSION['shopping_cart']);?>)">
                    <div class="btn-danger">Remove</div>
               </a>
           </td>  
        </tr>  
        <?php  
                  $total = $total + ($product['quantity'] * $product['price']); 
				  $counttotal   +=   $product['quantity'];
				  $_SESSION['shopping_count'] = $counttotal;
				 // pre_r ($counttotal);
				  
             endforeach;  
			 
        ?> 
		
		
        <tr>  
             <td colspan="3" align="right">Total</td>  
             <td class="input_total" align="right">$ <?php echo number_format($total, 0); ?></td>  
			
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
        ?>  
        </table>  
         </div>
        </div>
	</body>
	</html>