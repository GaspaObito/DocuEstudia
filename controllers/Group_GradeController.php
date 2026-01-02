<!-- ================ CRUD PARA Group ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(__DIR__ . "/../models/Group_GradeModel.php");
// Inicializar variables con valores por defecto
$IdGrupo = '';
$IdGrado = '';
$IdProf = '';
$NomGrupo = '';
$NomGrado = '';
// Recolecion ID
$IdGrupo = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdGrupo > 0;

$IdGrado = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdGrado > 0;
// Consulta para Tipo de Sangre y mt_grados
$mt_grados = "SELECT * FROM mt_grados";
$mt_grados = mysqli_query($conexion, $mt_grados) or die(mysqli_error($conexion));
$mt_grupos = "SELECT * FROM mt_grupos";
$mt_grupos = mysqli_query($conexion, $mt_grupos) or die(mysqli_error($conexion));
$mt_profesores = "SELECT *,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto FROM profesor pr LEFT JOIN usuarios us ON us.IdUser = pr.IdUser  ";
$mt_profesores = mysqli_query($conexion, $mt_profesores) or die(mysqli_error($conexion));
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
  ;
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
      deleteGroup($conexion, $IdGrupo);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente el Grupo #' . $IdGrupo];
      goToGroupList();
      break;
    case 'createGroup':
      createGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente el Grupo #' . $IdGrupo];
      goToGroupList();
      break;
    case 'updateGroup':
      updateGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente el Grupo #' . $IdGrupo];
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
      deleteGrade($conexion, $IdGrado);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente el Grado #' . $IdGrado];
      goToGradeList();
      break;
    case 'createGrade':
      createGrade($conexion, $IdGrado, $NomGrado);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente el Grado #' . $IdGrado];
      goToGradeList();
      break;
    case 'updateGrade':
      updateGrade($conexion, $IdGrado, $NomGrado);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente el Grado #' . $IdGrado];
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