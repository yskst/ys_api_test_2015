<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="yskst">
<title>Test page</title>
</head>
<body>
<h1>The test of yahoo API.</h1>

<form action=<?php echo $_SERVER['PHP_SELF']?> method="get">
<?php

echo "<input type=\"text\" value=\"". $_GET["query"] ."\"name=\"query\"><br>\n";

require_once('./category_selector.php');
$top_category = get_child_category_list();

echo '<select name="category_id">';

if(isset($_GET["category_id"])) $s = "selected";
else $s="";
echo '<option value=1>すべてのカテゴリ</option>';
foreach ($top_category as $category){
  if ($_GET["category_id"] == intval($category->Id)) $s="selected";
  else $s = "";
  echo "<option value=\"$category->Id\" $s>". $category->Title->Short ."</option>\n";
}
echo "</select>";
?>
<input type="submit" value="検索">
</form>

<H1>検索結果</H1>
<?php
require_once("util.php");
function sort2name($sort_type){
  if($sort_type == "price") return "価格";
  else if($sort_type == "score") return "評価";
  else if($sort_type == "sold" ) return "売れ筋";
  else if($sort_type == "review_count") return "評価";
  else return "その他";
}

function order2name($order_type){
  if($order_type == "+") return "昇順";
  else return "降順";
}

function search_item($query, $category_id, $sort){
  global $appid;
  $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch";
  $c   = rawurlencode($category_id);
  $s   = rawurlencode($sort);
  
  $url = "$url?appid=$appid&query=$query&category_id=$c&sort=$s&hits=5";
  $xml = simplexml_load_file($url);
  return $xml; 
}

function show_search_result($xml){
  if($xml["totalResultsReturned"] == 0) return;
  
  $res = $xml->Result->Hit;
  foreach($res as $hit){
    echo '<div class="Item">';
    echo '<h3><a href="' .h($hit->Url). '">' .h($hit->Name). ',' .h($hit->Price). '円</a></h3>';
    echo '</div>';
  }
}

if(isset($_GET["query"])){
  $query = $_GET["query"];
  $category =$_GET["category_id"];
  $orders = array("+", "-");
  $sorts  = array("price", "score", "sold", "review_count");

  foreach($sorts as $s){
    foreach($orders as $o){
      echo "<H2>". sort2name($s) . order2name($o) . "</H2>\n";
      $res = search_item($query, $category, $o.$s);
      show_search_result($res);
    }
  }

}
?>

</body>
</html>
