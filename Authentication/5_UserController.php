<?php
require_once "./5_userModel.php";
require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\key;

class UserController
{
  private $userModel;
  private $secret = "password_key_intuji";
  public function __construct(UserModel $userModel)
  {
    $this->userModel = $userModel;
  }

  protected function UserValidator($username, $password)
  {

    if (empty($username) || empty($password)) {
      echo json_encode(array("message" => "Empty or Invalid username or password"));
    } else {
      $result = $this->userModel->authenticateUser($username, $password);
      if ($result) {
        $authToken = $this->JWTcreator($username, $password);

        setcookie("authToken", $authToken, time() + 10, "/");
        return true;
      }

    }
    return false;
  }
  protected function JWTcreator($username, $password)
  {
    $secret = "password_key_intuji";
    $payload = array(
      "username" => $username,
      "password" => $password,
      "exp" => time() + (3600)
    );
    $token = JWT::encode($payload, $secret, 'HS256');

    return $token;

  }
  protected function JWTverify()
  {
    $secret = $this->secret;
    $tokenToVerify = $_COOKIE["authToken"];


    if (!empty($tokenToVerify)) {
      $result = JWT::decode($tokenToVerify, new key($secret, 'HS256'));
      echo "username decoded : " . $result->username . $result->password;
      //check if present in database
      return $this ->UserValidator($result->username , $result->password);
      
    } else {
      return false;
    }
  }

  protected function getUserProfile($userId)
  {
    try {



      $user = $this->userModel->findById($userId);

      echo json_encode($user, JSON_PRETTY_PRINT);

    } catch (Exception $e) {
      echo "" . $e->getMessage();
    }

  }

  protected function addUser($data)
  {
    try {
      //Password Hashing
      $data = json_decode($data, true);
      $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);
      $data = json_encode($data, true);



      $user = $this->userModel->createUser($data);

      if (!$user) {
        echo json_encode(array("error" => "Error during insertion."));
      } else {
        echo json_encode(array(
          "user" => $user,
          "MESSAGE" => "User Created successfulyy."
        ), JSON_PRETTY_PRINT);
      }
    } catch (Exception $e) {
      echo json_encode(array("error" => $e->getMessage()));
    }


  }
  protected function updateUserProfile($data)
  {
    try {
      //getting data from request
      $id = $_GET["id"];
      $data = json_decode($data, true);
      $authToken = $_COOKIE["authToken"];

      //check if authToken is present
      if ($authToken) {
        $tokenStatus = $this->JWTverify();
        if ($tokenStatus) {
          echo "User verified using authToken";
        } else {
          return 1;
        }
      }
      //if passwrod and username is present 
      elseif (isset($data["password"]) && isset($data["username"])) {

        $authenticationStatus = $this->UserValidator($data["username"], $data["password"]);

        if (!$authenticationStatus) {
          throw new Exception("Cannot obtain autenticatin token.");
        }
      }

      if ($data["password"]) {
        $data["password"] = password_hash($data["password"], PASSWORD_BCRYPT);
      } else {
        throw new Exception("Password cannot be empty.");
      }

      $data = json_encode($data, true);

      $updateStatus = $this->userModel->updateUser($id, $data);

      if ($updateStatus) {
        echo json_encode(array("success" => "Data Updated successfully"));
      } else {
        throw new Exception("Error while updating.");
      }
    } catch (Exception $e) {
      echo json_encode(array("error" => $e->getMessage()));
    }

  }

  public function handleLogin($username, $password)
  {
    try {
      $authToken = $_COOKIE["authToken"];



      if ($this->UserValidator($username, $password)) {
        echo json_encode(array("success" => "Login Successful"));
      } elseif ($authToken) {
        $this->JWTverify();
      }

    } catch (Exception $e) {
      echo json_encode(array("error" => $e->getMessage()));
    }
  }

  public function requestHandler()
  {

    switch ($_SERVER["REQUEST_METHOD"]) {
      case "GET":
        $userId = $_GET["userId"];
        $this->getUserProfile($userId);
        break;

      case "POST":

        if (isset($_POST["login"]) && $_POST["login"] == "true") {
          $this->handleLogin($_POST["username"], $_POST["password"]);


        } else {
          $data = file_get_contents("php://input");
          $this->addUser($data);
        }
        break;



      case "PUT":
        $data = file_get_contents("php://input");
        $this->updateUserProfile($data);
        break;

      // case "DELETE":
      //   $this->deleteUserProfile();
      //   break;
    }


    // $this ->userModel ->mysqli->close();
    // echo "----Databse disconnecterd";
  }


}
?>