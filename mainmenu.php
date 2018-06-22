
<?php
require_once 'connection.php'; // подключаем скрипт
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_connect_error($link));
mysqli_set_charset($link, 'utf8');
$mainemenu = "SELECT * FROM `mx_menu` WHERE `mx_menu`.`level`=1 AND `published`=1 AND menutype='mainmenu'" or die("Ошибка " . mysqli_error($link));
$mainemenu1 = "SELECT `virtuemart_category_id`,title,parent_id,id,alias FROM `mx_menu` WHERE `menutype`='mainmenu' AND `mx_menu`.`level`=1" or die("Ошибка " . mysqli_error($link));
$sql= mysqli_query($link, $mainemenu) or die("Ошибка " . mysqli_error($link));
$rows = mysqli_num_rows($sql);

//echo "<div  class='menu' >";
			 echo "<ul>";
if ($rows > 0) {
     for ($i = 0 ; $i < $rows ; ++$i)
	 	 {
			 $row_mainemenu = mysqli_fetch_row($sql);
			// echo "$row_mainemenu[2]<br>";
			 
			 echo "<li><a class='tablinks' href='#$row_mainemenu[4]' onclick='openTab(event, $i,$row_mainemenu[1])'>$row_mainemenu[3]</a></li>";
		 
		 }
}
	echo "</ul>";
			//	echo "</div>";
?>

