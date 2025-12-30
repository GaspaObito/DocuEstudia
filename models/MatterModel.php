<!-- ================ CRUD PARA Group ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/DatabaseConnection.php");
// Inicializar variables con valores por defecto
$IdMateria = ''; $NomGrado = ''; $Descripcion = '';
// Recolecion ID
$IdMateria = intval($_POST['NumeroModificar'] ?? $_POST['IdGrado'] ?? 0);
// $IdMateria = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdMateria > 0;
// Consulta para Tipo de Sangre, mt_grados,MatterxGrade
$mt_grados = "SELECT * FROM mt_grados";
$mt_grados = mysqli_query($conexion, $mt_grados) or die(mysqli_error($conexion));
$mt_grupos = "SELECT * FROM mt_grupos";
$mt_grupos = mysqli_query($conexion, $mt_grupos) or die(mysqli_error($conexion));
$mt_profesores = "SELECT *,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto FROM profesor pr LEFT JOIN usuarios us ON us.IdUser = pr.IdUser  ";
$mt_profesores = mysqli_query($conexion, $mt_profesores) or die(mysqli_error($conexion));
$mt_materias = "SELECT * FROM mt_materias";
$mt_materias = mysqli_query($conexion, $mt_materias) or die(mysqli_error($conexion));
function redirectTo($path){
  echo "<script>location.href='" . BASE_URL . "$path'</script>";
  exit;
}
function goToMatterList(){
  redirectTo("/views/matter/MtMatter.php?action=listarMATTER");
}
function goToMatterxGradeList(){
  redirectTo("/views/matter/MatterXGrade.php");
}
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["EnviarGrade"])) {
  $IdMateria = $_POST['IdMateria']?? $_POST['IdMateria_Actual'];
  $NomMateria = $_POST['NomMateria'];
  $Descripcion = $_POST['Descripcion'];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action']?? [];

  switch ($action) {
    case 'deleteMatter':
      deleteMatter($conexion,$IdMateria);
      break;
    case 'createMatter':
      createMatter($conexion,$NomMateria,$Descripcion);
      break;
    case 'updateMatter':
      updateMatter($conexion,$IdMateria,$NomMateria,$Descripcion);
      break;
    case 'readMatter':
      $groupData = readMatter($conexion, $IdMateria);
      $IdMateria = $groupData['IdMateria'];$NomMateria = $groupData['NomMateria'];$Descripcion = $groupData['Descripcion'];
      break;
    case 'readMatterXGrade':
      $MatterxGradeData = readMatterXGrade($conexion, $IdMateria);
    if ($MatterxGradeData) {
        $IdGrado  = $MatterxGradeData['IdGrado'];
        $NomGrado = $MatterxGradeData['NomGrado'];
    } else {
        $IdGrado = $IdMateria; // el grado consultado
        $NomGrado = 'SIN MATERIAS ASIGNADAS';
        $materiasAsignadas = []; // importante
        $_SESSION['alerts'][] = ['type' => 'danger','text' => 'Este grado no tiene materias asignadas'];
    }
      $resultados = searchMatter($conexion,$IdGrado);
      $materiasAsignadas = $resultados['materiasAsignadas'];
      break;
    case 'AsigMultipleMatter':
      $materias = $_POST['FornIdMateria'] ?? [];
      AsigMultipleMatter($conexion,$materias,$IdMateria);
      break;
  }
// ========== SHOW ALL DATA ==========
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($action = $_GET['action'] ?? '') === 'listarMATTER') {//CONSULTA TODO GROUP
  $resultados = searchMatter($conexion,$IdGrado);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}
// ========== ELIMINAR DELETE FUNCTION GROUP ==========
function deleteMatter($conexion, $IdMateria)
{
  mysqli_query($conexion, "delete from mt_materias where IdMateria='$IdMateria'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
  mysqli_close($conexion);
  echo "<script>alert('SE ELIMINO CORRECTAMENTE')</script>";
  goToMatterList();
}
// ========== CREAR CREATE FUNCTION GROUP ==========
function createMatter($conexion,$NomMateria, $Descripcion)
{
  $creagrupo = $conexion->prepare("INSERT INTO mt_materias (NomMateria,Descripcion) VALUES (?,?)");
  $creagrupo->bind_param('ss', $NomMateria, $Descripcion);
  $creagrupo->execute();
  $creagrupo->close();
  echo "<script>alert('LOS REGISTROS SE INSERTARON CORRECTAMENTE')</script>";
  goToMatterList();
}
// ========== ACTUALIZAR UPDATE FUNCTION GROUP ==========
function updateMatter($conexion, $IdMateria,$NomMateria,$Descripcion)
{
  if ($IdMateria === "mantener") {
    $IdMateria = $_POST["IdMateria_Actual"];
  }
  // 1. Actualizar tabla usuarios 
  $actgrupo = $conexion->prepare("UPDATE mt_materias SET  NomMateria = ?, Descripcion = ? WHERE IdMateria = ?");
  $actgrupo->bind_param('ssi', $NomMateria, $Descripcion, $IdMateria);
  $actgrupo->execute();
  $actgrupo->close();
  echo "<script>alert('SE ACTUALIZARON CORRECTAMENTE " . $IdMateria . "');</script>";
  goToMatterList();
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
function searchMatter($conexion,$IdGrado)
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
  };
  
}
// ========== LEER READ FUNCTION MATTER GRADE ==========
function AsigMultipleMatter($conexion,$materias,$IdMateria)
{
  $stmt = $conexion->prepare("DELETE FROM materias_x_grado WHERE IdGrado = ?");
  $stmt->bind_param("i", $IdMateria);
  $stmt->execute();
  
  $stmt = $conexion->prepare("INSERT INTO materias_x_grado (IdGrado, IdMateria) VALUES (?, ?)");

  foreach ($materias as $materia) {
      $materia = intval($materia);
      $stmt->bind_param("ii", $IdMateria, $materia);
      $stmt->execute();
  }
  $_SESSION['alerts'][] = ['type' => 'success','text' => 'Se actualizo Correctamente #'.$IdMateria];
  goToMatterxGradeList();
}