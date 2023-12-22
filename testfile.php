<?php 

require "./4_DBConnection_ClassBased.php";
require "./4_API_handler.php";

$conn = new DbConnection();

$obj = new CustomerController($conn->conn);
$obj ->requestHandler();
?>