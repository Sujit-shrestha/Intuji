<?php

class A{
  private $pri="private";
  protected $pro = "protected";

  protected function displayer(){
    echo "displayer function";
  // echo  $this->priFun();
  }
  protected function proFun(){
    echo "protected function";
  }
  private function priFun(){
    echo " Private function";
  }
}
// $obj =  new A();
// echo $obj->displayer();

class B extends A{
  public function Childdisplayer(){
    $this->priChildFun();
  }
  private function priChildFun(){
    $this->proFun();
  }
}

$childObj = new B;
$childObj->Childdisplayer();

?>