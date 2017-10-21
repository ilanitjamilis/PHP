<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . '/tp8/dao/personaDao.php');
$personaDao = new personaDao(); //porque pusimos cosas importantes en el constructor

$id = (isset($_POST["data"]) ? $_POST["data"] : "");
if (!isset($_POST["data"])) {
    $resultado = personaDao::traerPersonas();
} else {
    $resultado = personaDao::traerPersona($id);
}
echo $resultado;