<?php
//editing:
  namespace Day2;
   require_once "./2_seperateClass.php";

use Day2\Furniture;
use Day2\Vehicle;

$tableChair = new Furniture();
echo $tableChair ->length;

$car = new Vehicle();
echo $car -> doors;

?>
