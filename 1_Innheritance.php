<?php

     class Animal {
          public $name;
          public $age;
          private $AnimalId;

          public function printName(){
               echo $this->name;
          }
          
     }

     class Dog extends Animal{

          public function __construct($name){
               try{
                    $this->name = $name;
               }catch(Error $e){
                    return "Error in construction".$e ->getMessage();
               } 
          }
         
          

          public function bark(){
               echo "\nfrom inside bark function:\t".$this->name;
               print_r("\nthe dog is barking : bhow");

               
          }

          //function overriding inside child class
          public function printName(){
               echo "The name printed by child ".$this->name;
          }

     }

     $a = new Dog("kaleVai");
     // $a->name = "puppy ";
      $a->printName();
     // $a->bark();

     

?>