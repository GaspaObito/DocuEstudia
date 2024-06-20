<?php
include ("Conexion.php");
$NumeroEliminar = $_GET['NumeroEliminar'];
mysqli_query($conexion, "delete from observador where Id_Estudiante='$NumeroEliminar'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
/*ACTUALIZA CURSOS*/
$sql_curso = "UPDATE curso c SET Numero_Alumnos = (SELECT COUNT(*) FROM observador o 
    WHERE o.Id_Curso = c.Id_Curso)";
$resultado = mysqli_query($conexion, $sql_curso) or die
  ("ERROR EN LA INSERCION" . $Id_Persona);
/*FINALIZA ACTUALIZA CURSOS*/
mysqli_close($conexion);
echo "<script>location.href='../Profesor/anotaciones_busc.php'</script>";
?>