<h1>Product search</h1>
<?php
echo $this->Form->create(false, array('type'=>'post', 'action'=>'.'));
echo $this->Form->label('query', "クエリ");
echo $this->Form->text('query');
echo $this->Form->label('category', "カテゴリ");
echo $this->Form->select('category', $category_list, array('empty'=>array_slice($category_list, 1, 1, true)));
echo $this->Form->label('sort', "並び順");
echo $this->Form->select('sort', $sort_list, array('empty'=>array_slice($sort_list, 1, 1, true)));
echo $this->form->end("検索");
?>

<h1>検索結果</h1>
<?php 
if(isset($results)){
  $table_header = $this->Html->tableHeaders(array());
  $cell_data = array();
  foreach($results as $res){ 
    $fig = $this->Html->link(
      $this->Html->image($res["Image"]["Small"],array('fullBase'=>true)),
      $res["Url"], array('escape'=>false));
    $product_name =  $this->Html->link($res["Name"]."<br>",
      $res["Url"], array('escape'=>false));
    $store_name = $res["Store"]["Name"];
    $price = "&yen".$res["Price"]["@"];
  
    $cell_data[] = array($fig, $product_name . $store_name, $price);
  }
  $cell_array = $this->Html->tableCells($cell_data);
  echo $this->Html->tag('table', $table_header.$cell_array);
}
?>

