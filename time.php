<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
</style>
</head>
<body>
<?php
require_once 'connection.php'; // подключаем скрипт
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_connect_error($link)); 
		   $query1 ="SELECT `id` FROM `tovars`"; 
    $query ="SELECT * FROM tovars";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
		
	if($result)  
{
    $rows = mysqli_num_rows($result); // количество полученных строк
     echo "<div >
	 <table id='customers'><tr><th>Id</th><th>Модель</th><th>Производитель</th><th><input type='checkbox' id='checkall' > Check all</th></tr>
	 </div>";
    
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

</body>
</html>
