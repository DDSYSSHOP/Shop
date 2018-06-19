function openTab(evt, tabName,val) {
	var i, tabcontent, tablinks;
	 tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace("active", "");
     //alert(tablinks.lengt); 
    }
//	 tabcontent[tabName].style.display = "block";
   // document.getElementsByClassName("right")[0].style.marginLeft = "20%";
    evt.currentTarget.className += " active";
	   
	
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				//alert(this.responseText);
				
				//document.getElementsByClassName("vertical-menu")[0].className"vertical-menu");
				
                document.getElementsByClassName("vertical-menu")[0].innerHTML = this.responseText;
				document.getElementsByClassName("vertical-menu")[0].style.display = "block";
				document.getElementsByClassName("cart-menu")[0].style.display = "none";
            }
        };
        xmlhttp.open("GET","vertical-menu.php?q="+val,true);
        xmlhttp.send();
		// alert(xmlhttp.readyState);
    }
 tabcontent = document.getElementsByClassName("menu-box");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
   }
 
}

function openMenu(evt, num){ 
 // alert(num); 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementsByClassName("menu-box")[0].innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","tovar.php?q="+num,true);
        xmlhttp.send();
		// alert(xmlhttp.open.value);
    }
	 button();
	 tabcontent = document.getElementsByClassName("menu-box");
	 tabcontent[0].style.display = "block";
	 slideUp(); 
}
  
function Menu(){
           // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
 	if (window.XMLHttpRequest) {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementsByClassName("menu")[0].innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","mainmenu.php",true);
        xmlhttp.send();
		// alert(this.responseText);
    }
}



function button(){
	//alert(111);
window.scrollTo(0,30);
};



function slideUp() {
    if (document.body.scrollTop > 350 || document.documentElement.scrollTop > 350) {
        document.getElementById("menu-box").className = "slideUp";
       //   alert(document.documentElement.scrollTop);
    }
   
}


//Отображение количества товаров в корзине
function AddCart(id,name,price,quantity){
//alert(id);

var a = document.getElementsByClassName("basketitems")[0];
	//alert(a);
	if (a == undefined){
	//	alert(count);
    var para = document.createElement("div");
    var t = document.createTextNode(1);
   
    var att = document.createAttribute("class");
    att.value = "basketitems";
    para.setAttributeNode(att);
    para.appendChild(t);
    document.getElementsByClassName("shoppingbasket")[0].appendChild(para);
	add (id,name,price,quantity);

	} else {
	
    next();
	add (id,name,price,quantity);
	
	}
}
//Колличество товаров оставшееся в корзине при загрузе страницы
function countCart(count){
	
    var para = document.createElement("div");
    var t = document.createTextNode(count);
    var att = document.createAttribute("class");
    att.value = "basketitems";
    para.setAttributeNode(att);
    para.appendChild(t);
	document.getElementsByClassName("shoppingbasket")[0].appendChild(para);
}
//Колличество товаров оставшееся в корзине при загрузе страницы
function next() {
	var a = document.getElementsByClassName("basketitems")[0].innerHTML;
	//alert(a);
//var a = getElementsByClassName("basketitems")[0].value;
//var a = 1;
if (a < 100) {
  a++;
  displayCD(a);
  }
 
}

function displayCD(a) {
//alert(a);
        //document.getElementById("input").value = i;
		//aaa = document.getElementsByClassName("basketitems")[0].innerHTML;
		//alert(aaa);
		if (a == 0){
		var parent = document.getElementsByClassName("shoppingbasket")[0];
		var child = document.getElementsByClassName("basketitems")[0];
		parent.removeChild(child);
		}
		else {
        document.getElementsByClassName("basketitems")[0].innerHTML = a;
		}
  }
  //Отображение количества товаров в корзине 
  
  
