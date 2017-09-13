<?php
$servername = "localhost";
$username = "lhk";
$password = "n3liss3n";
$dbname = "lhk";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}else{
	debugmsg(__FILE__."(".__LINE__.")".": Mysql connect succes!");
}
?>