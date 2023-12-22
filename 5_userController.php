<?php 
require_once "./5_userModel.php";

class UserController{
  private $userModel;
  public function __construct(UserModel $userModel)
  {
    $this->userModel = $userModel;
  }
 
  
  protected function getUserProfile($userId){
    try{
      $user = $this ->userModel-> findById($userId);

      echo json_encode($user , JSON_PRETTY_PRINT);

    }catch(Exception $e){
      echo"". $e->getMessage();
    }
   
  }

  protected function addUser($data){
    try{
      //Password Hashing
    $data = json_decode($data,true);
    $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);
    $data = json_encode($data, true);  



      $user = $this ->userModel->createUser($data);

      if(!$user){
    echo json_encode(array("error"=> "Error during insertion."));
      }else{
        echo json_encode(array(
          "user" => $user , 
          "MESSAGE" => "User Created successfulyy."
      ), JSON_PRETTY_PRINT);
      }
    }catch(Exception $e){
      echo json_encode(array("error"=> $e->getMessage()));
    }
     

  }
  protected function updateUserProfile($data){
    try{
      $id = $_GET["id"];

      //p-assword hashing
      $data = json_decode($data,true);
      $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);
      $data = json_encode($data, true); 

      $updateStatus = $this ->userModel ->updateUser($id , $data);
      
      if($updateStatus){  
        echo json_encode(array("success"=> "Data Updated successfully"));
      }else{
        throw new Exception("Error while updating.");
      }
    }catch(Exception $e){
      echo json_encode(array("error"=> $e->getMessage()));
    }

  }

  public function requestHandler(){

    switch( $_SERVER["REQUEST_METHOD"]){
      case "GET":
        $userId = $_GET["userId"];
      $this->getUserProfile($userId);
      break;

      case "POST":
        $data = file_get_contents("php://input");
       
        $this->addUser($data);
        
        break;

      case "PUT":
        $data = file_get_contents("php://input");
        $this->updateUserProfile($data);
        break;

      // case "DELETE":
      //   $this->deleteUserProfile();
      //   break;
    }
  }


}
?>