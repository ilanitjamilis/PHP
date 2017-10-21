<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/productoDao.php');
    
    $idProducto = (isset($_POST["data"]) ? $_POST["data"] : "");
    productoDao::eliminarProducto($idProducto);