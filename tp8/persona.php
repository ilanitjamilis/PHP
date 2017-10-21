<?php

class persona {

    private $id;
    private $nombre;
    private $apellido;
    private $mail;
    private $opts = array(
        'servername' => "localhost",
        'username' => "root",
        'password' => "root",
        'dbname' => "db",
    );
    private $DBH;

    function __construct() {
        $this->DBH = new PDO("mysql:host=" . $opts['servername'] . ";dbname=" . $opts['dbname'], $opts['username'], $opts['password']);
        $this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function ObtenerPorID($id) {
        try {
            $query = "SELECT Nombre, Apellido, Email FROM Personas WHERE idPersonas= :idPersonas";
            $params = array(
                ":idPersonas" => $id
            );
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute($params);
            $resultados = $STH->fetchAll();
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $conn = null;
        echo json_encode($resultados);
    }

    public static function ObtenerTodos() {
        try {
            $query = "SELECT * FROM Personas";
            $STH = $this->DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute();
            $resultados = $STH->fetchAll();
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $conn = null;
        echo json_encode($resultados);
    }

    public static function agregarModificarPersona($usuario) {
        try {
            $query = "INSERT INTO Personas SET idPersonas = :idPersonas, Nombre=:nombre, Apellido=:apellido, Email=:email ON DUPLICATE KEY UPDATE idPersonas = :idPersonas, Nombre=:nombre, Apellido=:apellido, Email=:email";
            $STH = $this->DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $params = array(
                ":idPersonas" => $usuario->id,
                ":nombre" => $usuario->nombre,
                ":apellido" => $usuario->apellido,
                ":email" => $usuario->email,
            );
            $STH->execute($params);
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $conn = null;
    }

    public static function eliminarPersona($idPersonas) {
        try {
            $query = "DELETE FROM Personas WHERE idPersonas = :idPersonas";
            $STH = $this->DBH->prepare($query);
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
    }

}

;
