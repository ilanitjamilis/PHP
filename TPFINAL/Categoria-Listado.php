		<?php
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/categoriaDao.php');
			include ('headerbackend.html');
		?>


		<script>
			function insertarCategoria(){
				window.location = 'http://localhost/TPFINAL/Categoria-Form.php';
			}

			function modificarCategoria(id){
				window.location = 'http://localhost/TPFINAL/Categoria-Form.php?idCategoria='+ id;
			}

			function eliminarCategoria(id){
				$.ajax({
					async:true,
					type: "POST",
					url: "Categoria-Eliminar.php",
					data:"data=" + id,
					success: function (input) {
							window.location.reload();
						}
				});
			}
		</script>

		<h2>ABM Categorías</h2>

		<br/><button onclick='insertarCategoria()'>Insertar Categoría</button><br/><br/>

		<?php
			$listado = categoriaDao::traerCategorias();

			$tabla = "<table border=1 ><tr><th>Nombre</th><th>Acciones</th></tr>";
			$salida = "<div>";

			foreach ($listado as $categoria){
				$tabla .=  "<tr><td>".$categoria->nombre."</td><td><button onclick='modificarCategoria(".$categoria->id.");'>
				Modificar</button><button onclick='eliminarCategoria(".$categoria->id.");'>Eliminar</button></td></tr>";

				$salida .= '<div class="card" style="width: 20rem; float:left;">
							  <img class="card-img-top">
							  <div class="card-block">
								<h4 class="card-title">Nombre: '.$categoria->nombre.'</h4>
								<button onclick="modificarCategoria('.$categoria->id.');">Modificar</button>
								<button onclick="eliminarCategoria('.$categoria->id.');">Eliminar</button>
							  </div>
							</div>';
			}
			$tabla .= "</table>";
			$salida .= "</div>";
			echo $salida;

			include ('footer.html');
		?>
