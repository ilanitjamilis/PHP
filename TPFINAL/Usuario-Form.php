		<?php
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/usuarioDao.php');
			include ('header.html');

			$id = (isset($_GET["idUsuario"]) ? $_GET["idUsuario"] : 0);

			$usuario = usuarioDao::traerUsuario($id);

			function alert($msg) {
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
		?>

		<script>
			//VALIDAR SI HAY TIEMPO DEL LADO DEL CLIENTE

			var error;

			function validar(){

				var labelsError = $(".error");
				for (x in labelsError){
					labelsError[x].html = "";
				}

				var labelError = $(".error");
				labelError.html = "";

				error = false;

				var nombre = $("#nombre").val();
				var usuario = $("#usuario").val();
				var contrasena = $("#contrasena").val();
				var contrasena2 = $("#contrasena2").val();

				if(nombre==""){
					$("#errorNombre").text("El nombre es obligatorio");
					error = true;
				}
				else{
					$("#errorNombre").text("");
				}

				if(usuario==""){
					$("#errorUsuario").text("El usuario es obligatorio");
					error = true;
				}
				else{
					$("#errorUsuario").text("");
				}

				if(contrasena==""){
					$("#errorContrasena").text("La contraseña es obligatorio");
					error = true;
				}
				else{
					$("#errorContrasena").text("");
				}

				if(contrasena2==""){
					$("#errorContrasena2").text("La contraseña es obligatorio");
					error = true;
				}
				else{
					$("#errorContrasena2").text("");
				}

				if(contrasena2!=contrasena){
					$("#errorContrasena2").text("Las contraseñas deben ser iguales");
					error = true;
				}
				else{
					$("#errorContrasena2").text("");
				}

				if(error==false){
					$.ajax({
					async:true,
					type: "POST",
					url: "validarUsuario.php",
					data:$("#formPrincipal").serialize(),
					success: function (input) {

							//Cuando hay errores aca en AJAX comentar todo lo de abajo y hacer un alert del imput (es la respuesta)
							//alert(input);

							var errores = JSON.parse(input);
							var labelError = $(".error");
							if(errores["TodoBien"]=="NO HAY ERRORES"){
								alert("Cambios guardados correctamente");
								labelError.innerHTML="";
								window.location = 'http://localhost/TPFINAL/login.php';
							}
							else{
								var i = -1;
								for (x in errores){
									if(i>=0){
										labelsError[i].innerHTML=(errores[x]);
									}
									i++;
								}
							}
						}
					});
				}
			}

		</script>

		<h2>Completar el siguiente formulario</h2></br>
		<form action="validarUsuario.php" method="POST" id="formPrincipal" enctype="multipart/form-data">

			<!-- Del lado del servidor name. Del lado del cliente id. -->
			<input type="hidden" name="id" id="id" value="<?php echo $usuario->id; ?>" />

			<label for="nombre">Nombre y Apellido:</label>
			<input type="text" name="nombre" id="nombre" value="<?php echo $usuario->nombre; ?>" />
			<label class="error" id="errorNombre"></label> </br></br>

			<label for="usuario">Usuario:</label>
			<input type="text" name="usuario" id="usuario" value="<?php echo $usuario->usuario; ?>" />
			<label class="error" id="errorUsuario"></label> </br></br>

			<label for="contrasena">Contraseña:</label>
			<input type="password" name="contrasena" id="contrasena" value="<?php echo $usuario->contrasena; ?>" />
			<label class="error" id="errorContrasena"></label> </br></br>

			<label for="contrasena2">Repetir Contraseña:</label>
			<input type="password" name="contrasena2" id="contrasena2" value="<?php echo $usuario->contrasena; ?>" />
			<label class="error" id="errorContrasena2"></label> </br></br>

			<input type="button" id="btnEnviar" name="btnEnviar" value="ACEPTAR" onclick="validar();" />

		</form>

		<?php include ('footer.html'); ?>
