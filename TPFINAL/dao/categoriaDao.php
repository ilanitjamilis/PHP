<?php

include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/model/categoria.php');

class categoriaDao {

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

    public static function traerCategoria($id) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT idCategorias, Nombre FROM categorias WHERE idCategorias= :idCategoriasP";
            $params = array(
                ":idCategoriasP" => $id
            );
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute($params);

      			$cat = new categoria();

      			if ($STH->rowCount() > 0) {

      				//RECORRO CADA FILA
      				while($row = $STH->fetch()) {
      					$cat->id = $row['idCategorias'];
      					$cat->nombre = $row['Nombre'];
      				}
      			}
        } catch (PDOException $e) {
            return new categoria();
        }
        $DBH = null;
    	  return $cat;
    }

    public static function traerCategorias() {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT * FROM categorias";
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute();

			$listado = array();

			if ($STH->rowCount() > 0) {

				//RECORRO CADA FILA
				$i = 0;
				while($row = $STH->fetch()) {
					$cat = new categoria();

					$cat->id = $row['idCategorias'];
					$cat->nombre = $row['Nombre'];

					$listado[$i] = $cat;

					$i++;
				}
			}

        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $DBH = null;
        return $listado;
    }

    public static function agregarModificarCategoria($categoria) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "INSERT INTO categorias SET idCategorias = :idCategoriasP, Nombre=:nombreP ON DUPLICATE KEY UPDATE
			idCategorias = :idCategoriasP, Nombre=:nombreP";
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $params = array(
                ":idCategoriasP" => $categoria->id,
                ":nombreP" => $categoria->nombre
            );
            $STH->execute($params);
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $DBH = null;
    }

    public static function eliminarCategoria($idCategoria) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "DELETE FROM categorias WHERE idCategorias = :idCategoriasP";
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $params = array(
                ":idCategoriasP" => $idCategoria
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
