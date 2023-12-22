<?php 

  class UserModel {
    private $mysqli;

    public function __construct(\mysqli $mysqli){
      $this->mysqli = $mysqli;
    }

    public function findById($id){
      try{
        //id not sent in req 
        if(!$id){
          throw new InvalidArgumentException("Invalid or missing Id.");
        }

        $query = "SELECT * FROM User where id = $id";

        $result = $this->mysqli->query($query);
      
          $response=  $result->fetch_assoc();
          return $response;

      }catch (Exception $e){
        echo "\nException captured: ".$e->getMessage();
      }
     
   


  }
  }
?>