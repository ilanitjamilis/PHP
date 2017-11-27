		<?php
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/productoDao.php');
			include ('headerbackend.html');
		?>

		<script>
			function insertarProducto(){
				window.location = 'http://localhost/TPFINAL/Producto-Form.php';
			}

			function modificarProducto(id){
				window.location = 'http://localhost/TPFINAL/Producto-Form.php?idProducto='+ id;
			}

			function eliminarProducto(id){
				$.ajax({
					async:true,
					type: "POST",
					url: "Producto-Eliminar.php",
					data:"data=" + id,
					success: function (input) {
							window.location.reload();
						}
				});
			}
		</script>

		<h2>ABM Productos</h2>

		<br/><button onclick='insertarProducto()'>Insertar Producto</button><br/><br/>

		<?php
			$listado = productoDao::traerProductosCC();

			$tabla = "<table border=1 ><tr><th>Categoría</th><th>Código</th><th>Nombre</th><th>Precio</th><th>Destacado</th><th>Descripción</th>
			<th>Imagen</th><th>Acciones</th></tr>";
			$salida = "<div>";
			foreach ($listado as $producto){
				$tabla .=  "<tr><td>".$producto->idCategoria."</td><td>".$producto->codigo."</td><td>".$producto->nombre."</td>
				<td>".$producto->precio."</td><td>".($producto->destacado == 1 ? "NO" : ($producto->destacado == 2 ? "SI" : ""))."
				</td><td>".$producto->descripcion."</td><td>".$producto->imagen."</td><td><button onclick=
				'modificarProducto(".$producto->id.");'>Modificar</button><button onclick='eliminarProducto(".$producto->id.");'>
				Eliminar</button></td></tr>";

				$salida .= '<div class="card" style="width: 30rem; float:left; margin:10px; padding-bottom:20px;">
							  <img class="card-img-top">
							  <div class="card-block">
								<p class="card-text">Categoria: '.$producto->idCategoria.'</p>
								<h4 class="card-title">Nombre: '.$producto->nombre.'</h4>
								<p class="card-text">Código: '.$producto->codigo.'</p>
								<p class="card-text">Precio: $'.$producto->precio.'</p>
								<p class="card-text">Destacado: '.($producto->destacado == 1 ? "NO" : ($producto->destacado == 2 ? "SI" : "")).'</p>
								<p class="card-text">Descripción: '.$producto->descripcion.'</p>
								<!-- Falta imagen -->
								<button onclick="modificarProducto('.$producto->id.');">Modificar</button>
								<button onclick="eliminarProducto('.$producto->id.');">Eliminar</button>
							  </div>
							</div>';
			}
			$tabla .= "</table>";
			$salida .= "</div>";
			echo $salida;

			include ('footer.html');
		?>
