<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $DBH = new PDO("mysql:host=$servername;dbname=db", $username, $password);
    // set the PDO error mode to exception
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	echo "Connection failed: " . $e->getMessage();
}
    
 ?>