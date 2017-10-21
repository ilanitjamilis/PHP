<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . '/TPFINAL/dao/categoriaDao.php');
    
    $idCategoria = (isset($_POST["data"]) ? $_POST["data"] : "");
    categoriaDao::eliminarCategoria($idCategoria);