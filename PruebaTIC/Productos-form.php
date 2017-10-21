<html>
	<head>
		<title> Prueba TIC 2do Trimestre </title>

		<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
		<script>
				function validar(Id){
					var Nombre = $("#Nombre").val();
					var Codigo = $("#Codigo").val();
					var Precio = $("#Precio").val();


					var HayErrores = 0;
					HayErrores += CamposObligatorios(Nombre, Codigo, Precio)

					function CamposObligatorios(Nombre, Codigo, Precio){
						var HayErrores = 0;

						if(Nombre==""){
							$("#errornombre").text('Campo obligatorio');
							HayErrores++;
						}else {
							$("#errornombre").text('');
						}
						if (Codigo=="") {
							$("#errorcodigo").text('Campo obligatorio');
							HayErrores++
						}else {
							$("#errorcodigo").text('');
						}
						if(Precio==""){
							$("#errorprecio").text('Campo obligatorio');
							HayErrores++
						}else {
							$("#errorprecio").text('');
						}
						if(Precio < 1 && Precio != ''){
						  $("#errorprecio").text('Precio debe ser mayor a 0');
						  HayErrores++
						}
						return HayErrores;

					}
					if(HayErrores == 0)
					{
						$.ajax({
							url : 'validacion.php',
							type : 'POST',
							data: $("#Form").serialize(), // Adjuntar los campos del formulario enviado.
							success : function(data) {
								var objeto = JSON.parse(data);
								if(objeto.HayError == 0){
									location.href="Index.php?Id="+Id;
								}else{
								  $("#errornombre").text(objeto.errornombre);
								  $("#errorcodigo").text(objeto.errorcodigo);
								  $("#errorprecio").text(objeto.errorprecio);
								}

							},
							error : function(xhr, status) {
								alert('Disculpe, existió un problema');
							},
						});
					}
				}
		</script>
	</head>
	<body>
		<form action="validacion.php" method="post" id="Form">
			<input type="text" id="Nombre" name="Nombre" placeholder="Nombre" />
			<input type="hidden" id="id" name="id" />
			<label id="errornombre"></label><br>
			<input type="text" id="Codigo" name="Codigo" placeholder="Codigo" />
			<label id="errorcodigo"></label><br>
			<input type="number" id="Precio" name="Precio" placeholder="Precio"/>
			<label id="errorprecio"></label><br>
			<?php
				$Id = (isset($_GET['id']) ? $_GET['id'] : 0);
				if($Id == 0){
					$result[0]["id"] = 0;
				}else{
					$DBH = new PDO("mysql:host=localhost;dbname=db", "root", "root");
					$stmt = $DBH->prepare('SELECT * FROM productos WHERE id=:Id');
					$stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
					$stmt->setFetchMode(PDO::FETCH_ASSOC);
					$stmt->execute();
					$result = $stmt->fetchAll();

					echo '<script>
						$("#Nombre").val("'.$result[0]["nombre"].'");
							$("#Codigo").val("'.$result[0]["codigo"].'");
						$("#Precio").val("'.$result[0]["precio"].'");
						$("#id").val("'.$result[0]["id"].'");
					</script>';
				}
			 ?>
			<input type="button" id="btnenviar" name="btnenviar" value="Enviar" onclick="validar(<?php echo $result[0]["id"] ?>);"/>
		</form>
		<div id="DatosRecibidos">

		</div>
	</body>

</html>
