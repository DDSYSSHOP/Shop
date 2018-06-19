<?php 
/* Developer: Ehtesham Mehmood Site: PHPCodify.com Script: Import Excel to MySQL using PHP and Bootstrap File: db_con.php */ 
$DB_host = "localhost"; 
$DB_user = "han64yaru2_ddsys"; 
$DB_pass = "OIPJ983ej)("; 
$DB_name = "han64yaru2_ddsys";
try { $DBcon = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
 $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 }
 catch(PDOException $e)
 {
     echo "ERROR : ".$e->getMessage();
 }
?>