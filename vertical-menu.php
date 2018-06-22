<?php
$q = $_REQUEST["q"];

require_once 'connection.php'; // подключаем скрипт
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка подключения" . mysqli_connect_error($link)); 
mysqli_set_charset($link, 'utf8');
$vertical_menu = "SELECT `virtuemart_category_id`,title,parent_id,id,alias FROM `mx_menu` WHERE menutype='mainmenu' AND (`level`=2 OR `level`=3) AND parent_id='".$q."'" or die("Ошибка запроса строки " . mysqli_error($link));

$sql= mysqli_query($link, $vertical_menu) or die("Ошибка запроса " . mysqli_error($link));
$rows = mysqli_num_rows($sql);

if (235 == $_REQUEST["q"]) {
  


 // if ($rows > 0) {
   //  for ($i = 0 ; $i < $rows ; ++$i)
	 //	 {
			
	 while($row_vertical_menu = mysqli_fetch_row($sql)){
	 //$row_vertical_menu[3]
	 //print_r $row_vertical_menu;
	 echo "<strong> $row_vertical_menu[1] </strong>";
      $a =  $row_vertical_menu[3];
	$vertical_menu1 = "SELECT  `virtuemart_category_id`,`id`,`title`,`alias`,`path`,`link`,`parent_id`, `level`,`menutype` FROM `mx_menu` WHERE `published`=1  AND menutype='mainmenu' AND (`level`=2 OR `level`=3) AND `parent_id`='$a'" or die("Ошибка запроса строки " . mysqli_error($link));
	//$vertical_menu1 = "SELECT `virtuemart_category_id`,title,parent_id,id,alias FROM `mx_menu` WHERE `menutype`='mainmenu' AND parent_id='$a'" or die("Ошибка запроса строки " . mysqli_error($link));
	$sql1= mysqli_query($link, $vertical_menu1) or die("Ошибка запроса " . mysqli_error($link));
	$rows1 = mysqli_num_rows($sql1);

   //  for ($z = 0 ; $z < $rows1 ; ++$z)
	 //	 {
	 while($row_vertical_menu1 = mysqli_fetch_row($sql1)){ 
	 echo "<a href='#$row_vertical_menu1[4]' onclick='openMenu(event,  $row_vertical_menu1[0])'>$row_vertical_menu1[2]</a>";
		//echo $row_vertical_menu[3];
		 }
		 }
//  }
return; 

}
else{

if ($rows > 0) {
    // for ($i = 0 ; $i < $rows ; ++$i)
	 	// {
			while ($row_vertical_menu = mysqli_fetch_row($sql)){
			// echo "$row_mainemenu[2]<br>";
			 
			 echo "<a  href='#$row_vertical_menu[4]' onclick='openMenu(event, $row_vertical_menu[0])'>$row_vertical_menu[1]</a>";
		 
		 }
}

}
?>