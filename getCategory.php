<?php

require_once("util.php")


/* 
 The list of get category.
 Return associative array whose key is category ID and value is category name.
 */
function get_ChildCategoryList($category_id = 1){
	$url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/categorySearch?appid=$appid&category_id=$category_id"
	$xml = simplexml_load_file($url)
	
	$category_list = array()
	foreach $xml->Result->Categories->Current->Child as category{
		array_push($category_list, array($category->Id => $category->long)
	}
	return category_list
}





?>
