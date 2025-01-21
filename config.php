<?php

$host = "localhost";
$username = "root";
$pass = "";
$dbname = "dailyexpense";

$con = mysqli_connect($host,$username,$pass,$dbname);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error() ." | Seems like you haven't created the DATABASE ";
  }

?>