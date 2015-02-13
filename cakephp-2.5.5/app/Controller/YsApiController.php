<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('Xml', 'Utility');

class YsApiController extends AppController{
  private $appid="dj0zaiZpPU1NOEE5dG9VcjBFSSZzPWNvbnN1bWVyc2VjcmV0Jng9NmE-";

  private function __GetCategory($category_id=1){

    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/categorySearch?appid=$this->appid&category_id=$category_id";
    $xml = simplexml_load_file($url);
    $category_list = array(1 => "すべてのカテゴリ");
    foreach($xml->Result->Categories->Children->Child as $category){
      $category_list += array((int)$category->Id =>$category->Title->Short);
    }
    return $category_list;
  }

   private function __GetSortArray(){
     $sorts = array("price" => "価格",
                    "score" => "評価",
                    "sold"  => "売れ筋",
                    "review_count" => "評価"); 
     $orders = array("+" => "昇順",
                     "-" =>  "降順");
     $a = array();
     foreach($orders as $oid=>$oname){
       foreach($sorts as $sid=>$sname){
         $a += array($oid.$sid => $sname.$oname);
        }
     }
     return $a;
   }

  private function search($query, $category, $sort_word){
    $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch";
    $c = rawurlencode($category);
    $s = rawurlencode($sort_word);

    $url = "$url?appid=$this->appid&query=$query&category_id=$c&sort=$s&hits=5";
    $xml = Xml::toArray(Xml::build($url));
    $xml = $xml["ResultSet"];
    if($xml["@totalResultsReturned"] == 0) throw BadRequestException;
    return $xml;
  }


  public function index(){
    // Relate with search window.
    $this->modelClass = null;
    $this->set("title_for_layout", "Test of Yahoo API");

    $category_id = $this->__GetCategory();
    $this->set("category_list", $category_id);

    $sort_list=$this->__GetSortArray();
    $this->set("sort_list", $sort_list);

    // Searching.
    if(isset($this->data["query"])){
      $res = $this->search($this->data["query"], 
        $this->data["category"], $this->data["sort"]);
      $this->set("results", $res["Result"]["Hit"]);   
    }
  }
}
?>

