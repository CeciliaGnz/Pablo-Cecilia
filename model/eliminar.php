<?php
include("config.php");
$getmysql = new mysqlconex();
$getconext = $getmysql->conex();

if (isset($_POST["eliminar"])) {
    $reservaID = $_POST["id"];
    $nombreEquipo = $_POST["nombre"]; // Asegúrate de que esta columna exista en tu tabla de reserva

    $query = "DELETE FROM Reserva WHERE ReservaID=?";
    $sentencia = mysqli_prepare($getconext, $query);
    mysqli_stmt_bind_param($sentencia, "i", $reservaID);
    mysqli_stmt_execute($sentencia);
    $afectado = mysqli_stmt_affected_rows($sentencia);

    if ($afectado == 1) {
        echo "<script> alert('La reserva con ID [$reservaID] se eliminó correctamente'); location.href='../index.php'; </script>";
    } else {
        echo "<script> alert('La reserva con ID [$reservaID] no se eliminó correctamente :( '); location.href='../index.php'; </script>";
    }
}
?>
