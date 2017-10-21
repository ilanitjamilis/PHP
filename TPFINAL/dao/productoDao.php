<?php

include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/model/producto.php');

class productoDao {

    static function abrirBaseDatos() {
        $opts = array(
        'servername' => "localhost",
        'username' => "root",
        'password' => "",
        'dbname' => "db",
    );
        $DBH = new PDO("mysql:host=" . $opts['servername'] . ";dbname=" . $opts['dbname'], $opts['username'], $opts['password']);
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $DBH;
    }

    public static function traerProducto($id) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT idProductos, idCategorias, Codigo, Nombre, Precio, Destacado, Descripcion, Imagen FROM productos WHERE idProductos= :idProductoP";
            $params = array(
                ":idProductoP" => $id
            );
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute($params);
            
			$prod = new producto();
			
			if ($STH->rowCount() > 0) {

				//RECORRO CADA FILA
				while($row = $STH->fetch()) {
					$prod->id = $row['idProductos'];    
					$prod->idCategoria = $row['idCategorias'];  
					$prod->codigo = $row['Codigo'];  
					$prod->nombre = $row['Nombre'];  
					$prod->precio = $row['Precio']; 
					$prod->destacado = $row['Destacado'];  
					$prod->descripcion = $row['Descripcion'];  
					$prod->imagen = $row['Imagen'];  					
				}
			}			
			
        } catch (PDOException $e) {
            return new producto();
        }
        $DBH = null;
        return $prod;
    }
	
	public static function traerProductoCC($id) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT productos.idProductos, categorias.Nombre AS Categoria, productos.Codigo, productos.Nombre, productos.Precio, productos.Destacado, 
			productos.Descripcion, productos.Imagen FROM productos 
			INNER JOIN categorias ON productos.idCategorias = categorias.idCategorias WHERE idProductos= :idProductoP";
			
			$params = array(
                ":idProductoP" => $id
            );
			
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute($params);
            
			$prod = new producto();
			
			if ($STH->rowCount() > 0) {

				//RECORRO CADA FILA
				while($row = $STH->fetch()) {
					$prod->id = $row['idProductos'];    
					$prod->idCategoria = $row['Categoria'];  
					$prod->codigo = $row['Codigo'];  
					$prod->nombre = $row['Nombre'];  
					$prod->precio = $row['Precio']; 
					$prod->destacado = $row['Destacado'];  
					$prod->descripcion = $row['Descripcion'];  
					$prod->imagen = $row['Imagen']; 				
				}
			}	
			
        } catch (PDOException $e) {
            return new producto();
        }
        $DBH = null;
		
		return $prod;
    }
	
	public static function traerProductosCC() {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT productos.idProductos, categorias.Nombre AS Categoria, productos.Codigo, productos.Nombre, productos.Precio, productos.Destacado, 
			productos.Descripcion, productos.Imagen FROM productos 
			INNER JOIN categorias ON productos.idCategorias = categorias.idCategorias";
			
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute();
            
			$listado = array();
			
			if ($STH->rowCount() > 0) {

				//RECORRO CADA FILA
				$i = 0;
				while($row = $STH->fetch()) {
					$prod = new producto();
					
					$prod->id = $row['idProductos'];    
					$prod->idCategoria = $row['Categoria'];  
					$prod->codigo = $row['Codigo'];  
					$prod->nombre = $row['Nombre'];  
					$prod->precio = $row['Precio']; 
					$prod->destacado = $row['Destacado'];  
					$prod->descripcion = $row['Descripcion'];  
					$prod->imagen = $row['Imagen'];  			

					$listado[$i] = $prod;
					
					$i++;
				}
			}		
			
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $DBH = null;
        return $listado;
    }
	
	public static function traerProductosFiltrados($id) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT productos.idProductos, categorias.Nombre AS Categoria, productos.Codigo, productos.Nombre, productos.Precio, productos.Destacado, 
			productos.Descripcion, productos.Imagen FROM productos 
			INNER JOIN categorias ON productos.idCategorias = categorias.idCategorias WHERE categorias.idCategorias=:idCat";
			
			$params = array(
                ":idCat" => $id
            );
			
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute($params);
            
			$listado = array();
			
			if ($STH->rowCount() > 0) {

				//RECORRO CADA FILA
				$i = 0;
				while($row = $STH->fetch()) {
					$prod = new producto();
					
					$prod->id = $row['idProductos'];    
					$prod->idCategoria = $row['Categoria'];  
					$prod->codigo = $row['Codigo'];  
					$prod->nombre = $row['Nombre'];  
					$prod->precio = $row['Precio']; 
					$prod->destacado = $row['Destacado'];  
					$prod->descripcion = $row['Descripcion'];  
					$prod->imagen = $row['Imagen'];  			

					$listado[$i] = $prod;
					
					$i++;
				}
			}		
			
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $DBH = null;
        return $listado;
    }
	
	public static function traerProductosDestacados() {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT productos.idProductos, categorias.Nombre AS Categoria, productos.Codigo, productos.Nombre, productos.Precio, productos.Destacado, 
			productos.Descripcion, productos.Imagen FROM productos 
			INNER JOIN categorias ON productos.idCategorias = categorias.idCategorias WHERE productos.Destacado= 2 ";
			
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute();
            
			$listado = array();
			
			if ($STH->rowCount() > 0) {

				//RECORRO CADA FILA
				$i = 0;
				while($row = $STH->fetch()) {
					$prod = new producto();
					
					$prod->id = $row['idProductos'];    
					$prod->idCategoria = $row['Categoria'];  
					$prod->codigo = $row['Codigo'];  
					$prod->nombre = $row['Nombre'];  
					$prod->precio = $row['Precio']; 
					$prod->destacado = $row['Destacado'];  
					$prod->descripcion = $row['Descripcion'];  
					$prod->imagen = $row['Imagen'];  			

					$listado[$i] = $prod;
					
					$i++;
				}
			}		
			
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $DBH = null;
        return $listado;
    }

    public static function traerProductos() {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "SELECT productos.idProductos, categorias.Nombre AS Categoria, productos.Codigo, productos.Nombre, productos.Precio, productos.Destacado, 
			productos.Descripcion, productos.Imagen FROM productos 
			INNER JOIN categorias ON productos.idCategorias = categorias.idCategorias";
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $STH->execute();
			
			$listado = array();
			
			if ($STH->rowCount() > 0) {

				//RECORRO CADA FILA
				$i = 0;
				while($row = $STH->fetch()) {
					$prod = new producto();
					
					$prod->id = $row['idProductos'];    
					$prod->idCategoria = $row['Categoria'];  
					$prod->codigo = $row['Codigo'];  
					$prod->nombre = $row['Nombre'];  
					$prod->precio = $row['Precio']; 
					$prod->destacado = $row['Destacado'];  
					$prod->descripcion = $row['Descripcion'];  
					$prod->imagen = $row['Imagen'];  			

					$listado[$i] = $prod;
					
					$i++;
				}
			}		
			
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $DBH = null;
		return $listado;
    }

    public static function agregarModificarProducto($producto) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "INSERT INTO productos SET idProductos = :idProductosP, idCategorias=:idCategoriasP, Codigo=:codigoP, Nombre=:nombreP, Precio=:precioP, 
			Destacado=:destacadoP, Descripcion=:descripcionP, Imagen=:imagenP ON DUPLICATE KEY UPDATE idProductos = :idProductosP, idCategorias=:idCategoriasP, 
			Codigo=:codigoP, Nombre=:nombreP, Precio=:precioP, Destacado=:destacadoP, Descripcion=:descripcionP, Imagen=:imagenP";
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $params = array(
                ":idProductosP" => $producto->id,
                ":idCategoriasP" => $producto->idCategoria,
                ":codigoP" => $producto->codigo,
                ":nombreP" => $producto->nombre,
				":precioP" => $producto->precio,
				":destacadoP" => $producto->destacado,
				":descripcionP" => $producto->descripcion,
				":imagenP" => $producto->imagen
            );
            $STH->execute($params);
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $DBH = null;
    }

    public static function eliminarProducto($idProducto) {
        $DBH = self::abrirBaseDatos();
        try {
            $query = "DELETE FROM productos WHERE idProductos = :idProductoP";
            $STH = $DBH->prepare($query);
            $STH->setFetchMode(PDO::FETCH_ASSOC);
            $params = array(
                ":idProductoP" => $idProducto
            );
            $STH->execute($params);
            $resultados = $STH->fetchAll();
        } catch (PDOException $e) {
            echo $query . "<br>" . $e->getMessage();
        }
        $DBH = null;
    }
	
	public static function validarCodigo($codValidar, $id){
		$DBH = self::abrirBaseDatos();
		
		$existe = 0;
	
		try {
			$query = "SELECT idProductos, Codigo FROM productos";
			$STH = $DBH->prepare($query);
			$STH->setFetchMode(PDO::FETCH_ASSOC);
			$STH->execute();
			
			if ($STH->rowCount() > 0) {

				//RECORRO CADA FILA
				$i = 0;
				while($row = $STH->fetch()) {
					
					if($id != $row['idProductos']){
						if($codValidar == $row['Codigo']){
							$existe = 1;
						}
					} 			
					
					$i++;
				}
			}	
		} catch (PDOException $e) {
			echo $query . "<br>" . $e->getMessage();
		}
		$DBH = null;
		
		return $existe;
	}

}

;
