<?php
$servername = "localhost";
$username = "dbuser1";
$password = "50calUSA&&";

try {
	  $db = new PDO("mysql:host=$servername;dbname=lab1", $username, $password);
	    // set the PDO error mode to exception
	  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     	  echo "Connected successfully";
} catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
}
?>
