<?php 

class LetsLearnStatic {
  public static $count=1 ;
  public static function printSth(){
    echo "something";
  }
  public static function printingStaticProperty(){
    echo static::$count;
  }
  public static function printingStaticProperty2(){
  echo self::$count;
  }
}

class LetsLearnInheritanceOfStatic extends LetsLearnStatic{

  public function __construct(){
   LetsLearnStatic::$count =2;
  }
}

$inst1 = new LetsLearnStatic();
$inst2 = new LetsLearnStatic();

$inst3 = new LetsLearnInheritanceOfStatic();
// echo LetsLearnStatic::$count;
// LetsLearnStatic::printSth();
// LetsLearnStatic::printingStaticProperty()."\n";
// LetsLearnStatic::printingStaticProperty2()."\n";

// LetsLearnInheritanceOfStatic :: printingStaticProperty()."\n";
// LetsLearnInheritanceOfStatic :: printingStaticProperty2()."\n";

echo $inst3::$count;

?>