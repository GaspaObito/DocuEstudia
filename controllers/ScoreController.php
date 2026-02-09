<?php
/* ==========================================
   CONTROLLER: ScoreController.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/ScoreModel.php");
require_once(ROOT_PATH . "/models/CommonModel.php");

/* ---------- 2. ESTADO INICIAL ---------- */
$IdNota = ''; $NomGrado = ''; $Descripcion = ''; $IdGrado = ''; $NomMateria = ''; $Observacion = '';$isUpdate = 0;

/* Variables del formulario */
$IdNota = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
if (isset($_POST['NumIdScore']) ) {
  $IdNota = isset($_POST['NumIdScore']) ? intval($_POST['NumIdScore']) : 0;
  $isUpdate = $IdNota > 0;
}

/* ---------- 3. HELPERS ---------- */
function goToScoreList()
{
  if ($_SESSION['IdRol'] == 2) { // Profesor
    redirectTo("/views/score/ScoreHistory.php");
  } else { // Admin
    redirectTo("/views/score/MtScore.php?action=listar");
  }
}

/* ---------- 4. ROUTING ---------- */
$method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["EnviarScore"])) {
  $IdObs = $_POST['IdObs'];
  $IdNota = $_POST['IdNota'] ?? $_POST['IdNota_Actual'];
  $IdMateria = $_SESSION['IdMateria'];
  $Periodo = $_POST['Periodo'];
  $Observacion = $_POST['Observacion'];
  $Nota = $_POST['Nota'];
}

/* ---------- 5. POST ACTIONS ---------- */
if ($method === 'POST') {

  switch ($action) {

    /* -------- CREATE -------- */
    case 'createScore':
      if (createScore($conexion, $IdObs, $IdMateria, $Periodo, $Nota, $Observacion)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente la Nota #' . $IdObs];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdObs];
      }
      goToScoreList();
      break;
      
    /* -------- UPDATE -------- */
    case 'updateScore':
      if (updateScore($conexion, $IdNota, $Periodo, $Observacion,$Nota)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente la Nota #' . $IdNota];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToScoreList();
      break;

    /* -------- DELETE -------- */
    case 'deleteScore':
      if (deleteScore($conexion, $IdNota)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente la Nota #' . $IdNota];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdNota];
      }
      goToScoreList();
      break;

    /* -------- READ -------- */
    case 'readScore':
      $groupData = readScore($conexion, $IdNota);
      $IdNota = $groupData['IdNota'];
      $IdObs = $groupData['IdObs'];
      $full_name = $groupData['full_name'];
      $NomMateria = $groupData['NomMateria'];
      $Periodo = $groupData['Periodo'];
      $Nota = $groupData['Nota'];
      $Observacion = $groupData['Observacion'];
      $FechCreado = $groupData['FechCreado'];
      $FechActualizado = $groupData['FechActualizado'];
      break;

    /* -------- READ HISTORY -------- */
    case 'viewHistory': //History Annotations
      $IdObs = $_POST["IdObs"];
      $resultados = viewHistory($conexion, $IdObs);
      $ScoreHistory = $resultados['notasEstudiante'];
      $totalFilas = $resultados['totalFilas'];
    break;
  }
} 

/* ---------- 6. GET ACTIONS ---------- */
elseif ($method === 'GET' && $action === 'listar') {
  $resultados = searchScore($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}