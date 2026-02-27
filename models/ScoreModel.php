<?php
/* ==========================================
   MODEL: ScoreModel.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(ROOT_PATH . "/models/DatabaseConnection.php");

/* -------- CREATE GROUP -------- */
function createScore($conexion, $IdObs, $IdMateria, $Periodo, $Nota, $Observacion)
{
  $creagrupo = $conexion->prepare("INSERT INTO mt_notas (IdObs,IdMateria,Periodo,Nota,Observacion,FechCreado) VALUES (?, ?, ?, ?, ?, NOW())");
  $creagrupo->bind_param('iisss', $IdObs, $IdMateria, $Periodo, $Nota, $Observacion);
  return $creagrupo->execute();
}

/* -------- UPDATE SCORE -------- */
function updateScore($conexion, $IdNota, $Periodo, $Observacion,$Nota)
{
  if ($Periodo === "mantener") {
    $Periodo = $_POST["Periodo_Actual"];
  }
  $actScore = $conexion->prepare("UPDATE mt_notas SET  Periodo = ?, Observacion = ?, Nota = ? WHERE IdNota = ?");
  $actScore->bind_param('sssi', $Periodo, $Observacion, $Nota, $IdNota);
  return $actScore->execute();
}

/* -------- DELETE SCORE -------- */
function deleteScore($conexion, $IdNota)
{
  $stmt = $conexion->prepare("DELETE FROM mt_notas WHERE IdNota = ?");
  $stmt->bind_param("i", $IdNota);
  return $stmt->execute();
}

/* -------- READ ONE SCORE -------- */
function readScore($conexion, $IdNota)
{
  $stmt = $conexion->prepare("SELECT mn.*,o.IdGrupo,c.NomGrado,u.NumDcto,CONCAT(u.Nombre, ' ', u.Apellido) AS full_name,mm.NomMateria,mn.FechCreado,mn.FechActualizado FROM mt_notas mn
  LEFT JOIN mt_materias mm ON mm.IdMateria = mn.IdMateria LEFT JOIN observador o ON o.IdObs = mn.IdObs LEFT JOIN mt_grados c ON o.IdGrado = c.IdGrado LEFT JOIN mt_grupos g ON g.IdGrupo = o.IdGrupo LEFT JOIN usuarios u ON u.IdUser = o.IdUser WHERE mn.IdNota= ?");
  $stmt->bind_param('i', $IdNota);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  } else {
    return null;
  }
}
/* -------- READ SCORE BY FILTER -------- */
function searchScore($conexion, $dni = null)
{
  // Inicializa la variable de consulta con la búsqueda de todos
  $consultaSQL = "SELECT mn.*,o.IdGrupo,c.NomGrado,u.NumDcto,u.Nombre,u.Apellido,mm.NomMateria FROM mt_notas mn 
  LEFT JOIN mt_materias mm ON mm.IdMateria = mn.IdMateria LEFT JOIN observador o ON o.IdObs = mn.IdObs LEFT JOIN mt_grados c ON o.IdGrado = c.IdGrado LEFT JOIN mt_grupos g ON g.IdGrupo = o.IdGrupo LEFT JOIN usuarios u ON u.IdUser = o.IdUser";

  $conditions = []; // Aquí guardamos los filtros dinámicos

  // Filtros dinámicos
  if (!empty($_GET['DNI'])) {
    $dni = mysqli_real_escape_string($conexion, $_GET['DNI']);
    $conditions[] = "u.NumDcto LIKE '%$dni%'";
  }
  if (!empty($_GET['Nombre'])) {
    $Nombre = mysqli_real_escape_string($conexion, $_GET['Nombre']);
    $conditions[] = "u.Nombre LIKE '%$Nombre%'";
  }
  if (!empty($_GET['Apellido'])) {
    $Apellido = mysqli_real_escape_string($conexion, $_GET['Apellido']);
    $conditions[] = "u.Apellido LIKE '%$Apellido%'";
  }
  if (!empty($_GET['Materia'])) {
    $Materia = (int) $_GET['Materia']; // entero, no hace falta escapar
    $conditions[] = "mm.IdMateria = '$Materia'";
  }
  if (!empty($_GET['Grado'])) {
    $Grado = (int) $_GET['Grado']; // entero, no hace falta escapar
    $conditions[] = "c.IdGrado = $Grado";
  }
  if (!empty($_GET['Grupo'])) {
    $Grupo = (int) $_GET['Grupo']; // entero, no hace falta escapar
    $conditions[] = "g.IdGrupo = $Grupo";
  }
  if (!empty($conditions)) {
    $whereSQL = " WHERE " . implode(" AND ", $conditions);
    $consultaSQL .= $whereSQL;
  } else {
    $whereSQL = ""; // Para reutilizar en el COUNT
  }
  // Consulta para contar el total
  $consultaCount = "SELECT COUNT(*) AS total
  FROM mt_notas mn LEFT JOIN mt_materias mm ON mm.IdMateria = mn.IdMateria LEFT JOIN observador o ON o.IdObs = mn.IdObs LEFT JOIN mt_grados c ON o.IdGrado = c.IdGrado LEFT JOIN mt_grupos g ON g.IdGrupo = o.IdGrupo LEFT JOIN usuarios u ON u.IdUser = o.IdUser
  $whereSQL";
  // Realiza la consulta
  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultCount = mysqli_query($conexion, $consultaCount);
  $datos = mysqli_fetch_assoc($resultCount);
  // Retorna las variables como un array
  return ['consultar' => $consultar, 'totalFilas' => $datos['total']];
}

/* -------- READ ALL SCORE HISTORY -------- */
function viewHistory($conexion, $IdObs)
{
  // Inicializa la variable de consulta con la búsqueda de todos los profesores
  $consultaSQL = "SELECT * from mt_notas WHERE IdObs= ?";
  // Consulta para contar el total
  $sqlCount = "SELECT COUNT(*) AS total FROM mt_notas WHERE IdObs= ?";

  $stmt = $conexion->prepare($consultaSQL);
  $stmt->bind_param("i", $IdObs);
  $stmt->execute();
  $result = $stmt->get_result();

  $stmtCount = $conexion->prepare($sqlCount);
  $stmtCount->bind_param("i", $IdObs);
  $stmtCount->execute();
  $total = $stmtCount->get_result()->fetch_assoc()['total'];

  // Retorna las variables como un array
    return [
      'notasEstudiante' => $result,
      'totalFilas' => $total
    ];
}