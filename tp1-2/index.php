<html>
	<head>
		<title>TP 1</title>	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 		
	</head>
	
	<body>
		
		<?php include_once ("funciones.php"); ?>
		
		<h2>Completar el siguiente formulario</h2>
		<form action="index.php" method="POST"> 
		
			<label for="nom">Nombre:</label>
			<input type="text" name="nombre" value="<?php echo $nombre; ?>" id="nom"/>
			<label><?php echo $errorNombre; ?></label> </br></br>
			
			<label for="ape">Apellido:</label>
			<input type="text" name="apellido" value="<?php echo $apellido; ?>" id="ape"/>
			<label><?php echo $errorApellido; ?></label></br></br>
			
			<label for="mail">Email:</label>
			<input type="text" name="email" value="<?php echo $mail; ?>" id="mail"/>
			<label><?php echo $errorMail; ?></label></br></br>
			
			<label for="dni">DNI:</label>
			<input type="number_format" name="documento" value="<?php echo $dni; ?>" id="dni"/></br></br>

			<label for="fech">Fecha de nacimiento:</label>
			<input type="text" name="fecha" value="<?php echo $fechaNacimiento; ?>" id="fech"/>
			<label><?php echo $errorFecha; ?></label></br></br>
			
			<label for="contra">Contraseña:</label>
			<input type="password" name="contraseña" value="<?php echo $contraseña; ?>" id="contra"/>
			<label><?php echo $errorContraseña; ?></label></br></br>
			
			<label for="contra2">Repetir contraseña:</label>
			<input type="password" name="contraseña2" value="<?php echo $contraseña2; ?>" id="contra2"/>
			<label><?php echo $errorContraseña2; ?></label></br></br>
			
			<input type="submit" value="ACEPTAR"/>
		
		</form>
	</body>
</html>