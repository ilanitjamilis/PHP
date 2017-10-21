<?php
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db";
	$idPersonas = (isset($_POST["data"]) ? $_POST["data"] : "");
	
    try {
        $DBH = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "DELETE FROM Personas WHERE idPersonas = :idPersonas";
        $STH = $DBH->prepare($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
		$params = array(
        ":idPersonas" => $idPersonas
        );
        $STH->execute($params);
		$resultados = $STH->fetchAll();
    } catch (PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }

    $conn = null;
