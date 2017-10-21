<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
    $DBH = new PDO("mysql:host=$servername;dbname=prueba", $username, $password);
    // set the PDO error mode to exception
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    
   ?>