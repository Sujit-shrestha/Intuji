<?php



  class SessionOperations{

    public function __construct(){
      $this->startSessionOperations();
    }

   public function basicAuthentication($username , $password){
    if($username == 'admin' && $password == 'admin'){
      return true;
    }else{
      return false;
    }
   }
   protected function randomJob(){
    $p=1;
      while($p!=5){
        echo $p = rand(1,15);
        
      }
      return $p;
   }
   public function startSessionOperations(){
      switch($_SERVER['REQUEST_METHOD']){
        case 'POST':

          try{

            //if username password is sent
            if(isset($_POST["username"]) && isset($_POST["password"])){
              $username = $_POST["username"];
              $password = $_POST["password"];

              $this->basicAuthentication($username , $password);

              session_start();
              $_SESSION["username"] = $username;
              $_SESSION["password"] = $password;
              
              print_r($_SESSION);
            echo session_status();
              $result = $this->randomJob();
              $_SESSION["result"] = $result;
              $_SESSION["sessionId"] = session_id();
            

              //if username password is not sent & sessionId is present
            }else if(isset($_COOKIE["PHPSESSID"])){
              session_start();
             
              echo "session is active"."\n";
            echo $_SESSION["result"];

            }
            else{
            throw new Exception("Unable to authenticate.");
            }
          }catch(Exception $e){
            echo "Excep-tion".$e->getMessage();
          }

        break;
      }
   }
  }
  

 
  $sessionObj = new SessionOperations();




?>