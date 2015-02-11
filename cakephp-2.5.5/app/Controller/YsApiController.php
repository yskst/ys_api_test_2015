<?php
App::uses('AppController', 'Controller');

class YsApiController extends AppController{
  public function index(){
    $this->autoRender = false;
    echo "<html><body>";
    echo "<h1>サンプル</h1>";
    echo "<p>This is a test.</p>";
    echo "</body></html>";
  }
}
?>
