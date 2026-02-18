<?php
/* ==========================================
   MODEL: AnnotationsModel.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(ROOT_PATH . "/models/DatabaseConnection.php");

/* -------- CREATE -------- */
function createAnnotation($conexion, $nameTeacher, $IdObs, $tipoFalta, $descripcion)
{
  $stmt = $conexion->prepare("INSERT INTO anotacion (IdObs, NomProfCread, TipoFalta, DescFalta, FecCreacion) VALUES (?, ?, ?, ?, NOW())");
  $stmt->bind_param("isss", $IdObs, $nameTeacher, $tipoFalta, $descripcion);
  return $stmt->execute();
}

/* -------- UPDATE -------- */
function updateAnnotation($conexion, $nameTeacher, $idAnot, $tipoFalta, $descripcion)
{
  if ($tipoFalta === "mantener") {
    // El usuario ha seleccionado la opción "mantener", asignar el valor actual del campo
    $tipoFalta = $_POST["tipoFaltaActual"];
  }
  $stmt = $conexion->prepare("UPDATE anotacion SET NomProfModif = ?, TipoFalta = ?, DescFalta = ? WHERE IdAnot = ?");
  $stmt->bind_param("sssi", $nameTeacher, $tipoFalta, $descripcion, $idAnot);
  return $stmt->execute();
}

/* -------- DELETE -------- */
function deleteAnnotation($conexion, $idAnot)
{
  $stmt = $conexion->prepare("DELETE FROM anotacion WHERE IdAnot = ?");
  $stmt->bind_param("i", $idAnot);
  return $stmt->execute();
}

/* -------- READ ALL BY ID -------- */
function readAnnotation($conexion, $IdObs)
{
  // Inicializa la variable de consulta con la búsqueda de todos los profesores
  $consultaSQL = ("SELECT * from anotacion WHERE IdObs='$IdObs'") or die("ERROR AL TRAER LOS DATOS");
  $query = "SELECT COUNT(*) AS total FROM anotacion WHERE IdObs='$IdObs'";
  // Verifica si se envió el formulario de búsqueda
  if (!empty($_GET['DNI'])) {
    $Numero_Documento = $_GET['DNI'];
    $query = "SELECT COUNT(*) AS total FROM usuarios WHERE NumDcto=$Numero_Documento";
    // Modifica la consulta para filtrar por número de documento
    $consultaSQL .= " WHERE u.NumDcto='$Numero_Documento'";
  }
  // Realiza la consulta
  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultado = mysqli_query($conexion, $query);
  $datos = mysqli_fetch_assoc($resultado);
  $totalFilas = $datos['total'];
  // Retorna las variables como un array
  return ['consultar' => $consultar, 'totalFilas' => $totalFilas];
}
/* -------- READ ONE -------- */
function searchAnnotation($conexion, $idAnot)
{
  $stmt = $conexion->prepare("SELECT * FROM anotacion WHERE IdAnot = ?");
  $stmt->bind_param('i', $idAnot); // 'i' porque IdAnot es entero
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  } else {
    return null;
  }
}