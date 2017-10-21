<title>Prueba TIC 2do Trimestre</title>
<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<?php
		require("Dao/ProductoDao.php");
		$lista = ProductoDao::Listar();
		$html = "<table><tr><th>Codigo</th><th>Nombre</th></tr>";
		// output data of each row
		foreach ($lista as $valor){
			$html .=  "<tr><td>".$valor->Codigo."</td><td>".$valor->Nombre."</td><td><button onclick='Editar(".$valor->Id.");'>Editar</button> </td><td><button onclick='Borrar(".$valor->Id.");'>Borrar</button></td></tr>";
		}
		$html .= "</table>";
		echo $html;
?>
<a href="Productos-form.php">Crear</a>
<script>
	function Editar(id){
		window.location='Productos-form.php?id='+id;
	}
	function Borrar(id){
		$.ajax({
			url : 'Eliminar.php',
			type : 'POST',
			data: "id="+id, // Adjuntar los campos del formulario enviado.
			success : function() {
				window.location.reload(false);
			},
			error : function(xhr, status) {
				alert('Disculpe, existió un problema');
			},
		});
	}


</script>
