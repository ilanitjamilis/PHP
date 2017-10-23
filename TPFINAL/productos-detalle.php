		<?php
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/productoDao.php');
			include ('header.html');

			$id = (isset($_GET["idproducto"]) ? $_GET["idproducto"] : "");
			$prod = productoDao::traerProductoCC($id);
		?>

		<h2>Producto Detalle</h2>

		<div class="card" style="width: 20rem;">
		  <img class="card-img-top">
		  <div class="card-block">
			<h4 class="card-title"><?php echo $prod->nombre; ?></h4>
			<p class="card-text">Código: <?php echo $prod->codigo; ?></p>
			<p class="card-text">Categoria: <?php echo $prod->idCategoria; ?></p>
			<p class="card-text"><?php echo $prod->descripcion; ?></p>
			<p class="card-text">Precio: $<?php echo $prod->precio; ?></p>
			<!-- Falta imagen -->
		  </div>
		</div>

		<?php include ('footer.html'); ?>
