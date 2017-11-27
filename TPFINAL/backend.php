		<?php
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/usuarioDao.php');
			include ('headerbackend.html');

			$usuario = (isset($_GET["usuarioUsuario"]) ? $_GET["usuarioUsuario"] : "");
			$nombreUsuario = usuarioDao::traerNombreUsuario($usuario);
		?>

		<h2>Bienvenido/a al BackOffice <?php echo $nombreUsuario; ?></h2>

		<?php include ('footer.html'); ?>
