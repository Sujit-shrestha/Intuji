<?php 
require_once "./5_userModel.php";

class UserController{
  private $userModel;
  public function __construct(UserModel $userModel)
  {
    $this->userModel = $userModel;
  }
  
  protected function getUserProfile($userId){
    $user = $this ->userModel-> findById($userId);
    echo $user["id"];
  }

  public function requestHandler(){

    switch( $_SERVER["REQUEST_METHOD"]){
      case "GET":
        $userId = $_GET["userId"];
      $this->getUserProfile($userId);
      break;

      // case "POST":
      //   $this->addUser();
      //   //$email , $password , $username , $name , $address , $user_type
      //   break;

      // case "PUT":
      //   $this->updateUserProfile();
      //   break;

      // case "DELETE":
      //   $this->deleteUserProfile();
      //   break;
    }
  }


}
?>