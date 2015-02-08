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

</body>
</html>
