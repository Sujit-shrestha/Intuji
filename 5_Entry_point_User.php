<?php 

require_once "./4_DBConnection_ClassBased.php";
require_once "./5_UserController.php";

$conn = new DbConnection();

$obj =  new customerController(new UserModel( $conn ));
$obj->requestHandler();

?>