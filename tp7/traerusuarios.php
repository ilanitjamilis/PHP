<?php
	$id = (isset($_POST["data"]) ? $_POST["data"] : "");
	
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db";
    try {
        $DBH = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if($id != ""){
			$query = "SELECT Nombre, Apellido, Email FROM Personas WHERE idPersonas= :idPersonas";
			$params = array(
				":idPersonas" => $id
			);
			$STH = $DBH->prepare($query);
			$STH->setFetchMode(PDO::FETCH_ASSOC);
			$STH->execute($params);
		}else{
			$query = "SELECT idPersonas, Nombre, Apellido, Email FROM Personas";
			$STH = $DBH->prepare($query);
			$STH->setFetchMode(PDO::FETCH_ASSOC);
			$STH->execute();
		}
        
		$resultados = $STH->fetchAll();
    } catch (PDOException $e) {
        echo $query . "<br>" . $e->getMessage();
    }

    $conn = null;
    echo json_encode($resultados);
