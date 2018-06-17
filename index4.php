<?php
/* Displays user information and some useful messages */
session_start();


if (isset($_SESSION['logged_in']))
{
	 
    // Makes it easier to read
	
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
	
	$loginindex = "LoginProfile()";
	//$loginindex = "shopping-cart/profile.php";
}else{
	$loginindex = "Login_id()";
	//$loginindex = "login-system/index.php";
	
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JS Bin</title>
  <?php include 'CSS/mystyle.html'; ?>  
</head>
<body >


<table class="header0">
<tr>
  <td class="header1" >MBE-PerformansShop</td>
  <td class="header2"><input class="he_search" type="text" placeholder="поиск" name="search2"></td>
  <td class="header3"><a class="header_login" onclick="<?php echo $loginindex;?>" ><div class="header-icon"><i class="fa fa-user-circle-o" style="font-size:34px"></i></a>
  <div class="header_login-name"><?php echo $_SESSION['first_name']; ?></div></div></td>
</tr>
</table>
  <!-- Меню Логин1 -->
  
    <div id="id01" class="MenuLogin" style="display:none" >
		<div class="MenuLogin_container">
			
			
			<input class="Login_Form_id01 Form_id001" placeholder="Email Address" type="email" required autocomplete="off" name="email" /><br>
			<input  class="Login_Form_id02 Form_id001" placeholder="Password" type="password" required autocomplete="off" name="password"/><br>
			<input  class="Login_Form_id03 Form_id001" placeholder="Email Address" type="hidden" required autocomplete="off" name='firstname' /><br>
			<input  class="Login_Form_id04 Form_id001" placeholder="Password" type="hidden"required autocomplete="off" name='lastname' /><br>
			<input id="Login_Form_checkbox" type="checkbox" onclick="Login_Form_Function()">Register
			
			<button class="Login_Form_id05" onclick="MenuLogin_Login('login')">Login</button>    
			
          
		</div>
	</div>
 
<script>Login_Form_Close()</script>


 <!-- Меню Логин1 -->

 

  <div id="menu" class="menu" >
   
  <ul>
   <script>
   if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementsByClassName("menu")[0].innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","mainmenu.php",true);
        xmlhttp.send();
		// alert(this.responseText);
    }
	


  </script>

  <li><a class="tablinks" href="#printer"              onclick="openTab(event, '0')">Принтеры</a></li>
  <li><a class="tablinks" href="#Server"               onclick="openTab(event, '1')">Серверы</a></li>
  <li><a class="tablinks" href="#setevoe-oborudovaniy" onclick="openTab(event, '2')">Сетевое оборудование</a></li>
  <li><a class="tablinks" href="#video-nabludenie"     onclick="openTab(event, '3')">Видеонаблюдение</a></li>
  <li><a class="tablinks" href="#comuter"              onclick="openTab(event, '4')">Компьютеры</a></li>
  <li><a class="tablinks" href="#teh-light"            onclick="openTab(event, '5')">Тех освещение</a></li>
</ul>
  </div> 
 
<div class="shoppingbasket1"> 
	<div class="shoppingbasket" onclick="cart()" >
		<div class="top"></div>
		<div class="bottom"></div>
		<div class="left"></div>
		<div class="right"></div>
		<div class="basketitems"><?php if(!empty($_SESSION['shopping_cart'])): echo $_SESSION['shopping_count']; endif;?></div>
	</div>
</div>
  <script>
   //var count = <?php echo $cart = count($_SESSION['shopping_cart']);?>;
   //if (count > 0){
	   //countCart(count);
	   //alert(count);
  // }
 </script>
 
 
 <!-- Левое меню -->
  <div class="vertical-menu"></div>
  <div class="vertical-menu1"></div>
 <!-- Левое меню -->
 
  <!--Меню корзины -->
  <div class="cart-menu"></div>
 <!-- Меню корзины -->

 
 <!-- Меню товара -->
    <div class="column right">
        <div class="menu-box"></div>
    </div>
 <!-- Меню товара -->
 

 
 <!-- Форма логина -->
 <!--<div id="id01" class="modal">

  <div class="modal-content animate">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button class="form-login-botton" onclick="loadDoc()">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button class="form-login-botton-cancal" type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </div>
</div>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

  <!-- Форма логина -->
</body>
</html>