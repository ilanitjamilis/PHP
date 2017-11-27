<?php
  session_start();
  unset($_SESSION['usuarioLogueado']);
  header("Location:login.php");
?>
