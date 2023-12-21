<?php 

class CustomerController {
  
  protected $customerId;
  protected $conn;

  public function __construct($conn){
    $this->conn = $conn;  
   
  }

  protected function handlePut(){
  try{
    $id = $_GET["Id"];

    $bodyDataPre = file_get_contents("php://input");
    $bodyData = json_decode($bodyDataPre);

    $Name = $bodyData->Name;
    $Address = $bodyData ->Address;
    $email = $bodyData ->email;

    $result = $this->conn->query
    ("UPDATE customer 
      SET Name = '$Name' ,
          Address = '$Address' ,
          email = '$email'
      where Id=$id");

    if(!$result){
      throw new Exception("Failed to query.");
      
    }else{
     http_response_code(200);
      echo "The updated Data is : ".$bodyDataPre;
    }

    }catch(Exception $e){
      http_response_code(500);
    echo "\nFailed in Update the data.".$e->getMessage()."\n";

    }
  }

  protected function handleDelete(){
    
    try{
      $id = $_GET["id"];
      $tableName = $_GET["tableName"];


      //idP_resence to check if Id rovided is present in DB 
      $idPresence = $this->conn ->query
      ("
        SELECT Id FROM $tableName where id=$id
      ");
    
      $p = mysqli_fetch_assoc($idPresence);

    if(! $p["Id"]){
      throw new Exception("Id not present.");
    }

      $result = $this->conn->query
      ("DELETE FROM $tableName 
        WHERE id = $id
      ");

      if($result == 1) {
       
        echo json_encode(array(
          "status"=> "202" ,
          "message" => "Content deleted successfully"
        ));
      }

    }catch(Exception $e){
      http_response_code(409);
      echo "Unable to delete : ".$e->getMessage();
    }finally{
      $this->conn->close();
      echo "------Database Disconnected -----";
    }
}

protected function handleGet(){
  try{
   
    $tableName = $_GET["tableName"];
    $response = array();

    $result = $this->conn -> query("
    SELECT * FROM $tableName;
    ");
    while($row = $result -> fetch_assoc()){
    //echo "\n"."Id".$row["Id"]."Name".$row["Name"]."Address".$row["Address"]."email".$row["email"]."\n";
      $response[] = $row;
    }
    echo json_encode($response  , JSON_PRETTY_PRINT);

  }catch(Exception $e){
    http_response_code(500);
    echo "".$e->getMessage();

  }finally{
    echo "\n-----Database Disconnected-----";
    $this->conn->close();
  }
}

protected function handlePost(){

  try{
    $tableName = $_GET["tableName"];
    
    $Name = $_POST["Name"];
    $Address = $_POST["Address"];
    $email = $_POST["email"];
    

    $result = $this->conn -> query("
      INSERT INTO $tableName 
      (Name , Address , email) 
      VALUES ( '$Name' , '$Address' , '$email')
    ");
    if(! $result) { 
      http_response_code(500);
      throw new Exception("Unable to Insert.");
  }else{
    echo json_encode(array("message"=>"Data Inserted Successfully"));
  }

  }catch (Exception $e){
    echo "".$e->getMessage();
  } 
}

  public function requestHandler(){

    switch( $_SERVER["REQUEST_METHOD"]){
      case "GET":
      $this->handleGet();
      break;

      case "POST":
        $this->handlePost();
        break;

      case "PUT":
        $this->handlePut();
        break;

      case "DELETE":
        $this->handleDelete();
        break;
    }
  }

}
?>