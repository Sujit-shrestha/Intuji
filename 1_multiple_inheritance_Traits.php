<?php
namespace TraitInheritance ;
trait Vehicle {
  public function start(){
    echo "Vechicle is starting \n";
  }

  public function stop (){
    echo "Vehicle is stopping \n";
  }
}

trait VehicleRegistrar {
  public function register(){
    echo "Vehicle is registered successfully";
  }

  public function showId(){
    echo $this->RegistryId;
  }
}

class Car{
  use Vehicle , VehicleRegistrar;

  private $wheels;
  private $doors;
  private $RegistryId;
  
  public function __construct($wheels , $doors,  $id){
    $this->wheels = $wheels;
    $this -> doors = $doors; 
    $this -> RegistryId = $id;
  }

}

$Car = new Car("4" , "Two doors" , "Ba 1222");

$Car -> showId();

?>