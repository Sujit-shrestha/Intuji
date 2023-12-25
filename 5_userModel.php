<?php 

  class UserModel {
    private $mysqli;

    public function __construct(\mysqli $mysqli){
      $this->mysqli = $mysqli;
    }

   public function authenticateUser($username, $password){
    try{
     
      $query = "SELECT id , username , password from User 
      WHERE username = '$username'";

      $result = $this->mysqli->query($query);
      if(!$result){
        throw new Exception("Error executing query.");
      }

       $DBresponse = $result->fetch_assoc();

       if(password_verify($password , $DBresponse["password"])){
          return true;
      }else{
        throw new Exception("Password/Username did not match.");
        
      }

    }catch(Exception $e){
      echo "Exception encountered ".$e->getMessage();
    }
  }

    public function findById($id){
      try{
        //id not sent in req 
        if(!$id){
          throw new InvalidArgumentException("Invalid or missing Id.");
        }

        $query = "SELECT * FROM User where id = $id";

        $result = $this->mysqli->query($query);
      
         echo $response=  $result->fetch_assoc();
          return $response;

      }catch (Exception $e){
        echo "\nException captured in UserModel/findById: ".$e->getMessage();
      }
    }

    public function createUser($data){
      try{
        
        if(!$data){
          throw new InvalidArgumentException("No data sent to insert");
        }
      $data = json_decode($data,true);
        
        $email = $data["email"];
        $password = $data["password"];
        $username = $data["username"];
        $name= $data["name"];
        $address = $data["address"];
        $user_type = $data["user_type"];
        echo $data;

        $query = "
        INSERT INTO User 
        (email , password , username , name, address, user_type) 
        VALUES ('$email','$password','$username','$name','$address' , '$user_type')
        ";

        $result = $this->mysqli ->query($query);
        return $result;
      
      }catch (Exception $e){
        echo "Exception caught in creating user: ".$e->getMessage()."\n";
      }
    }

    public function updateUser($id , $data){
      try{
        if(!($id ) || !($data )){
          throw new InvalidArgumentException("User Id or Required data not available");
        }
        

        $data = json_decode($data,true);
        $email = $data["email"];
        $password = $data["password"];
        $username = $data["username"];
        $name = $data["name"];
        $address = $data["address"];
        $user_type = $data["user_type"];

        $query = "
        UPDATE User 
        set email = '$email' , 
            password = '$password',
            username = '$username',
            name = '$name' , 
            address = '$address',
            user_type = '$user_type'
        WHERE id = '$id'
            ";
            $result = $this->mysqli -> query($query);
            return $result;
      }catch (Exception $e){
        echo json_decode(array("error" => $e->getMessage()));
      }
    }


  }
?>