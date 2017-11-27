<?php

  session_start();
  if(isset($_SESSION['usuarioLogueado'])){
    header("Location:backend.php?usuarioUsuario=".$_SESSION['nombreUsuario']);
  }

?>
