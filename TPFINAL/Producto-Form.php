		<?php
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/productoDao.php');
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/categoriaDao.php');
			include ('headerbackend.html');

			$id = (isset($_GET["idProducto"]) ? $_GET["idProducto"] : 0);

			$prod = productoDao::traerProducto($id);

			$listadoCategorias = categoriaDao::traerCategorias();

			function alert($msg) {
				echo "<script type='text/javascript'>alert('$msg');</script>";
			}
		?>

		<script>
			var error;

			function validar(){
				var labelsError = $(".error");
				for (x in labelsError){
					labelsError[x].html = "";
				}

				error = false;

				var codigo = $("#codigo").val();
				var nombre = $("#nombre").val();
				var precio = $("#precio").val();
				var descripcion = $("#descripcion").val();

				if(codigo==""){
					$("#errorCodigo").text("El código es obligatorio");
					error = true;
				}
				else{
					$("#errorCodigo").text("");
				}

				if(nombre==""){
					$("#errorNombre").text("El nombre es obligatorio");
					error = true;
				}
				else{
					$("#errorNombre").text("");
				}

				if(precio==""){
					$("#errorPrecio").text("El precio es obligatorio");
					error = true;
				}
				else{
					$("#errorPrecio").text("");
				}

				if(descripcion==""){
					$("#errorDescripcion").text("La descripcion es obligatoria");
					error = true;
				}
				else{
					$("#errorDescripcion").text("");
				}

				if(error==false){
					$.ajax({
					async:true,
					type: "POST",
					url: "validarProducto.php",
					data:$("#formPrincipal").serialize(),
					success: function (input) {

							//Cuando hay errores aca en AJAX comentar todo lo de abajo y hacer un alert del imput (es la respuesta)
							//alert(input);

							var errores = JSON.parse(input);
							if(errores["TodoBien"] == "NO HAY ERRORES"){
								alert("Cambios guardados correctamente");
								for (x in labelsError){
									labelsError[x].html = "";
								}
								window.location = 'http://localhost/TPFINAL/Producto-Listado.php';
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
		<form action="validarProducto.php" method="POST" id="formPrincipal" enctype="multipart/form-data">

			<!-- Del lado del servidor name. Del lado del cliente id. -->
			<input type="hidden" name="id" id="id" value="<?php echo $prod->id; ?>" />

			<label for="categoria">Categoría:</label>
			<select name="categoria" id="categoria">
				<option value="0"> </option>
				<?php foreach($listadoCategorias as $cat){
					if($prod->idCategoria == $cat->id){
				?>
					<option value="<?php echo $cat->id;?>" selected> <?php echo $cat->nombre; ?> </option>

				<?php }else{ ?>
					<option value="<?php echo $cat->id;?>"> <?php echo $cat->nombre; ?> </option>
				<?php }} ?>
			</select>
			<label class="error" id="errorCategoria"></label> </br></br>

			<label for="codigo">Código:</label>
			<input type="text" name="codigo" id="codigo" value="<?php echo $prod->codigo; ?>" />
			<label class="error" id="errorCodigo"></label> </br></br>

			<label for="nombre">Nombre:</label>
			<input type="text" name="nombre" id="nombre" value="<?php echo $prod->nombre; ?>" />
			<label class="error" id="errorNombre"></label> </br></br>

			<label for="precio">Precio:</label>
			<input type="number" step="0.01" name="precio" id="precio" value="<?php echo $prod->precio; ?>" />
			<label class="error" id="errorPrecio"></label> </br></br>

			<label for="destacado">Destacado:</label>
			<select name="destacado" id="destacado">
				<option value="0"> </option>
				<option value="1" <?php echo ($prod->destacado == 1 ? "selected" : ""); ?>> NO </option>
				<option value="2" <?php echo ($prod->destacado == 2 ? "selected" : ""); ?>> SI </option>
			</select>
			<label class="error" id="errorDestacado"></label> </br></br>

			<label for="descripcion">Descripción:</label>
			<textarea rows="4" cols="50" name="descripcion" id="descripcion"><?php echo $prod->descripcion; ?></textarea>
			<label class="error" id="errorDescripcion"></label> </br></br>

			<label for="imagen">Imagen:</label>
			<input type="file" name="imagen" id="imagen" value="<?php echo $prod->imagen; ?>" />
			<label class="error" id="errorImagen"></label> </br></br>

			<input type="button" id="btnEnviar" name="btnEnviar" value="ACEPTAR" onclick="validar();" />

		</form>

		<?php include ('footer.html'); ?>
