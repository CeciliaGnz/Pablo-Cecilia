<?php
@session_start();// Comienzo de la sesión

if ($_SESSION["acceso"] != true)
{
    header('Location: ?op=error');
}

echo "Bienvenido/a: ". $_SESSION["user"];


?>