<html>
	<head>
		<title> TP-0</title>
	</head>
	
	<body>
		<h1>Primer TP</h1>
		<p>Acá va el párrafo</p>
	</body>
	
	<table border="1">
		<tr>
			<th>Nombre</th>
			<th>Apellido</th>
		</tr>
		<?php
			for($i=0; $i<5; $i++){
		?>
		<tr>
			<td>Ilanit</td>
			<td>Jamilis</td>
		</tr>
		<?php
		}
		?>
	</table> <br/>
		
	<table border="1">
		<tr>
			<th>Nombre</th>
			<th>Apellido</th>
		</tr>
		<?php
		$nombre="Ilanit";
		$apellido="Jamilis";
			for($i=0; $i<5; $i++){
		
		echo " <tr>
			<td>$nombre</td>
			<td>$apellido</td>
		</tr>";
		}
		?>
	</table>
</html>