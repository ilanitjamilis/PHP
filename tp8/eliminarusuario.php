<?php
    include_once ($_SERVER["DOCUMENT_ROOT"] . '/tp8/dao/personaDao.php');
    $personaDao = new personaDao(); //porque pusimos cosas importantes en el constructor
    
    $idPersonas = (isset($_POST["data"]) ? $_POST["data"] : "");
    personaDao::eliminarPersona($idPersonas);