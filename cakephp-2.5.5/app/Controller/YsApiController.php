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
      $category_list += array((int)$category->Id =>$category->Title->Short);
    }
    return $category_list;
  }

  private function __GetRank($sortid){
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch";
    $c = rawurlencode($category_id);
    $s = rawurlencode($sortid);
    $url = "$url?appid=$this->appid&query=$query&category_id=$c&sort=$s&hits=5";
    $xml = simplexml_load_file($url);
    return $xml; 
  }

  private function sort2name($sotr_type){
    if($sort_type == "price") return "価格";
    else if($sort_type == "score") return "評価";
    else if($sort_type == "sold" ) return "売れ筋";
    else if($sort_type == "review_count") return "評価";
    else return "その他";
  }

  private function order2name($order_type){
    if($order_type == "+") return "昇順";
    else return "降順";
  }

  public function index(){
    $this->modelClass = null;
    $this->set("title_for_layout", "Test of Yahoo API");
  
    $category_id = $this->__GetCategory();
    $this->set("category_list", $category_id);

    // Get result of search.
  }
}
?>
