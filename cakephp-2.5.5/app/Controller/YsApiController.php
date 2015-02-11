<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class YsApiController extends AppController{
  private $appid="dj0zaiZpPU1NOEE5dG9VcjBFSSZzPWNvbnN1bWVyc2VjcmV0Jng9NmE-";

  private function __GetCategory($category_id=1){

    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/categorySearch?appid=$this->appid&category_id=$category_id";
    $xml = simplexml_load_file($url);
    $category_list = array();
    foreach($xml->Result->Categories->Children->Child as $category){
      $category_list += array((int)$category->Id => $category->Title->Short);
    }
    return $category_list;
  }

  public function index(){
    $this->modelClass = null;
    $this->set("title_for_layout", "Test of Yahoo API");
  
    $category_id = $this->__GetCategory();
    $this->set("category_list", $category_id);
  }
}
?>
