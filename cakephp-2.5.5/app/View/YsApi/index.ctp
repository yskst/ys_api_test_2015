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
  foreach($results as $res){ 
    echo "<p>";
    echo $this->Html->link(
      $this->Html->image($res["Image"]["Small"],array('fullBase'=>true)),
      $res["Url"], array('escape'=>false));
    echo $this->Html->link($res["Name"]."<br>".$res["Store"]["Name"],
                               $res["Url"], array('escape'=>false));
    echo "</p>";
  }
}
?>

