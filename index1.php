<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>


@media only screen 
	and (min-device-width: 375px) 
	and (max-device-width: 667px) 
	and (-webkit-min-device-pixel-ratio: 2) {
    body {
        background-color: red;
    }
}

div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}


input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #ddd;}

#customers tr:hover {background-color: #fff;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}


</style>
</head>
<body>
<?php
require_once 'connection.php'; // подключаем скрипт
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_connect_error($link)); 

   if(isset($_POST['name']) && isset($_POST['company']) && !empty($_POST['id'])){

	
    $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    $company = htmlentities(mysqli_real_escape_string($link, $_POST['company']));
	
if (isset($_POST)){
    foreach ($_POST as $tovar => $items)
       foreach ($items as $key => $value);
		

    $query ="UPDATE tovars SET name='$name', company='$company' WHERE id='$value'";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysql_error($link)); 
	
   
    if($result)
		echo "<span style='color:blue;'>Данные обновлены</span> ";
	
   } 
   }
 else echo "";
   if(!empty($_POST['name']) && isset($_POST['company']) && !empty($_POST['create']) == 'СОздать'){

	
    $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
    $name = htmlentities(mysqli_real_escape_string($link, $_POST['name']));
    $company = htmlentities(mysqli_real_escape_string($link, $_POST['company']));
	



    $query ="INSERT INTO tovars VALUES(NULL, '$name','$company')";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysql_error($link)); 
		
   
    if ($result) {
        echo "<p>Данные успешно добавлены в таблицу.</p>";
    } 

} 
	 else echo "";	
	 
	  if(!empty($_POST['id']) && !empty($_POST['del']) == 'Удалить'){

	
    $id = htmlentities(mysqli_real_escape_string($link, $_POST['id']));
    
	
if (isset($_POST)){
    foreach ($_POST as $tovar => $items)
       foreach ($items as $key => $value);
		
//for ($i = 0; $i < 1; $i++) 
  
    for ($j=0; $j < count($items); $j++) 
    {
     //  echo  ".$items[$j],"; 
    
   // echo '<br />'; 
		$query ="DELETE FROM tovars WHERE id = '$items[$j]'";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysql_error($link)); 
		//print_r($_POST]);
		
	
    }
	    
}
 
		
   
   if($result)
	echo "<span style='color:blue;'>Сктрока  удалена </span> ";
	
} 

 else echo "";
		
    $query1 ="SELECT `id` FROM `tovars`"; 
    $query ="SELECT * FROM tovars";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
		
	if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
      echo "<div ><form name='Form' method='POST' >
	 <table id='customers'><tr><th>Id</th><th>Модель</th><th>Производитель</th><th><input type='checkbox' id='checkall' > Check all</th></tr>
	 <p>Введите модель:<br> 
            <input type='text' name='name' value= $name  /></p>
            <p>Производитель: <br> 
            <input type='text' name='company' value=$company /></p>
	 <input type='submit' value='Добавить' ><p>
	 <input type='submit' name='create' value='СОздать' > <p>
	  <input type='submit' name='del' value='Удалить' >
	  
	 </form></div>";
    
	for ($i = 0 ; $i < $rows ; ++$i)
	
		
    {
        $row = mysqli_fetch_row($result);
		$row1 = mysqli_fetch_row($result1);
		
        echo "<tr>";
            for ($j = 0 ; $j < 3 ; ++$j) echo "<td>$row[$j]</td>";
			echo "<td><input type='checkbox' class='thing' name='id[]' value=$row1[0]><Br></td>";
        echo "</tr>";
    }
	
    echo "</table>";
	
       
}



/*echo "<h2>Изменить модель</h2>
            <form method='POST'>
            <input type='hidden' name='id' value='$id' />
            <p>Введите модель:<br> 
            <input type='text' name='name' value='$name' /></p>
            <p>Производитель: <br> 
            <input type='text' name='company' value='$company' /></p>
            <input type='submit' value='Сохранить'>
            </form>";*/
		
			//echo $idval;
			

	

			
 
    
    mysqli_free_result($result);
mysqli_close($link);  
//print_r($_POST)
?>
 
<script>
var checkboxes = document.querySelectorAll('input.thing'),
    checkall = document.getElementById('checkall');

for(var i=0; i<checkboxes.length; i++) {
    checkboxes[i].onclick = function() {
        var checkedCount = document.querySelectorAll('input.thing:checked').length;
        
        checkall.checked = checkedCount > 0;
        checkall.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
    }
}

checkall.onclick = function() {
    for(var i=0; i<checkboxes.length; i++) {
        checkboxes[i].checked = this.checked;
    }
}
</script>

<script>
var f = document.forms.Form;
f.onchange = function() {
  var n = f.querySelectorAll('[type="checkbox"]'),
      l = f.querySelectorAll('[type="checkbox"]:checked');
  for(var j=0; j<n.length; j++)
    if (l.length >= 1) { // если отметить три и более галочки
      n[j].disabled = true; // все чекбоксы становятся disabled
      for(var i=0; i<l.length; i++)
        l[i].disabled = false; // но disabled убирается с помеченных галочками чекбоксов
    } else {
      n[j].disabled = false; // если выделить менее трёх галочек, то disabled снимается со всех чекбоксов
    }
}
</script>

<!--<script>  
        function show()  
        {  
            $.ajax({  
                url: "time.php",  
                cache: false,  
                success: function(html){  
                    $("#customers").html(html);  
                }  
            });  
        }  
      
        $(document).ready(function(){  
            show();  
            setInterval('show()',20000);  
        });  
    </script>  -->

<!--<h2>Изменить модель</h2>
            <form method='POST'>
            <input type='text' name='id' value='$id' />
            <p>Введите модель:<br> 
            <input type='text' name='name' value='$name' /></p>
            <p>Производитель: <br> 
            <input type='text' name='company' value='$company' /></p>
            <input type='submit' value='Сохранить'>
            </form>-->
			
			
</body>
</html>