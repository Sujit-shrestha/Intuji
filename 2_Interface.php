<?php 

namespace Day2;

require_once "./2_Seperating_Interface.php";
use Day3\TeachingProfessions;


////interface defined in next file 2_Seperating_Interface
// interface TeachingProfessions {
//   public function givingHW();
//   public function givingCW();
// }

class Teacher implements TeachingProfessions{
  public function givingCW(){
    echo "Giving project work by teachers.\n";
  }

  public function givingHW(){
    echo "Giving questionBank Completion by teachers.\n";
}
}

class Superviser implements TeachingProfessions{

  public function givingCW(){
    echo "Do Inheritance as said by superviser.\n";
  }

  public function givingHw(){
    echo "Do Research as said by superviser.\n";
  }
 

}
 function performOperations(TeachingProfessions $obj){
  $obj->givingCW();
  $obj->givingHW();
}

$seniorDai = new Superviser();
performOperations($seniorDai);

$RajanSir = new Teacher();
performOperations($RajanSir);



?>