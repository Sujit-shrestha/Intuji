<?php 
namespace Day2;

trait GoingFront {
  public function firstStep(){
    echo "First Step\n";
  }
  public function lastStep(){
    echo "Last Step\n";
  }

}
class Success {
  
  use GoingFront;
  public $TotalSteps;  

}

$me = new Success();
$me -> firstStep();
$me -> lastStep();


?>