function add(id,name,price,quantity) {
 //alert(id+""+name+""+price+"."+quantity); 
	 var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     // document.getElementById("menu-box").innerHTML = this.responseText;
	  
    }
  };
  xhttp.open("POST", "shopping-cart/cart2.php", true); 
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("id="+id+"&name="+name+"&price="+price+"&quantity="+quantity+"&add_to_cart=Add to Cart");
 // alert(xhttp.readyState);
}
//Запрос на показ корзины
function cart(){
	//alert(1); 
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	 document.getElementsByClassName("menu-box")[0].style.display = "none";
	 document.getElementsByClassName("vertical-menu")[0].style.display = "none";
	// document.getElementsByClassName("vertical-menu")[0].classList.remove("vertical-menu");
     document.getElementsByClassName("cart-menu")[0].innerHTML = this.responseText; 
	 document.getElementsByClassName("cart-menu")[0].style.display = "block";
    }
  };
  xhttp.open("POST", "shopping-cart/cart2.php", true); 
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
	
}
//Запрос на показ корзины


//удаление товаров из карзины
function delcart(delid,countcart){
//alert(countcart);
	countcart--;
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementsByClassName("cart-menu")[0].innerHTML = this.responseText; 
	 displayCD(countcart);
	  //countvalue();
	// alert(countcart);
    }
  };
  xhttp.open("GET", "shopping-cart/cart2.php?action=delete&id="+delid, true); 
  	 xhttp.send();
	//alert(delid);
}
//удаление товаров из карзины


//Изменение колличества товаров в корзине
//Изменение колличества товаров в таблице товара


function countvalue(id,name,price,quantity){
	//alert(id+""+name+""+price+""+quantity);
	var sum = 0;//задаем 0 отсчета суммы корзины
	var total = 0;//задаем 0 отсчета ОБЩЕЙ суммы корзины
    var input_count_form = document.getElementsByClassName("input_count_form"); //получаем значения колличества товара в корзине
	var input_price = document.getElementsByClassName("input_price"); //получаем значения цену товара в корзине
	
	
	for ( h = 0 ; h < input_count_form.length; h++){
		if (input_count_form[h].value == 0){input_count_form[h].value =1;}
    //if (input[h].value == 0){input_sum[h].innerHTML.slice(1)=input_price[h].innerHTML.slice(1);}
      sum +=  Number(input_count_form[h].value); // внутри цикла выводится - каждую итерацию
	//alert(sum);
	  
      //alert(input_sum[h].innerHTML.slice(1)); 
	  summ = Number(input_count_form[h].value *input_price[h].innerHTML.slice(1));
	  total += summ;
	  document.getElementsByClassName("input_sum")[h].innerHTML = "$"+" "+summ;
      //alert(total);
    }
	
	document.getElementsByClassName("input_total")[0].innerHTML = "$"+" "+total;
	//alert(input_price[h].innerHTML.slice(1));
	 if (sum ==0){document.getElementsByClassName("basketitems")[0].innerHTML = "";} 
	 else{document.getElementsByClassName("basketitems")[0].innerHTML = sum;}
	
	add(id,name,price,quantity);
	//cart();
	//alert(id);
	
 }
//Изменение колличества товаров в таблице товара

//Click Button checkout 
function Checkout(){
var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     //document.getElementsByClassName("cart-menu")[0].innerHTML = this.responseText; 
	// displayCD(countcart);
	  //countvalue();
	 alert("Ok");
    }
  };
  xhttp.open("GET", "shopping-cart/Checkout.php", true); 
  	 xhttp.send();
}
//Click Button checkout 


//Click Button Login Index Page 
function Login_id(){
		 //alert("Ok");
	var  MenuLogin = document.getElementsByClassName("MenuLogin")[0];
		 if (MenuLogin.style.display === "none") {
                MenuLogin.style.display = "block";
        } else {
                MenuLogin.style.display = "none";
               }

}

//Click Button Login Index Page 


//Login in profile
function LoginProfile(){
	//alert(1); 
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	 document.getElementsByClassName("menu-box")[0].style.display = "none";
	 document.getElementsByClassName("vertical-menu")[0].style.display = "none";
	// document.getElementsByClassName("vertical-menu")[0].classList.remove("vertical-menu");
     document.getElementsByClassName("cart-menu")[0].innerHTML = this.responseText; 
	 document.getElementsByClassName("cart-menu")[0].style.display = "block";
    }
  };
  xhttp.open("POST", "shopping-cart/profile.php", true); 
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
	
}
//Login in profile

