<!-- ================ CRUD PARA Group ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/Group_GradeModel.php");
require_once(ROOT_PATH . "/models/CommonModel.php");
// Inicializar variables con valores por defecto
$IdGrupo = ''; $IdGrado = ''; $IdProf = ''; $NomGrupo = ''; $NomGrado = ''; $IdMateria = '';
// Recolecion ID
$IdGrupo = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdGrupo > 0;

$IdGrado = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdGrado > 0;

function goToGroupList()
{
  redirectTo("/views/subject/MtGroups.php?action=listarGRPS");
}
function goToGradeList()
{
  redirectTo("/views/subject/MtGrades.php?action=listarGRDS");
}
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["EnviarGrade"])) {
  $IdGrado = $_POST['IdGrado'] ?? $_POST['IdGrado_Actual'];
  $NomGrado = $_POST['NomGrado'];
}
if (isset($_POST["Enviar2"])) {
  $IdGrupo = $_POST['IdGrupo'] ?? $_POST['IdGrupo_Actual'];
  $IdGrado = $_POST['FornIdGrado'];
  $IdProf = $_POST['FornIdProf'];
  $NomGrupo = $_POST['NomGrupo'];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];

  switch ($action) {
    case 'deleteGroup':
      if (deleteGroup($conexion, $IdGrupo)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente el Grupo #' . $IdGrupo];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToGroupList();
      break;
    case 'createGroup':
      if (createGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente el Grupo #' . $IdGrupo];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToGroupList();
      break;
    case 'updateGroup':
      if (updateGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente el Grupo #' . $IdGrupo];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToGroupList();
      break;
    case 'readGroup':
      $groupData = readGroup($conexion, $IdGrupo);
      $IdGrupo = $groupData['IdGrupo'];
      $IdGrado = $groupData['IdGrado'];
      $IdProf = $groupData['IdProf'];
      $NomGrado = $groupData['NomGrado'];
      $NombreCompleto = $groupData['NombreCompleto'];
      $NomGrupo = $groupData['NomGrupo'];
      break;
    // GRADE OPTIONS
    case 'deleteGrade':
      if (deleteGrade($conexion, $IdGrado)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente el Grado #' . $IdGrado];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrado];
      }
      goToGradeList();
      break;
    case 'createGrade':
      if (createGrade($conexion, $IdGrado, $NomGrado)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente el Grado #' . $IdGrado];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrado];
      }
      goToGradeList();
      break;
    case 'updateGrade':
      if (updateGrade($conexion, $IdGrado, $NomGrado)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente el Grado #' . $IdGrado];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrado];
      }
      goToGradeList();
      break;
    case 'readGrade':
      $groupData = readGrade($conexion, $IdGrado);
      $IdGrado = $groupData['IdGrado'];
      $NomGrado = $groupData['NomGrado'];
      break;
  }
  // ========== SHOW ALL DATA ==========
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($action = $_GET['action'] ?? '') === 'listarGRPS') {//CONSULTA TODO GROUP
  $resultados = searchGroup($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($action = $_GET['action'] ?? '') === 'listarGRDS') {//CONSULTA TODO GRADE
  $resultados = searchGrades($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}