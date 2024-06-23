<?php
include ("Conexion.php");
$NumeroEliminar = $_GET['NumeroEliminar'];
mysqli_query($conexion, "delete from anotacion where Id_Anotacion='$NumeroEliminar'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
mysqli_close($conexion);
echo "<script>location.href='../Profesor/historial_anotaciones.php'</script>";
?>