<h1>Product search</h1>
<?php
echo $this->Form->create(false, array('type'=>'post', 'action'=>'.'));
echo $this->Form->label('query', "クエリ");
echo $this->Form->text('query');
echo $this->Form->label('category', "カテゴリ");
echo $this->Form->select('category', $category_list);
echo $this->form->end("検索");
?>
