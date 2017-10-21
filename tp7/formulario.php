<html>
	<head>
		<title>TP 7</title>	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<script type="text/javascript" src="jquery-3.2.1.min.js"></script>		
	</head>
	
	<body>
		
		<?php 
			$id = (isset($_GET["idPersonas"]) ? $_GET["idPersonas"] : "caca");
		?>
		
		<script>
			var error;
			var idPersonas = "<?php echo $id; ?>";
			if(idPersonas == "caca"){
				idPersonas = "";
			}
			else{
				$.ajax({
					async:true,
					type: "POST",
					url: "traerusuarios.php",
					data:"data=" + idPersonas,
					success: function (input) {
							var respuestas = JSON.parse(input);
							var inputs = $(".pipicucu");
							var i = 0;
							for (x in respuestas[0]){
								
								inputs[i].value=(respuestas[0][x]);
								i++;
							}
						}	
					});
			}
			
			
			function Validar(){
				var labels = $(".error");
				for (x in labels){
					labels[x].innerHTML="";
				}
				
				error = false;
								
				var nombre = $("#nom").val();
				var apellido = $("#ape").val();
				var mail = $("#mail").val();

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
				
				if(error==false){
					$.ajax({
					async:true,
					type: "POST",
					url: "funciones.php",
					data:$("#formPrincipal").serialize() + "&id=" + idPersonas,
					success: function (input) {
							var respuestas = JSON.parse(input)
							var labels = $(".error");
							var i = 0;
							for (x in respuestas){
								labels[i].innerHTML=(respuestas[x]);
								i++;
							}
							if($("#TodoBien").text()=="Todo bien lince"){
								alert("Cambios guardados correctamente");
								for(i=0;i<labels.length;i++)
								{
									labels[i].innerHTML="";
								}
								window.location = 'http://localhost/tp7/';
							}
						}	
					});
				}
			}
			
			function validateEmail(email) {
			  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			  return re.test(email);
			}	
			
					
		</script>
	
		<?php //include_once ("funciones.php"); ?>
		
		<h2>Completar el siguiente formulario</h2>
		<form action="funciones.php" method="POST" id="formPrincipal"> 
		
			<label for="nom">Nombre:</label>
			<input type="text" class="pipicucu" name="nombre" value="" id="nom"/>
			<label class="error" id="errorNombre"></label> </br></br>
			
			<label for="ape">Apellido:</label>
			<input type="text" class="pipicucu" name="apellido" value="" id="ape"/>
			<label class="error" id="errorApellido"></label></br></br>
			
			<label for="mail">Email:</label>
			<input type="text" class="pipicucu" name="email" value="" id="mail"/>
			<label class="error" id="errorMail"></label></br></br>
			
			<input type="button" id="btnEnviar" name="btnEnviar" value="ACEPTAR" onclick="Validar();" />
		
		</form>
		
		<label class="error" id="TodoBien"> </label>
	</body>
</head>