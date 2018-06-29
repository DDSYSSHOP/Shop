
<?php
$q = $_REQUEST["q"];
require_once 'connection.php'; // подключаем скрипт
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка " . mysqli_connect_error($link));
		mysqli_set_charset($link, 'utf8');
$tovar =  "SELECT mx_virtuemart_product_medias.virtuemart_product_id,
mx_virtuemart_product_medias.virtuemart_media_id,
mx_virtuemart_products.product_sku,
mx_virtuemart_product_categories.virtuemart_product_id,
mx_virtuemart_medias.file_url,
mx_virtuemart_products_ru_ru.product_name, 
mx_virtuemart_products_ru_ru.product_desc,
mx_virtuemart_product_prices.product_price
FROM `mx_virtuemart_product_categories`, `mx_virtuemart_product_medias`,`mx_virtuemart_medias`,`mx_virtuemart_products_ru_ru`,`mx_virtuemart_products`,mx_virtuemart_product_prices WHERE mx_virtuemart_product_categories.virtuemart_product_id=mx_virtuemart_product_medias.virtuemart_product_id
AND mx_virtuemart_product_categories.virtuemart_product_id=mx_virtuemart_products.virtuemart_product_id
AND mx_virtuemart_medias.virtuemart_media_id=mx_virtuemart_product_medias.virtuemart_media_id
AND mx_virtuemart_product_categories.virtuemart_product_id=mx_virtuemart_product_prices.virtuemart_product_id
AND mx_virtuemart_product_categories.virtuemart_product_id=mx_virtuemart_products_ru_ru.virtuemart_product_id
AND mx_virtuemart_product_categories.virtuemart_product_id=mx_virtuemart_product_medias.virtuemart_product_id
AND mx_virtuemart_product_categories.virtuemart_category_id='".$q."' AND mx_virtuemart_product_medias.ordering=1" or die("Ошибка " . mysqli_error($link));
//$result_img = mysqli_query($link, $img) or die("Ошибка " . mysqli_error($link));
//$result_img1 = mysqli_query($link, $img1) or die("Ошибка " . mysqli_error($link));
$tovar_pr = mysqli_query($link, $tovar) or die("Ошибка " . mysqli_error($link));
//$rows = mysqli_num_rows($result);
//$rows = mysqli_num_rows($result_img1);
$rows = mysqli_num_rows($tovar_pr);
if ($rows > 0) {
     for ($i = 0 ; $i < $rows ; ++$i)
	 	 {
			 //$row = mysqli_fetch_row($result);
			//$row1 = mysqli_fetch_row($result1);
			//$row_img = mysqli_fetch_row($result_img);
			$row_tov = mysqli_fetch_row($tovar_pr);
			
			
			echo "<div class='wrapper'>";
			echo "<span class='el1'><img class='.el1' src='http://ddsys.ru/$row_tov[4]' alt='Forest' width='134' height='134' ></span>";
			echo  "<div class='wrapper1'>";
			echo "<span class='el2'><a class='el5' href='#'>Артикул: $row_tov[2]</a></span>"; 
			echo "<span class='el3'> $row_tov[5]</span>";
			echo "</div>";
			echo "<span class='el4'>$row_tov[7] &#8381</span>";
			echo "<span class='el6'><a class='el5' onclick='AddCart($row_tov[0],\"$row_tov[5]\",$row_tov[7],1)' ><i class='fa fa-cart-plus' style='font-size:30px'></i></a></span>";
			echo "</div>";
	 
				
	 }
}

?>