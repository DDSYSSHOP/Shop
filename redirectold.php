<?php
require_once 'db_con.php';
$productid = $_GET['productid'];
//function &getRedirectUrl($productid) {
try {
    
    $stmt = $DBcon->prepare("SELECT `virtuemart_category_id` FROM `mx_menu` WHERE `path`='$productid'"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_NUM); 
 //print_r($result);
     $row = $stmt->fetch();
 //  print $row[0] . "\t" . $row[1] . "\t" . $row[2] . "\n";
 //   print_r($row);
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

 if($result ){
	try { 
	 
	 $stmt1 = $DBcon->prepare("SELECT mx_virtuemart_product_medias.virtuemart_product_id,
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
AND mx_virtuemart_product_categories.virtuemart_category_id='".$row[0]."' AND mx_virtuemart_product_medias.ordering=1");
	 $stmt1->execute();
	 $result1 = $stmt1->setFetchMode(PDO::FETCH_NUM); 
//print_r($row[0]);
//$result2 = $stmt1->fetchAll();
//print_r($result2);
   $row1 = $stmt1->fetch();
//print_r($row1[0]);
echo $row1[0];
 $stmt->close();
 $stmt1->close();
 $DBcon->close();
 }
 
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
 }
//$url = 'http://test.ddsys.ru/'. $row[0];
//return $ret;
//}




//$url =&  getRedirectUrl();

//header('HTTP/1.1 301 Moved Permanently');
//header('Location: $url');


?>