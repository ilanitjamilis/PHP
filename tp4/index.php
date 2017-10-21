<html>
	<head>
		<title>TP 4</title>	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<script type="text/javascript" src="jquery-3.2.1.min.js"></script>		
	</head>
	
	<body>
	
		<script>
			var error;
			
			function Validar(){
				var labels = $(".error");
				for (x in labels){
					labels[x].innerHTML="";
				}
				
				error = false;
								
				var nombre = $("#nom").val();
				var apellido = $("#ape").val();
				var mail = $("#mail").val();
				var dni = $("#dni").val();
				var fecha = $("#fech").val();
				var contraseña = $("#contra").val();
				var contraseña2 = $("#contra2").val();
				
				if(nombre==""){
					$("#errorNombre").text("El nombre es obligatorio");
					error = true;
				}
				else{
					$("#errorNombre").text("");
				}
				
				if(apellido==""){
					$("#errorApellido").text("El apellido es obligatorio");
					error = true;
				}
				else{
					$("#errorApellido").text("");
				}
				
				if(mail==""){
					$("#errorMail").text("El e-mail es obligatorio");
					error = true;
				}
				else{
					var emailValido = validateEmail(mail);
					if(emailValido == false){
						$("#errorMail").text("E-mail inválido");
						error = true;
					}
					else{
						$("#errorMail").text("");
					}
				}
				
				// No anda el regex de validar fecha
				/*var fechaValidada = validateDate(fecha);
				if(fechaValidada == false){
					$("#errorFecha").text("Fecha inválida. El formato debe ser el siguiente: dd/mm/yyyy");
					error = true;
				}
				else{
					$("#errorFecha").text("");
				}*/
				
				if(contraseña==""){
					$("#errorContraseña").text("El campo contraseña es obligatorio");
					error = true;
				}
				else{
					$("#errorContraseña").text("");
				}
			
				if(contraseña2==""){
					$("#errorContraseña2").text("El campo repetir contraseña es obligatorio");
					error = true;
				}
				else{
					if(contraseña2!=contraseña){
						$("#errorContraseña2").text("Las contraseñas deben ser iguales");
						error = true;
					}
					else{
						$("#errorContraseña2").text("");
					}
				}
				
				if(error==false){
					$.ajax({
					async:true,
					type: "POST",
					url: "funciones.php",
					data:$("#formPrincipal").serialize(),
					success: function (input) {
							var respuestas = JSON.parse(input)
							var labels = $(".error");
							var i = 0;
							for (x in respuestas){
								labels[i].innerHTML=(respuestas[x]);
								i++;
							}
						}	
					});
				}
			}
			
			
			//No anda el regex de validar fecha
			/*function validateDate(date) {
			  var re = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$;
			  return re.test(date);
			}*/
			
			function validateEmail(email) {
			  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			  return re.test(email);
			}			
					
		</script>
	
		<?php //include_once ("funciones.php"); ?>
		
		<h2>Completar el siguiente formulario</h2>
		<form action="funciones.php" method="POST" id="formPrincipal"> 
		
			<label for="nom">Nombre:</label>
			<input type="text" name="nombre" value="" id="nom"/>
			<label class="error" id="errorNombre"></label> </br></br>
			
			<label for="ape">Apellido:</label>
			<input type="text" name="apellido" value="" id="ape"/>
			<label class="error" id="errorApellido"></label></br></br>
			
			<label for="mail">Email:</label>
			<input type="text" name="email" value="" id="mail"/>
			<label class="error" id="errorMail"></label></br></br>
			
			<label for="dni">DNI:</label>
			<input type="number_format" name="documento" value="" id="dni"/></br></br>

			<label for="fech">Fecha de nacimiento:</label>
			<input type="text" name="fecha" value="" id="fech"/>
			<label class="error" id="errorFecha"></label></br></br>
			
			<label for="contra">Contraseña:</label>
			<input type="password" name="contraseña" value="" id="contra"/>
			<label class="error" id="errorContraseña"></label></br></br>
			
			<label for="contra2">Repetir contraseña:</label>
			<input type="password" name="contraseña2" value="" id="contra2"/>
			<label class="error" id="errorContraseña2"></label></br></br>
			
			<input type="button" id="btnEnviar" name="btnEnviar" value="ACEPTAR" onclick="Validar();" />
		
		</form>
		
		<label class="error" id="TodoBien"> </label>
	</body>
</head>