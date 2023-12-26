<?php



  class SessionOperations{

    //constructor initializes the API for inducing endpoints
    public function __construct(){
      $this->startSessionOperations();
    }

    //function for basic authentication
   private function basicAuthentication($username , $password){
    if($username == 'admin' && $password == 'admin'){
      return true;
    }else{
      return false;
    }
   }
   //function to perfromn a random task
   private function randomJob(){
    $p=1;
      while($p!=5){
        echo "Echo from randomJob function: ". $p = rand(1,15)."\n";
        
      }
      return $p;
   }
   private function logout(){
    setcookie(session_name(),"", time()-60,"/");
    session_destroy();

   }
   public function startSessionOperations(){
      switch($_SERVER['REQUEST_METHOD']){
        case 'POST':

          try{

            //if username password is sent
            if(isset($_POST["username"]) && isset($_POST["password"])){

              //taking username password from browser
              $username = $_POST["username"];
              $password = $_POST["password"];

              //doing basic authentication
              $this->basicAuthentication($username , $password);

              //starting session
              session_start();
              $_SESSION["username"] = $username;
              $_SESSION["password"] = $password;
              
             //performing a random  task
              $result = "Result from random job: " . $this->randomJob();

              //storing the result form task in server's SESSION
              $_SESSION["result"] = $result;
              $_SESSION["sessionId"] = session_id();
            

              //if username OR password is not sent & sessionId is present
            }else if(isset($_COOKIE["PHPSESSID"])){

              //resuming the session or starting a new session
              session_start();
             
              echo "\n"."Session is active"."\n";

              $this->logout();
              

              //looking for previously saved session values
              if(isset($_SESSION["result"])){
                echo $_SESSION["result"];
              }

            }
            else{
            throw new Exception("Unable to authenticate.");
            }
          }catch(Exception $e){
            echo "Exception encountered: ".$e->getMessage();
          }

        break;
      }
   }
  }
  

 
  $sessionObj = new SessionOperations();




?>