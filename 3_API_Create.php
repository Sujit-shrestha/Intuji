<?php 
 
require_once "./3_API_CRUD_Function.php";


switch($_SERVER["REQUEST_METHOD"]){

  //Read by Get method part
  case "GET":

    $conn= DbConnection();
    
    try{
      if($_GET["table"]){
        $tableName = $_GET["table"];
        $query = "Select * from $tableName;";
        // $result = mysqli_query($conn, $query);
        $result = $conn->query($query);

        // return [
          
        //   ]
        
        if($result ){
          while( $row = mysqli_fetch_assoc($result)){
          echo "\n".$row["Id"]." ".$row["Name"]." ".$row["Address"]." ".$row["email"]."\n";
          }
        }
      }
    }catch(Error $e){ 
      echo "Error after database connection".$e->getMessage();
    }finally{
      mysqli_close($conn);
      echo "\n======Database Disconnected======\n";
    }

    break;

    //Insert into table by post method part

    case "POST":
     
      $conn = DbConnection();

      $tableName = $_GET["table"];
     

      $bodyData = file_get_contents("php://input");
      $bodyData = json_decode($bodyData);
      
      $name = $bodyData->Name;
      $address = $bodyData->Address;
      $email = $bodyData->email;

      $query = "INSERT INTO customer 
      (Name ,Address , email) 
      VALUES ('$name' , '$address' , '$email')
      ";

      try{
        // $result = mysqli_query($conn, $query);
        $r = $conn->query($query);

        if($r){
          echo "\nData inserted successfully.\n";
        }else{
          echo "\nInsertion Failed ".mysqli_error($conn);
        }
      }
      catch(Error $e){
        echo "Error while inserting ".$e->getMessage();
      }

      mysqli_close($conn);
      echo "\n======Database Disconnected======\n";

    break;
      

      
     




}

?>