
		<?php
			include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/productoDao.php');
			include ('header.html');
		?>

		<h2>Contacto</h2></br>

		<main>
				<div class="row">
					  <div class="container">
						<form class="formContacto">
							<div class="col-md-12 col-xs-12 col-sm-12 col-lg-6">
								<div class="form-group">
								  <input type="text" class="form-control iNombre" placeholder="Nombre">
								</div>
								<div class="form-group">
								  <input type="email" class="form-control iEmail" placeholder="Email">
								</div>
								<div class="form-group">
								  <input type="text" class="form-control iAsunto" placeholder="Asunto">
								</div>
							</div>
							<div class="col-md-12 col-xs-12 col-sm-12 col-lg-6">
								<div class="form-group">
								  <textarea type="text" class="form-control iMensaje" style="display:table-cell; height:29%" placeholder="Mensaje"></textarea>
								</div>
							</div>
							<div class="col-md-12 col-md-12 col-xs-12 col-sm-12 col-lg-12">
								<button type="submit" class="btn btn-primary btnSubmit" style="width:100%">Enviar</button>
							</div>
						</form>
					</div>
				</div>
			</main>

		<?php include ('footer.html'); ?>
