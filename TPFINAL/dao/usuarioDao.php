<?php

include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/model/usuario.php');

class usuarioDao {

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

    public static function traerUsuario($usuario) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT idUsuarios, Usuario, Contrasena, Nombre FROM usuarios WHERE Usuario= :usuarioUsuario";
            $params = array(
                ":usuarioUsuario" => $usuario
            );
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute($params);

            $usu = new usuario();

      			if ($STH->rowCount() > 0) {

      				//RECORRO CADA FILA
      				while($row = $STH->fetch()) {
      					$usu->id = $row['idUsuarios'];
      					$usu->usuario = $row['Usuario'];
                $usu->contrasena = $row['Contrasena'];
                $usu->nombre = $row['Nombre'];
      				}
      			}

        } catch (PDOException $e) {
            return new usuario();
        }
        $DBH = null;
        return $usu;
    }

    public static function traerNombreUsuario($usuario) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT Nombre FROM usuarios WHERE Usuario= :usuarioUsuario";
            $params = array(
                ":usuarioUsuario" => $usuario
            );
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute($params);

      			if ($STH->rowCount() > 0) {
      				//RECORRO CADA FILA
      				while($row = $STH->fetch()) {
      					return $row['Nombre'];
      				}
      			}

        } catch (PDOException $e) {
            return "";
        }
        $DBH = null;
        return "";
    }

    public static function verificarExistenciaUsuario($usuario) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT Usuario FROM usuarios WHERE Usuario= :usuarioUsuario";
            $params = array(
                ":usuarioUsuario" => $usuario
            );
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute($params);

            $existe = false;

      			if ($STH->rowCount() > 0) {

      				//RECORRO CADA FILA
      				while($row = $STH->fetch()) {
      					return true;
      				}
      			}

        } catch (PDOException $e) {
            return $existe;
        }
        $DBH = null;
        return $existe;
    }

    public static function agregarModificarUsuario($usuario) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "INSERT INTO usuarios SET idUsuarios = :idUsuarioP, Usuario = :usuarioP, Contrasena = :contrasenaP, Nombre=:nombreP
            ON DUPLICATE KEY UPDATE idUsuarios = :idUsuarioP, Usuario = :usuarioP, Contrasena = :contrasenaP, Nombre=:nombreP";
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $params = array(
                ":idUsuarioP" => $usuario->id,
                ":usuarioP" => $usuario->usuario,
                ":contrasenaP" => $usuario->contrasena,
                ":nombreP" => $usuario->nombre,
            );
            $STH->execute($params);
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $DBH = null;
    }

    public static function eliminarUsuario($idUsuario) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "DELETE FROM usuarios WHERE idUsuarios = :idUsuarioP";
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $params = array(
                ":idUsuarioP" => $idUsuario
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
