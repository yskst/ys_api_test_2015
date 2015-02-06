<?php
require_once("util.php");
/* 
   The list of get category.
   Return associative array whose key is category ID and value is category name.
 */


function get_child_category_list($category_id = 1){
	global $appid;
	$url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/categorySearch?appid=$appid&category_id=$category_id";
	$xml = simplexml_load_file($url);

	$category_list = array();
	foreach($xml->Result->Categories->Children->Child as $category){
		array_push($category_list, $category);
	}
	return $category_list;
}
?>
