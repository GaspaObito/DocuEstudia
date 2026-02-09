<?php
/* ==========================================
   CONTROLLER: Group_GradeController.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/Group_GradeModel.php");
require_once(ROOT_PATH . "/models/CommonModel.php");

/* ---------- 2. ESTADO INICIAL ---------- */
$IdGrupo = ''; $IdGrado = ''; $IdProf = ''; $NomGrupo = ''; $NomGrado = ''; $IdMateria = '';

/* Variables de vista */
$consultar = [];
$totalFilas = 0;

/* Variables del formulario */
$IdGrupo = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdGrupo > 0;
$IdGrado = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdGrado > 0;


/* ---------- 3. HELPERS ---------- */
function goToGroupList()
{
  redirectTo("/views/subject/MtGroups.php?action=listarGRPS");
}
function goToGradeList()
{
  redirectTo("/views/subject/MtGrades.php?action=listarGRDS");
}

/* ---------- 4. ROUTING ---------- */
$method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';
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

/* ---------- 5. POST ACTIONS ---------- */
if ($method === 'POST') {

  switch ($action) {

    /* -------- CREATE -------- */
    case 'createGroup':
      if (createGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente el Grupo #' . $IdGrupo];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToGroupList();
      break;

    /* -------- UPDATE -------- */
    case 'updateGroup':
      if (updateGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente el Grupo #' . $IdGrupo];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToGroupList();
      break;

    /* -------- DELETE -------- */
    case 'deleteGroup':
      if (deleteGroup($conexion, $IdGrupo)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente el Grupo #' . $IdGrupo];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToGroupList();
      break;

    /* -------- READ -------- */
    case 'readGroup':
      $groupData = readGroup($conexion, $IdGrupo);
      $IdGrupo = $groupData['IdGrupo'];
      $IdGrado = $groupData['IdGrado'];
      $IdProf = $groupData['IdProf'];
      $NomGrado = $groupData['NomGrado'];
      $NombreCompleto = $groupData['NombreCompleto'];
      $NomGrupo = $groupData['NomGrupo'];
      break;
            
    /* -------- CREATE GRADE -------- */
    case 'createGrade':
      if (createGrade($conexion, $IdGrado, $NomGrado)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente el Grado #' . $IdGrado];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrado];
      }
      goToGradeList();
      break;

    /* -------- UPDATE GRADE -------- */
    case 'updateGrade':
      if (updateGrade($conexion, $IdGrado, $NomGrado)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente el Grado #' . $IdGrado];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrado];
      }
      goToGradeList();
      break;

    /* -------- DELETE GRADE -------- */
    case 'deleteGrade':
      if (deleteGrade($conexion, $IdGrado)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente el Grado #' . $IdGrado];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrado];
      }
      goToGradeList();
      break;

     /* -------- READ GRADE -------- */     
    case 'readGrade':
      $groupData = readGrade($conexion, $IdGrado);
      $IdGrado = $groupData['IdGrado'];
      $NomGrado = $groupData['NomGrado'];
      break;
  }
} 

/* ---------- 6. GET ACTIONS ---------- */
elseif ($method === 'GET' && $action === 'listarGRPS') {
  $resultados = searchGroup($conexion);
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $action === 'listarGRDS') {//CONSULTA TODO GRADE
  $resultados = searchGrades($conexion);
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}