<?php

class DbConnection {
  protected $Servername = 'localhost:3000' ;
  protected $username = 'root';
  protected $password  = "";
  protected $database  = 'api_database';
  public $conn =null;
  //"localhost:3000" , "root" , "" , "api_database"
  public function __construct(){
    //connect to database
   $this->connection();
  }
 
  protected function connection (){

    try{
      $this->conn = mysqli_connect($this->Servername, $this->username, $this->password , $this->database);
      if($this->conn){
        echo "\n-----Connected successfullyY-----\n";
        return $this->conn;
      }else {
      die("Failed to connect " . mysqli_connect_error());
      }
    }catch(Exception $e){
      echo "\n".$e->getMessage();
    }
  }

  protected function disconnection(){
    try {
      $this->conn = mysqli_close($this->conn);
    }catch(Exception $e){
        echo "Failed to disconnect.".$e->getMessage();
    }
  }

  public function mysqliConnection(){
    return $this->conn;
  }
}

?>