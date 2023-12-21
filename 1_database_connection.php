<?php

$servername = 'localhost:3306';
$username = 'root';
$password = 'admin';
$database = 'world';

try { $conn = mysqli_connect($servername , $username,$password, $database);
if(!$conn){
  die("failed" . mysqli_connect_error());
}else{
    echo "Connected Successfully \n";
}
  $query = "Select * from city where CountryCode='AFG';";
  $result = mysqli_query($conn , $query );
  echo $resultCheck = mysqli_num_rows($result);
echo "Name\tCountryCode\tDistrict\tPopulation\n";
  while ($row = mysqli_fetch_assoc($result)){
    echo $row["Name"]."\t".$row["CountryCode"]."\t\t".$row["District"]."\t".$row["Population"]."\n\n";
  }



  mysqli_close($conn);



}catch(Error $e){
  echo $e->getMessage();
}
?>