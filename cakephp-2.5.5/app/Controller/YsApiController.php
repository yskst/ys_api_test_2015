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

  private function __GetRank($query, $category_id, $sortid){
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch";
    $c = rawurlencode($category_id);
    $s = rawurlencode($sortid);
    $url = "$url?appid=$this->appid&query=$query&category_id=$c&sort=$s&hits=5";
    $xml = simplexml_load_file($url);
    return $xml; 
  }

  private $sorts = array("price" => "価格",
                        "score" => "評価",
                        "sold"  => "売れ筋",
                        "review_count" => "評価"); 
  private $orders = array("+" => "昇順",
                          "-" =>  "降順");

  private CreateSortParam($sort, $order){
    if(!array_key_exists($sort,$sorts) || 
        !array_key_exists($order,$orders)){
      throw BadRequestException;
    }
    return $order.$sort;
  }


  public function index(){
    $this->modelClass = null;
    $this->set("title_for_layout", "Test of Yahoo API");
  
    $category_id = $this->__GetCategory();
    $this->set("category_list", $category_id);

    // Get result of search.
    if(isset($this->data["query"] && isset($this->data["category"]))){
      foreach($orders as $otype => $oname){
        foreach($sorts as $stype => $sname){
          $sort_type = CreateSortParam($stype, $otype)
        }
      }
    }
  }
}
?>
