<!-- ================ CRUD PARA ANNOTATION ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/AnnotationsModel.php");
// Inicializar variables con valores por defecto
$Nombre = ''; $Apellido = ''; $DescFalta = '';
// Recolecion ID Annotation 
$idAnot = isset($_POST['NumIdAnnotation']) ? intval($_POST['NumIdAnnotation']) : 0;
$isUpdate = $idAnot > 0;
function goToAnnotationsList()
{
  redirectTo("/views/forms/ManageAnnotations.php");
}
//RECIBIMOS DATOS CREAR
if (isset($_POST["SendAnnotation"])) {
  $nameTeacher = $_POST["Nom_Prof"];
  $IdObs = $_POST["IdObs"];
  $tipoFalta = $_POST["tipoFalta"];
  $descripcion = $_POST["descripcion"];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];
  if ($action === 'delete') {
    if (deleteAnnotation($conexion, $idAnot)) {
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente la anotacion #' . $idAnot];
    } else {
      $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $idAnot];
    }
    goToAnnotationsList();

  } elseif ($action === 'create') {
    if (createAnnotation($conexion, $nameTeacher, $IdObs, $tipoFalta, $descripcion)) {
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente la anotacion #' . $IdObs];
    } else {
      $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdObs];
    }
    goToAnnotationsList();

  } elseif ($action === 'update') {
    $idAnot = $_POST["NumIdAnnotation"];
    if (updateAnnotation($conexion, $nameTeacher, $idAnot, $tipoFalta, $descripcion)) {
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente la anotacion #' . $idAnot];
    } else {
      $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $idAnot];
    }
    goToAnnotationsList();
    
  } elseif ($action === 'read') { //History Annotations
    $IdObs = $_POST["IdObs"];
    $contador = 1;
    $resultados = readAnnotation($conexion, $IdObs);
    $anotacionesConsulta = $resultados['consultar'];
    $totalFilas = $resultados['totalFilas'];
    
  } elseif ($action === 'readespecefy') {
    $idAnot = $_POST["NumIdAnnotation"];
    $annotationsData = searchAnnotation($conexion, $idAnot);
    $NomProfCread = $annotationsData['NomProfCread'];
    $TipoFalta = $annotationsData['TipoFalta'];
    $DescFalta = $annotationsData['DescFalta'];
    $FecCreacion = $annotationsData['FecCreacion'];
    $NomProfModif = $annotationsData['NomProfModif'];
    $FecModif = $annotationsData['FecModif'];
  }
} 