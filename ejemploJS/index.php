<html>
	<head>
		<title>ejemplo JB</title>
		<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		
		<script>
			function Validar(){
				var nombre = $("#nombre").val();
				var apellido = $("#apellido").val();
				var errores = "";
				
				if(nombre==""){
					//alert("El nombre es obligatorio");
					$("#errorNombre").text("El nombre es obligatorio"); //Es la opcion de validacion correcta
					errores+="<p>Debe completar el nombre</p>"
				}
				else{
					$("#errorNombre").text(""); //Es la opcion de validacion correcta
				}
				
				if(apellido==""){
					//Opcion 1: alert("El apellido es obligatorio");
					//Opcion 2: $("#errorApellido").text("El apellido es obligatorio");
					$("#errorApellido").show();
					errores+="<p>Debe completar el apellido</p>"
				}
				else{
					//Opcion 2: $("#errorApellido").text("");
					$("#errorApellido").hide();
				}
				
				if(errores!=""){
					$("#summary").html(errores);
				}
				else{
					$("#formPrincipal").submit();
				}
			}
		</script>
		
	</head>
	
	<body>
		<label>Complete el siguiente formulario</label></br></br>
		<form action="procesar.php" id="formPrincipal" method="post">
		
			<label for="nombre">Nombre: </label>
			<input type="text" name="nombre" id="nombre" /> 
			<label id="errorNombre"></label> </br></br>
			
			<label for="apellido">Apellido: </label>
			<input type="text" name="apellido" id="apellido" /> 
			<label id="errorApellido" style="display:none;">El apellido es obligatorio</label> </br></br>
			
			<input type="button" id="btnEnviar" name="btnEnviar" value="Enviar" onclick="Validar();" /> </br></br>
			
			<div id="summary"> </div>
		
		</form>

	</body>
</html>