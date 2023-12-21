<?php 

class ExcepitonHandling{

  public static function getter (){
    try{
      echo "Trying block"."\n";
      $p =5;
      if($p>=5){
        throw new Exception('This is an exception');
      }

    }catch (Exception $e){
      echo "Caught exception ".$e->getMessage();
    }finally{
      echo "\nCompleted the function";
    }
  }
}

ExcepitonHandling :: getter();

?>