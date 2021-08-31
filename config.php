<?php
error_reporting(E_ALL);
$db_hostname="localhost";
$db_username="webscraping";
$db_password="webscraping@123";
$db_name="webscraping";
// $connection = mysqli_connect($db_hostname,$db_username,$db_password) or die("Connection Problem");
// $select_db = mysqli_select_db($db_name,$connection) or die("Could not Select Database");
$connection = mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>
