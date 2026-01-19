<!-- ================ CRUD PARA Group ================ -->
<?php
require_once(ROOT_PATH . "/models/DatabaseConnection.php");
// ========== ELIMINAR DELETE FUNCTION GROUP ==========
function deleteMatter($conexion, $IdMateria)
{
  $stmt = $conexion->prepare("DELETE FROM mt_materias WHERE IdMateria = ?");
  $stmt->bind_param("i", $IdMateria);
  return $stmt->execute();
}
// ========== CREAR CREATE FUNCTION GROUP ==========
function createMatter($conexion, $NomMateria, $Descripcion)
{
  $creagrupo = $conexion->prepare("INSERT INTO mt_materias (NomMateria,Descripcion) VALUES (?,?)");
  $creagrupo->bind_param('ss', $NomMateria, $Descripcion);
  return $creagrupo->execute();
}
// ========== ACTUALIZAR UPDATE FUNCTION GROUP ==========
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
// ========== LEER READ FUNCTION GROUP ==========
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
// ========== BUSCAR SEARCH FUNCTION GROUP==========
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
// ========== LEER READ FUNCTION MATTER GRADE ==========
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
// ========== LEER READ FUNCTION MATTER GRADE ==========
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
// ========== LEER READ FUNCTION MATTER GRADE ==========
function searchMatter_x_Teacher($conexion, $Id_Profe)
{
  $consultaSQL = "SELECT m.IdMateria, m.NomMateria, g.NomGrado, gr.IdGrupo FROM profesor_materia_grado dmg JOIN mt_materias m ON m.IdMateria = dmg.IdMateria JOIN mt_grados g ON g.IdGrado = dmg.IdGrado JOIN mt_grupos gr ON gr.IdGrupo = dmg.IdGrupo WHERE dmg.IdDocente = $Id_Profe";

  // Consulta para contar el total
  $consultaCount = "SELECT COUNT(*) AS total FROM profesor_materia_grado dmg  WHERE dmg.IdDocente = $Id_Profe";

  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultCount = mysqli_query($conexion, $consultaCount);
  $datos = mysqli_fetch_assoc($resultCount);

  return [
    'consultar' => $consultar,
    'totalFilas' => $datos['total']
  ];
}