<?php

class personaDao {

    static function abrirBaseDatos() {
        $opts = array(
        'servername' => "localhost",
        'username' => "root",
        'password' => "root",
        'dbname' => "db",
    );
        $DBH = new PDO("mysql:host=" . $opts['servername'] . ";dbname=" . $opts['dbname'], $opts['username'], $opts['password']);
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $DBH;
    }

    public static function traerPersona($id) {
        $DBH = self::abrirBaseDatos();
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
        $DBH = null;
        echo json_encode($resultados);
    }

    public static function traerPersonas() {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT * FROM Personas";
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute();
            $resultados = $STH->fetchAll();
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $DBH = null;
        echo json_encode($resultados);
    }

    public static function agregarModificarPersona($usuario) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "INSERT INTO Personas SET idPersonas = :idPersonas, Nombre=:nombre, Apellido=:apellido, Email=:email ON DUPLICATE KEY UPDATE idPersonas = :idPersonas, Nombre=:nombre, Apellido=:apellido, Email=:email";
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $params = array(
                ":idPersonas" => $usuario->id,
                ":nombre" => $usuario->nombre,
                ":apellido" => $usuario->apellido,
                ":email" => $usuario->mail,
            );
            $STH->execute($params);
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $DBH = null;
    }

    public static function eliminarPersona($idPersonas) {
        $DBH = self::abrirBaseDatos();
        try {
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
        $DBH = null;
    }

}

;
