<?php

require_once("util.php")


/* 
 The list of get category.
 Return associative array whose key is category ID and value is category name.
 */
function get_child_category_list($category_id = 1){
	$url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/categorySearch?appid=$appid&category_id=$category_id";
	$xml = simplexml_load_file($url);
	
	$category_list = array();
	foreach $xml->Result->Categories->Current->Child as category{
		array_push($category_list, array($category->Id => $category->long);
	}
	return category_list;
}


if(isset($_POST["category_id"])){
	$category1 = $_POST["category_id"];
	$top_category = get_child_category_list();
	$category2_list = $top_category[$category1];

	echo "<select name=\"category2_id\">";
	foreach (category2_list as $id => $name){
		echo "<option value=\"$id\"> $name </option>";
	}
	echo "</select>";

}


?>
