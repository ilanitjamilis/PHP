

//asignacion
<?php
session_start(); //Siempre arriba de todo de la página!
$_SESSION['id'] = 10; //Asignación
$_SESSION['persona'] = new persona();
//unset($_SESSION['id']); Le saca la instancia. La deja null. La desloguea.
?>

//mostrar
<?php
session_start();
if(isset($_SESSION['id'])){
  echo 'El id en sesión es: ' . $_SESSION['id'];
}
else{
  echo 'debe iniciar sesión';
}
//unset($_SESSION['id']);
?>

//Se usan mucho las sesiones para los carritos de compras
//Acumular cosas sin guardar todavía en base de datos
//E-comerce --> en la navegación se agregan cosas a un carrito

//Al principio validar inicio de sesión
//No --> redirigir a login
//En pantalla de catálogo no importa si está logueado, entra cualquiera

//1) Hay un session_start() Siempre
//2) Estructura --> $_SESSION['nombre_variable'] = asignación
//3) Sacar la instancia, hacerla null --> unset($_SESSION['id'])

//Armar registracion.php
//Armar login.php // 2 campos --> mail y clave + botón ingresar // aparece cuando van a login.php y las que requieren seguridad si no está logueado

//Para no repetir todo hacer un include() que tenga el session_start y el if a ver si está instanciada o no.
//Si no está instanciada hacer un header.location(login.php);
//Otro include para unnset($_SESSION['id']);

//Hacer menu de backend --> productos/categorias/login
//Un solo php con el menu y hacer include en todos.
//Pasar de pagina y "Hola Ilanit" + "Cerrar Sesión

//Vamos a ver como generar un cookie
//Un check en el formulario de login guardar o no mi usuario
