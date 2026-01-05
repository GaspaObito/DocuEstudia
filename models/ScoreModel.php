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
