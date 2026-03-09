<?php
/* ==========================================
   MODEL: Group_GradeModel.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(ROOT_PATH . "/models/DatabaseConnection.php");

/* -------- CREATE GROUP -------- */
function createGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo)
{
  $creagrupo = $conexion->prepare("INSERT INTO mt_grupos (IdGrupo,IdGrado,IdProf,NomGrupo) VALUES (?,?,?,?)");
  $creagrupo->bind_param('isss', $IdGrupo, $IdGrado, $IdProf, $NomGrupo);
  return $creagrupo->execute();
}

/* -------- UPDATE GROUP -------- */
function updateGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo)
{
  if ($IdGrado === "mantener") {
    $IdGrado = $_POST["IdGrado_Actual"];
  } elseif ($IdGrado === "quitar") {
    $IdGrado = null;
  }
if ($IdProf === "mantener") {
    // Si viene vacío, lo dejamos en null
    $IdProf = !empty($_POST["IdProf_Actual"]) ? $_POST["IdProf_Actual"] : null;
} elseif ($IdProf === "quitar") {
    $IdProf = null;
}

  // 1. Actualizar tabla usuarios 
  $actgrupo = $conexion->prepare("UPDATE mt_grupos SET  IdGrado = ?, IdProf = ?, NomGrupo = ? WHERE IdGrupo = ?");
  $actgrupo->bind_param('iisi', $IdGrado, $IdProf, $NomGrupo, $IdGrupo);
  return $actgrupo->execute();
}

/* -------- DELETE GROUP -------- */
function deleteGroup($conexion, $IdGrupo)
{
  $stmt = $conexion->prepare("DELETE FROM mt_grupos WHERE IdGrupo = ?");
  $stmt->bind_param("i", $IdGrupo);
  return $stmt->execute();
}

/* -------- READ ONE GROUP -------- */
function readGroup($conexion, $IdGrupo)
{
  $stmt = $conexion->prepare("SELECT mt.IdGrupo,mt.IdGrado,mt.IdProf,mg.NomGrado,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto,mt.NomGrupo FROM mt_grupos mt
  LEFT JOIN mt_grados mg ON mt.IdGrado = mg.IdGrado LEFT JOIN profesor pr ON pr.IdProf = mt.IdProf LEFT JOIN usuarios us ON us.IdUser = pr.IdUser  
  WHERE mt.IdGrupo = ?");
  $stmt->bind_param('i', $IdGrupo);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  } else {
    return null;
  }
}

/* -------- READ ALL GROUP -------- */
function searchGroup($conexion)
{
  $consultaSQL = "SELECT mt.IdGrupo,mg.NomGrado,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto,mt.NomGrupo FROM mt_grupos mt
  LEFT JOIN mt_grados mg ON mt.IdGrado = mg.IdGrado LEFT JOIN profesor pr ON pr.IdProf = mt.IdProf LEFT JOIN usuarios us ON us.IdUser = pr.IdUser";
  // Consulta para contar el total
  $consultaCount = "SELECT COUNT(*) AS total FROM mt_grupos mg";
  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultCount = mysqli_query($conexion, $consultaCount);
  $datos = mysqli_fetch_assoc($resultCount);
  return [
    'consultar' => $consultar,
    'totalFilas' => $datos['total']
  ];
}

/* -------- CREATE GRADE -------- */
function createGrade($conexion, $IdGrado, $NomGrado)
{
  $creargrado = $conexion->prepare("INSERT INTO mt_grados (IdGrado,NomGrado) VALUES (?,?)");
  $creargrado->bind_param('is', $IdGrado, $NomGrado);
  return $creargrado->execute();
}

/* -------- UPDATE GRADE -------- */
function updateGrade($conexion, $IdGrado, $NomGrado)
{
  $actgrado = $conexion->prepare("UPDATE mt_grados SET  NomGrado = ? WHERE IdGrado = ?");
  $actgrado->bind_param('si', $NomGrado, $IdGrado);
  return $actgrado->execute();
}

/* -------- DELETE GRADE -------- */
function deleteGrade($conexion, $IdGrado)
{
  $stmt = $conexion->prepare("DELETE FROM mt_grados WHERE IdGrado = ?");
  $stmt->bind_param("i", $IdGrado);
  return $stmt->execute();
}

/* -------- READ ONE GRADE -------- */
function readGrade($conexion, $IdGrado)
{
  $stmt = $conexion->prepare("SELECT * FROM mt_grados mt WHERE mt.IdGrado = ?");
  $stmt->bind_param('i', $IdGrado);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  } else {
    return null;
  }
}
/* -------- READ ALL GRADE -------- */
function searchGrades($conexion)
{
  $consultaSQL = "SELECT * FROM mt_grados";
  // Consulta para contar el total
  $consultaCount = "SELECT COUNT(*) AS total FROM mt_grados";

  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultCount = mysqli_query($conexion, $consultaCount);
  $datos = mysqli_fetch_assoc($resultCount);

  return [
    'consultar' => $consultar,
    'totalFilas' => $datos['total']
  ];
}