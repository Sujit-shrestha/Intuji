<?php 

function DbConnection(){

  $servername = 'localhost:3000';
  $database= "api_database";
  $username = "root";
   $password = "";
  
    try{
      $conn =  mysqli_connect($servername, $username, $password, $database);
      if(!$conn){
        echo "Failed to connect to database";
        die("Failed to Connect". mysqli_error($conn));
        
      }else{
        echo "\n------Database Connected------\n";
        return $conn;
      }
    }catch(Exception $e){
      echo "Exception encountered : ". $e->getMessage();
    }
  }

?>