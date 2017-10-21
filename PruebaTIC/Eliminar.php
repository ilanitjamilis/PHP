<?php
require("Dao/ProductoDao.php");
$Id = (isset($_POST['id']) ? $_POST['id'] : '');
ProductoDao::Eliminar($Id);
?>
