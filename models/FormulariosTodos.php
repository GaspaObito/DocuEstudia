<?php
/* PAGINA WEB */
include ("Conexion.php");
session_start();
/* R_ANOTACION */
if (isset($_POST["SendAnnotation"])) {
  $nombre = $_POST["Nom_Prof"];
  $idEstudiante = $_SESSION['Id_Session'];
  $tipoFalta = $_POST["tipoFalta"];
  $descripcion = $_POST["descripcion"];
  $sql_detalle = "INSERT INTO anotacion(Nombre_Profesor,Id_Estudiante,Tipo_Falta,Descripcion_Falta,Fecha_Creacion) VALUES(
        '" . addslashes($nombre) . "','" . addslashes($idEstudiante) . "','" . addslashes($tipoFalta) . "','" . addslashes($descripcion) . "',NOW())";
  /* Validar insercion */
  $resultado = mysqli_query($conexion, $sql_detalle) or die
    ("ERROR EN LA INSERCION" . $Id_Persona);
  mysqli_close($conexion);
  echo "<script>alert('LA ANOTACION SE INSERTO CORRECTAMENTE')</script>";
  echo "<script>location.href = '../Profesor/anotaciones.php'</script>";
}
/* R_DESCRIP_ANOTACION */
if (isset($_POST["Enviar6"])) {
  $nombre = $_SESSION['NombreProfe'];
  $Id_Anota = $_POST["NumeroModificar"];
  $tipoFalta = $_POST["TipoFalta"];
  if ($tipoFalta === "mantener") {
    // El usuario ha seleccionado la opción "mantener", asignar el valor actual del campo
    $tipoFalta = $_POST["tipoFaltaActual"];
  }
  $descripcion = $_POST["descripcion"];
  $sql_detalle = "UPDATE anotacion SET Nombre_Profesor_Modif='" . $nombre . "',Tipo_Falta='" . $tipoFalta . "', Descripcion_Falta='" . $descripcion . "'
    WHERE Id_Anotacion=" . $Id_Anota;
  /* Validar insercion */
  $resultado = mysqli_query($conexion, $sql_detalle) or die
    ("ERROR EN LA INSERCION" . $Id_Persona);
  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE ACTUALIZARON CORRECTAMENTE')</script>";
  echo "<script>location.href = '../Profesor/historial_anotaciones.php'</script>";
}
?>