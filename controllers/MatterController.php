<!-- ================ CRUD PARA Group ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/MatterModel.php");
// Inicializar variables con valores por defecto
$IdMateria = ''; $NomGrado = ''; $Descripcion = ''; $IdGrado = ''; $NomMateria = '';$IdGrupo = '';
// Recolecion ID
$IdMateria = intval($_POST['NumeroModificar'] ?? $_POST['IdGrado'] ?? 0);
// $IdMateria = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdMateria > 0;
$Id_Profe=$_SESSION['Id_Profe'];
// Consulta para Tipo de Sangre, mt_grados,MatterxGrade
$mt_grados = "SELECT * FROM mt_grados";
$mt_grados = mysqli_query($conexion, $mt_grados) or die(mysqli_error($conexion));
$mt_grupos = "SELECT * FROM mt_grupos";
$mt_grupos = mysqli_query($conexion, $mt_grupos) or die(mysqli_error($conexion));
$mt_profesores = "SELECT *,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto FROM profesor pr LEFT JOIN usuarios us ON us.IdUser = pr.IdUser  ";
$mt_profesores = mysqli_query($conexion, $mt_profesores) or die(mysqli_error($conexion));
$mt_materias = "SELECT * FROM mt_materias";
$mt_materias = mysqli_query($conexion, $mt_materias) or die(mysqli_error($conexion));

function goToMatterList()
{
  redirectTo("/views/matter/MtMatter.php?action=listarMATTER");
}
function goToMatterxGradeList()
{
  redirectTo("/views/matter/MatterXGrade.php");
}
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["EnviarGrade"])) {
  $IdMateria = $_POST['IdMateria'] ?? $_POST['IdMateria_Actual'];
  $NomMateria = $_POST['NomMateria'];
  $Descripcion = $_POST['Descripcion'];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? [];

  switch ($action) {
    case 'deleteMatter':
      if (deleteMatter($conexion, $IdMateria)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente la Materia #' . $IdMateria];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToMatterList();
      break;
    case 'createMatter':
      if (createMatter($conexion, $NomMateria, $Descripcion)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente la Materia #' . $NomMateria];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToMatterList();
      break;
    case 'updateMatter':
      if (updateMatter($conexion, $IdMateria, $NomMateria, $Descripcion)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente la Materia #' . $IdMateria];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToMatterList();
      break;
    case 'readMatter':
      $groupData = readMatter($conexion, $IdMateria);
      $IdMateria = $groupData['IdMateria'];
      $NomMateria = $groupData['NomMateria'];
      $Descripcion = $groupData['Descripcion'];
      break;
    case 'readMatterXGrade':
      $MatterxGradeData = readMatterXGrade($conexion, $IdMateria);
      if ($MatterxGradeData) {
        $IdGrado = $MatterxGradeData['IdGrado'];
        $NomGrado = $MatterxGradeData['NomGrado'];
      } else {
        $IdGrado = $IdMateria; // el grado consultado
        $NomGrado = 'SIN MATERIAS ASIGNADAS';
        $materiasAsignadas = []; // importante
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'Este grado no tiene materias asignadas'];
      }
      $resultados = searchMatter($conexion, $IdGrado);
      $materiasAsignadas = $resultados['materiasAsignadas'];
      break;
    case 'AsigMultipleMatter':
      $materias = $_POST['FornIdMateria'] ?? [];
      if (AsigMultipleMatter($conexion, $materias, $IdMateria)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se añadio Correctamente las Materias #' . $IdMateria];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #'];
      }
      goToMatterxGradeList();
      break;
  }
  // ========== SHOW ALL DATA ==========
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($action = $_GET['action'] ?? '') === 'listarMATTER') {//CONSULTA TODO GROUP
  $resultados = searchMatter($conexion, $IdGrado);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}  elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($action = $_GET['action'] ?? '') === 'listarMATTERxTEACHER'){
  $resultados = searchMatter_x_Teacher($conexion, $Id_Profe);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
} 