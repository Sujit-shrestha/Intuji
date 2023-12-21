<?php
interface Vehicle {
  public function showWheels();

}


interface VehicleRegistrar{
  public function showId();

} 

class Car implements Vehicle , VehicleRegistrar{
  private $wheels;
  private $vehicleId;

  //constructor
  public function __construct($wheel , $vehicleId){
    $this->wheels = $wheel;
    $this->vehicleId = $vehicleId;
  }

  //methods
  public function showId() {
    echo $this->vehicleId;
  }
  public function showWheels(){
    echo $this ->wheels;
  }

}

$AE86 = new Car("4","Ba 1222");

$AE86->showId();
echo "\n";
$AE86 ->showWheels();
?>