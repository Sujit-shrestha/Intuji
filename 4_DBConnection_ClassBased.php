<?php

class DbConnection {
  protected $Servername ;
  protected $username ;
  protected $password ;
  protected $database ;
  public $conn =null;
  
  public function __construct($hostname , $username , $password , $database){
    $this->Servername = $hostname;
    $this->username = $username;
    $this->password = $password;
    $this->database = $database;

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
}

?>