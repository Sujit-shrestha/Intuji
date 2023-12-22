<?php 

require_once "./4_DBConnection_ClassBased.php";
require_once "./5_UserController.php";

$conn = new DbConnection();
$mysqliConnection = $conn->mysqliConnection();

$obj =  new UserController(new UserModel( $mysqliConnection ));
$obj->requestHandler();

?>