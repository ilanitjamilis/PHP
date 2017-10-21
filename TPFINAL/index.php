
		<?php
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/productoDao.php');
			include ('header.html');
		?>

		<h2>Productos Destacados</h2>

		</br></br>

		<?php
			$listado = productoDao::traerProductosDestacados();

			$tabla = "<table>";
			$salida = "<div>";

			foreach ($listado as $producto){
				$tabla .=  "<tr><td>".$producto->nombre."</td><td><a href='productos-detalle.php?idproducto=".$producto->id."' >Ver más</a></td></tr>";
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

			include ('footer.html');
		?>
