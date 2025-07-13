<?php
/* PAGINA WEB */
include ("DatabaseConnection.php");
session_start();
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
  $sql_detalle = "UPDATE anotacion SET NomProfModif='" . $nombre . "',TipoFalta='" . $tipoFalta . "', DescFalta='" . $descripcion . "'
    WHERE IdEst=" . $Id_Anota;
  /* Validar insercion */
  $resultado = mysqli_query($conexion, $sql_detalle) or die
    ("ERROR EN LA INSERCION" . $Id_Persona);
  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE ACTUALIZARON CORRECTAMENTE')</script>";
  echo "<script>location.href = '/proyectos/DocuEstudia/controllers/teacher/AnnotationsHistory.php  '</script>";
}
?>