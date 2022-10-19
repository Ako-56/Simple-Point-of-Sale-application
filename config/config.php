<?php
$server= "127.0.0.1:3306";
$username = "root";
$password = "*********";
$dbname = "apos";


// Create connection
$conn = mysqli_connect($server, $username,$password,$dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>

