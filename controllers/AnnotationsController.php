<?php
/* ==========================================
   CONTROLLER: AnnotationsController.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/AnnotationsModel.php");

/* ---------- 2. ESTADO INICIAL ---------- */
$Nombre = ''; $Apellido = ''; $DescFalta = '';

/* Variables de vista */
$totalFilas = 0;

/* Variables del formulario */
$idAnot = isset($_POST['NumIdAnnotation']) ? intval($_POST['NumIdAnnotation']) : 0;
$isUpdate = $idAnot > 0;


/* ---------- 3. HELPERS ---------- */
function goToAnnotationsList()
{
  redirectTo("/views/forms/ManageAnnotations.php");
}

/* ---------- 4. ROUTING ---------- */
$method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';
//RECIBIMOS DATOS CREAR
if (isset($_POST["SendAnnotation"])) {
  $nameTeacher = $_POST["Nom_Prof"];
  $IdObs = $_POST["IdObs"];
  $tipoFalta = $_POST["tipoFalta"];
  $descripcion = $_POST["descripcion"];
}

/* ---------- 5. POST ACTIONS ---------- */
if ($method === 'POST') {

switch ($action) {
      
    /* -------- CREATE -------- */
    case 'create':
      if (createAnnotation($conexion, $nameTeacher, $IdObs, $tipoFalta, $descripcion)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente la anotacion #' . $IdObs];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdObs];
      }
      goToAnnotationsList();
      break;

    /* -------- UPDATE -------- */
    case 'update':
      $idAnot = $_POST["NumIdAnnotation"];
      if (updateAnnotation($conexion, $nameTeacher, $idAnot, $tipoFalta, $descripcion)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente la anotacion #' . $idAnot];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $idAnot];
      }
      goToAnnotationsList();
      break;

    /* -------- DELETE -------- */
    case 'delete':
      if (deleteAnnotation($conexion, $idAnot)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente la anotacion #' . $idAnot];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $idAnot];
      }
      goToAnnotationsList();
      break;

    /* -------- READ -------- */
    case 'read':
      $IdObs = $_POST["IdObs"];
      $contador = 1;
      $resultados = readAnnotation($conexion, $IdObs);
      $anotacionesConsulta = $resultados['consultar'];
      $totalFilas = $resultados['totalFilas'];
      break;
    
    /* -------- READ SPECIFY -------- */
    case 'readespecefy':
      $idAnot = $_POST["NumIdAnnotation"];
      $annotationsData = searchAnnotation($conexion, $idAnot);
      $NomProfCread = $annotationsData['NomProfCread'];
      $TipoFalta = $annotationsData['TipoFalta'];
      $DescFalta = $annotationsData['DescFalta'];
      $FecCreacion = $annotationsData['FecCreacion'];
      $NomProfModif = $annotationsData['NomProfModif'];
      $FecModif = $annotationsData['FecModif'];
      break;
  }
}