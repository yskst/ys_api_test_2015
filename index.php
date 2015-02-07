<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="yskst">
<title>Test page</title>
</head>
<body>
<h1>The test of yahoo API.</h1>

<input type="text" name="query"><br>

<?php
require_once('./category_selector.php');
$top_category = get_child_category_list();

echo '<select name="category_id">';
foreach ($top_category as $category){
  echo "<option value=\"$category->Id\">". $category->Title->Short ."</option>";
}
echo "</select>";

?>

</body>
</html>
