<?php
/* ==========================================
   CONTROLLER: MatterController.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/MatterModel.php");
require_once(ROOT_PATH . "/models/CommonModel.php");

/* ---------- 2. ESTADO INICIAL ---------- */
$IdMateria = ''; $NomGrado = ''; $Descripcion = ''; $IdGrado = ''; $NomMateria = '';$IdGrupo = '';

/* Variables del formulario */
$IdMateria = intval($_POST['NumeroModificar'] ?? $_POST['IdGrado'] ?? 0);
$isUpdate = $IdMateria > 0;
$Id_Profe= $_SESSION['user_id'];

/* ---------- 3. HELPERS ---------- */
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

/* ---------- 4. ROUTING ---------- */
$method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';

/* ---------- 5. POST ACTIONS ---------- */
if ($method === 'POST') {

  switch ($action) {

    /* -------- CREATE -------- */
    case 'createMatter':
      if (createMatter($conexion, $NomMateria, $Descripcion)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente la Materia #' . $NomMateria];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToMatterList();
      break;

    /* -------- UPDATE -------- */
    case 'updateMatter':
      if (updateMatter($conexion, $IdMateria, $NomMateria, $Descripcion)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente la Materia #' . $IdMateria];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToMatterList();
      break;

    /* -------- DELETE -------- */
    case 'deleteMatter':
      if (deleteMatter($conexion, $IdMateria)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente la Materia #' . $IdMateria];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToMatterList();
      break;

    /* -------- READ -------- */
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
} 

/* ---------- 6. GET ACTIONS ---------- */
elseif ($method === 'GET' && $action === 'listarMATTER') {//CONSULTA TODO GROUP
  $resultados = searchMatter($conexion, $IdGrado);
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];

}  elseif ($action === 'listarMATTERxTEACHER'){
  $resultados = searchMatter_x_Teacher($conexion, $Id_Profe);
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
} 