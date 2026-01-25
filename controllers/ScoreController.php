<!-- ================ CRUD PARA Group ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/ScoreModel.php");
// Inicializar variables con valores por defecto
$IdNota = ''; $NomGrado = ''; $Descripcion = ''; $IdGrado = ''; $NomMateria = ''; $Observacion = '';
// Recolecion ID
$IdNota = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdNota > 0;
// Consulta para Tipo de Sangre, mt_grados,MatterxGrade
$mt_grados = "SELECT * FROM mt_grados";
$mt_grados = mysqli_query($conexion, $mt_grados) or die(mysqli_error($conexion));
$mt_grupos = "SELECT * FROM mt_grupos";
$mt_grupos = mysqli_query($conexion, $mt_grupos) or die(mysqli_error($conexion));
$mt_materias = "SELECT * FROM mt_materias";
$mt_materias = mysqli_query($conexion, $mt_materias) or die(mysqli_error($conexion));
function goToScoreList()
{
  redirectTo("/views/score/MtScore.php?action=listar");
}
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["EnviarScore"])) {
  $IdObs = $_POST['IdObs'];
  $IdNota = $_POST['IdNota'] ?? $_POST['IdNota_Actual'];
  $IdMateria = $_SESSION['IdMateria'];
  $Periodo = $_POST['Periodo'];
  $Observacion = $_POST['Observacion'];
  $Nota = $_POST['Nota'];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? [];

  switch ($action) {
    case 'deleteScore':
      if (deleteScore($conexion, $IdNota)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente la Nota #' . $IdNota];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdNota];
      }
      goToScoreList();
      break;
    case 'createScore':
      if (createScore($conexion, $IdObs, $IdMateria, $Periodo, $Nota, $Observacion)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente la Nota #' . $IdMateria];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdMateria];
      }
      // goToScoreList();
      break;
    case 'updateScore':
      if (updateScore($conexion, $IdNota, $Periodo, $Observacion,$Nota)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente la Nota #' . $IdNota];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToScoreList();
      break;
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
  }
  // ========== SHOW ALL DATA ==========
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($action = $_GET['action'] ?? '') === 'listar')  {//CONSULTA TODO GROUP
  $resultados = searchScore($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}