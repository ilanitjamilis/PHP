<html>
	<head>
		<title>TP 8</title>	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
	</head>

	<body>

		<script>
		traerTabla();

		function traerTabla(){
			$.ajax({
            type: "POST",
            url: "traerusuarios.php",
            success: function (respuesta)
            {
			  $("#TablaActividades").html("");
              var personas = JSON.parse(respuesta);
              var texto = "";
			  var i = 0;
              for (per in personas) {
                texto += "<tr>";
                for (prop in personas[per]) {
					if(prop == "idPersonas")
					{
						texto+="<td id = " + i + " hidden>" + personas[per][prop] + "</td>";
					}else{
						texto+="<td>" + personas[per][prop] + "</td>";
					}

                }
				texto += "<td><button onclick='modificarUsuario(" + i + ");'>Modificar</button>";
				texto += "<button onclick='eliminarUsuario(" + i + ");'>Eliminar</button></td>";
                texto +="</tr>";
				i++;
				$("#TablaActividades").html(texto);
            }
			}
		});
		}

		function irInsertarPersona(){
			window.location = 'http://localhost/tp8/formulario.php';
		}

		function modificarUsuario(pos){
			var idPersonas = $("#" + pos).text();
			window.location = 'http://localhost/tp8/formulario.php?idPersonas=' + idPersonas;
		}

		function eliminarUsuario(pos){
			var idPersonas = $("#" + pos).text();
			$.ajax({
					async:true,
					type: "POST",
					url: "eliminarusuario.php",
					data:"data=" + idPersonas,
					success: function (input) {
							traerTabla();
						}
					});
		}
		</script>

		<label>TP8 - ABM </label></br></br>

		<table border = "2">
		  <thead>
			<tr>
			  <th hidden>idPersonas</th>
			  <th width="150px">Nombre</th>
			  <th width="150px">Apellido</th>
			  <th width="150px">Email</th>
			  <th width="120px">Acciones</th>
			</tr>
		  </thead>
		  <tbody id="TablaActividades">
		  </tbody>
		</table>

		<br/><button onclick='irInsertarPersona()'>Insertar Persona</button>
	</body>
</html>
