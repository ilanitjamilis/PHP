		<?php
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/productoDao.php');
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/categoriaDao.php');
			include ('header.html');

			$listcat = categoriaDao::traerCategorias();

			$idCat = (isset($_GET["idCategoria"]) ? $_GET["idCategoria"] : 0);
		?>

		<script>
			function filtrar(id){
				window.location.href = "productos.php?idCategoria="+id+"";
			}
		</script>

		<h2>Todos los Productos</h2>

		</br>Filtrar:

		<div class="btn-group">
		<?php
			foreach($listcat as $cat){
		?>
				<button type="button" class="btn" onclick='filtrar(<?php echo $cat->id ?>);'><?php echo $cat->nombre ?></button>
		<?php
			}
		?>
		<button type="button" class="btn" onclick='filtrar(0);'>TODOS</button> </br></br>
		</div>

		<?php
			if($idCat!=0){
				$listado = productoDao::traerProductosFiltrados($idCat);
			}
			else{
				$listado = productoDao::traerProductos();
			}

			if(sizeof($listado) > 0){
				$tabla = "<table border=1 ><tr><th>Categoría</th><th>Código</th><th>Nombre</th><th>Precio</th><th>Destacado</th><th>Descripción</th>
				<th>Imagen</th></tr>";
				$salida = "<div>";
				foreach ($listado as $producto){
					$tabla .=  "<tr><td>".$producto->idCategoria."</td><td>".$producto->codigo."</td><td>".$producto->nombre."</td>
					<td>".$producto->precio."</td><td>".($producto->destacado == 1 ? "NO" : ($producto->destacado == 2 ? "SI" : ""))."</td><td>".$producto->descripcion."</td>
					<td>".$producto->imagen."</td></tr>";
					$salida .= '<div class="card" style="width: 20rem; float:left;">
								  <img class="card-img-top">
								  <div class="card-block">
									<h4 class="card-title">'.$producto->nombre.'</h4>
									<p class="card-text"><a href="productos-detalle.php?idproducto='.$producto->id.'" >Ver más</a></p>
									<!-- Falta imagen -->
								  </div>
								</div>';
				}
				$tabla .= "</table>";
				$salida .= "</div>";
				echo $salida;
			}else{
			   ?></br></br></br></br><?php echo "No hay resultados";
			}

				include ('footer.html');
		?>