function MenuLogin_Login(a){
	//alert(a);
	var Form_id001 = document.getElementsByClassName("Form_id001");
	
	if (a == 'login'){
		var MenuLogin_Input_login = document.getElementsByClassName("Login_Form_id01")[0].value;
		var MenuLogin_Input_Pass = document.getElementsByClassName("Login_Form_id02")[0].value;
		if (MenuLogin_Input_login !== "" & MenuLogin_Input_Pass !== "" ){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				
					//document.getElementsByClassName("MenuLogin")[0].innerHTML = this.responseText;
					alert(this.responseText == "Youloginok");
				//alert(xhttp.getAllResponseHeaders());
				}
			
				 //alert(this.status);
			};
			xhttp.open("POST", "login-system/login-register.php", true); 
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("email="+MenuLogin_Input_login+"&password="+MenuLogin_Input_Pass+"&"+a+"=");
			//alert(xhttp.getAllResponseHeaders());
} else {alert('Login & Password Empety');}
	}
else  {
	
	if (a == 'register'){ 
	
	for (i=0; i < Form_id001.length; i++){
	
    if (!Form_id001[i].checkValidity())  {
        alert(Form_id001[i].validationMessage+" "+ Form_id001[i].placeholder);
		return false;
    }  
		
	
} 
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				
						alert(this.responseText);
					
				
					//document.getElementsByClassName("MenuLogin")[0].innerHTML = this.responseText;
				
				//alert(xhttp.getAllResponseHeaders());
				}
			
				 //alert(this.status);
			};
			xhttp.open("POST", "login-system/login-register.php", true); 
			xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp.send("email="+Form_id001[2].value+"&password="+Form_id001[3].value+"&firstname="+Form_id001[0].value+"&lastname="+Form_id001[1].value+"&"+a+"=");
			//alert(xhttp.getAllResponseHeaders());
	}
	
}
}	
	//Form Login-Register

    

function Login_Form_Function() {
	var Login_Form_checkbox = document.getElementById("Login_Form_checkbox");
    var Login_Form_id01 = document.getElementsByClassName("Login_Form_id01")[0];
    var Login_Form_id02 = document.getElementsByClassName("Login_Form_id02")[0];
    var Login_Form_id03 = document.getElementsByClassName("Login_Form_id03")[0];
    var Login_Form_id04 = document.getElementsByClassName("Login_Form_id04")[0];
    var Login_Form_id05 = document.getElementsByClassName("Login_Form_id05")[0];
	var MenuLogin = document.getElementsByClassName("MenuLogin")[0];
    if (Login_Form_checkbox.checked == true) {
    Login_Form_id01.placeholder = "First Name";
    Login_Form_id02.placeholder = "Last Name";
    Login_Form_id01.value = "";
    Login_Form_id02.value = "";
    Login_Form_id03.value = "";
    Login_Form_id04.value = "";
	Login_Form_id01.type = "text";
    Login_Form_id02.type = "text";
    Login_Form_id03.type = "email";
    Login_Form_id04.type = "password";
    Login_Form_id05.innerHTML = "Register";
    Login_Form_id05.attributes.getNamedItem("onclick").value = "MenuLogin_Login('register')";
	MenuLogin.style.height = "45%";
    //alert(body);
    } else {
     Login_Form_id01.placeholder = "Email Adress";
    Login_Form_id02.placeholder = "Password";
    Login_Form_id02.type = "password";
    Login_Form_id03.type = "hidden";
    Login_Form_id04.type = "hidden";
     Login_Form_id01.value = "";
    Login_Form_id02.value = "";
    Login_Form_id05.innerHTML = "Login";
    Login_Form_id05.attributes.getNamedItem("onclick").value = "MenuLogin_Login('login')";;
	MenuLogin.style.height = "35%";
    }
    
 
}

//Form Login-Register


//  Close Login Form
function Login_Form_Close(){
	window.onclick = function(event) {
			var  MenuLogin = document.getElementsByClassName("MenuLogin")[0]; 
			if (!event.target.matches(".MenuLogin_container") & !event.target.matches(".MenuLogin_container input") & !event.target.matches(".header3 i")&!event.target.matches(".Login_Form_id05")) {
				MenuLogin.style.display = "none"
				}
			}
		}
//  Close Login Form		
		