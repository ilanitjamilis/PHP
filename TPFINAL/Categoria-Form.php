		<?php
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/categoriaDao.php');
			include ('headerbackend.html');

			$id = (isset($_GET["idCategoria"]) ? $_GET["idCategoria"] : 0);

			$cat = categoriaDao::traerCategoria($id);
		?>

		<script>
			var error;

			function validar(){
				var labelError = $(".error");
				labelError.html = "";

				error = false;

				var nombre = $("#nombre").val();

				if(nombre==""){
					$("#errorNombre").text("El nombre es obligatorio");
					error = true;
				}
				else{
					$("#errorNombre").text("");
				}

				if(error==false){
					$.ajax({
					async:true,
					type: "POST",
					url: "validarCategoria.php",
					data:$("#formPrincipal").serialize(),
					success: function (input) {

							//Cuando hay errores aca en AJAX comentar todo lo de abajo y hacer un alert del imput (es la respuesta)
							//alert(input);

							var error = JSON.parse(input);
							var labelError = $(".error");
							if(error["TodoBien"]=="NO HAY ERRORES"){
								alert("Cambios guardados correctamente");
								labelError.innerHTML="";
								window.location = 'http://localhost/TPFINAL/Categoria-Listado.php';
							}
							else{
								labelError.html = error["errorNombre"];
							}
						}
					});
				}
			}

		</script>

		<h2>Completar el siguiente formulario</h2></br>
		<form action="validarCategoria.php" method="POST" id="formPrincipal">

			<!-- Del lado del servidor name. Del lado del cliente id. -->
			<input type="hidden" name="id" id="id" value="<?php echo $cat->id; ?>" />

			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" value="<?php echo $cat->nombre; ?>" />
			<label class="error" id="errorNombre"></label> </br></br>

			<input type="button" id="btnEnviar" name="btnEnviar" value="ACEPTAR" onclick="validar();" />

		</form>

		<?php include ('footer.html'); ?>
