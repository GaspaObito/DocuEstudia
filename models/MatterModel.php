<?php
/* ==========================================
   MODEL: MatterModel.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(ROOT_PATH . "/models/DatabaseConnection.php");

/* -------- CREATE MATTER -------- */
function createMatter($conexion, $NomMateria, $Descripcion)
{
  $creagrupo = $conexion->prepare("INSERT INTO mt_materias (NomMateria,Descripcion) VALUES (?,?)");
  $creagrupo->bind_param('ss', $NomMateria, $Descripcion);
  return $creagrupo->execute();
}

/* -------- UPDATE MATTER -------- */
function updateMatter($conexion, $IdMateria, $NomMateria, $Descripcion)
{
  if ($IdMateria === "mantener") {
    $IdMateria = $_POST["IdMateria_Actual"];
  }
  // 1. Actualizar tabla usuarios 
  $actgrupo = $conexion->prepare("UPDATE mt_materias SET  NomMateria = ?, Descripcion = ? WHERE IdMateria = ?");
  $actgrupo->bind_param('ssi', $NomMateria, $Descripcion, $IdMateria);
  return $actgrupo->execute();
}

/* -------- DELETE MATTER -------- */
function deleteMatter($conexion, $IdMateria)
{
  $stmt = $conexion->prepare("DELETE FROM mt_materias WHERE IdMateria = ?");
  $stmt->bind_param("i", $IdMateria);
  return $stmt->execute();
}

/* -------- READ ONE MATTER -------- */
function readMatter($conexion, $IdMateria)
{
  $stmt = $conexion->prepare("SELECT * FROM mt_materias WHERE IdMateria = ?");
  $stmt->bind_param('i', $IdMateria);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  } else {
    return null;
  }
}
/* -------- READ ALL MATTER -------- */
function searchMatter($conexion, $IdGrado)
{
  $consultaSQL = "SELECT * FROM mt_materias";

  // Consulta para contar el total
  $consultaCount = "SELECT COUNT(*) AS total FROM mt_materias mm";

  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultCount = mysqli_query($conexion, $consultaCount);
  $datos = mysqli_fetch_assoc($resultCount);
  // Consulta Materias x Grado 
  $materiasAsignadas = [];

  if ($IdGrado > 0) {
    $sqlAsignadas = "SELECT IdMateria FROM materias_x_grado WHERE IdGrado = $IdGrado";
    $resAsignadas = mysqli_query($conexion, $sqlAsignadas);
    while ($fila = mysqli_fetch_assoc($resAsignadas)) {
      $materiasAsignadas[] = $fila['IdMateria'];
    }
  }

  return [
    'consultar' => $consultar,
    'totalFilas' => $datos['total'],
    'materiasAsignadas' => $materiasAsignadas
  ];
}
/* -------- READ ONE MATTERxGRADE -------- */
function readMatterXGrade($conexion, $IdMateria)
{
  $stmt = $conexion->prepare("SELECT mg.*,mm.NomGrado FROM materias_x_grado mg
  LEFT JOIN mt_grados mm ON mm.IdGrado = mg.IdGrado WHERE mg.IdGrado = ?");
  $stmt->bind_param('i', $IdMateria);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  } else {
    return null;
  }
}

/* -------- READ ALL MATTERxGRADE FOR TEACHER -------- */
function searchMatter_x_Teacher($conexion, $Id_Profe)
{
  $consultaSQL = "SELECT m.IdMateria, m.NomMateria, g.NomGrado, gr.IdGrupo,dmg.IdGrado FROM profesor_materia_grado dmg JOIN mt_materias m ON m.IdMateria = dmg.IdMateria JOIN mt_grados g ON g.IdGrado = dmg.IdGrado JOIN mt_grupos gr ON gr.IdGrupo = dmg.IdGrupo WHERE dmg.IdUser = $Id_Profe";

  // Consulta para contar el total
  $consultaCount = "SELECT COUNT(*) AS total FROM profesor_materia_grado dmg  WHERE dmg.IdUser = $Id_Profe";

  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultCount = mysqli_query($conexion, $consultaCount);
  $datos = mysqli_fetch_assoc($resultCount);

  return [
    'consultar' => $consultar,
    'totalFilas' => $datos['total']
  ];
}

/* -------- CHECKBOX ALL MATTERxGRADE -------- */
function AsigMultipleMatter($conexion, $materias, $IdGrado)
{
  try {
    // Eliminar asignaciones previas
    $stmt = $conexion->prepare("DELETE FROM materias_x_grado WHERE IdGrado = ?");
    if (!$stmt) return false;
    $stmt->bind_param("i", $IdGrado);
    if (!$stmt->execute()) return false;

    // Insertar nuevas materias
    $stmt = $conexion->prepare(
      "INSERT INTO materias_x_grado (IdGrado, IdMateria) VALUES (?, ?)"
    );
    if (!$stmt) return false;

    foreach ($materias as $materia) {
      $materia = intval($materia);
      $stmt->bind_param("ii", $IdGrado, $materia);
      if (!$stmt->execute()) return false;
    }

    return true; // TODO OK
  } catch (Exception $e) {
    return false;
  }
}