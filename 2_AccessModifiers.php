<?php 
namespace Day2;
  class FirstClass{
    public $Rich = "Ram";
    protected $UltraRich = "Elon Musk";
    private $Trader="Jyotish_Baba";

    public function whoIsRich(){
      print_r("Rich are the ones with 10 Million\n");
    }
    protected function whoIsUltraRich(){
      print_r("Ultra Rich are people with 100 Million\n");
    }
    private function whoIsTrader(){
      print_r("Trader are ones who bought BTC at $1\n");

    }
  }

  // $top1Percent = new FirstClass();

  // echo $top1Percent->Rich;
  // echo $top1Percent->UltraRich;
  // echo $top1Percent->Trader;

  // $top1Percent->whoIsRich();
  // $top1Percent->whoIsUltraRich();
  // $top1Percent->whoIsTrader();  

class SecondClass extends FirstClass{
  public $helloworld;

  public function Displayer(){
    print_r($this->Trader);
  }


}

$top10percenter = new SecondClass();

// $top10percenter ->whoisRich();
// $top10percenter ->whoIsUltraRich();
// $top10percenter ->whoIsTrader();

//  echo $top10percenter->Rich;
// echo $top10percenter->UltraRich;
// echo $top10percenter->Trader;

$top10percenter->Displayer();


?>