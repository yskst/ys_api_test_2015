<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="yskst">
<title>Test page</title>
</head>
<body>
<h1>The test of yahoo API.</h1>

<form action=<?php echo $_SERVER['PHP_SELF']?> method="post">
<?php

echo "<input type=\"text\" value=$query name=\"query\"><br>"

require_once('./category_selector.php');
$top_category = get_child_category_list();

echo '<select name="category_id">';
foreach ($top_category as $category){
  if ($category_id == $category->Id) $s="selected";
  else $s = "";
  echo "<option value=\"$category->Id\" $selected>". $category->Title->Short ."</option>";
}
echo "</select>";
?>
<input type="submit" value="検索">
</form>

</body>
</html>
