<!-- ================ CRUD PARA Group ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/ScoreModel.php");
// Inicializar variables con valores por defecto
$IdNota = ''; $NomGrado = ''; $Descripcion = ''; $IdGrado = ''; $NomMateria = '';
// Recolecion ID
$IdNota = intval($_POST['NumeroModificar'] ?? $_POST['IdGrado'] ?? 0);
// $IdNota = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdNota > 0;
// Consulta para Tipo de Sangre, mt_grados,MatterxGrade
$mt_grados = "SELECT * FROM mt_grados";
$mt_grados = mysqli_query($conexion, $mt_grados) or die(mysqli_error($conexion));
$mt_grupos = "SELECT * FROM mt_grupos";
$mt_grupos = mysqli_query($conexion, $mt_grupos) or die(mysqli_error($conexion));
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
  $IdNota = $_POST['IdNota'] ?? $_POST['IdNota_Actual'];
  $NomMateria = $_POST['NomMateria'];
  $Descripcion = $_POST['Descripcion'];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? [];

  switch ($action) {
    case 'deleteMatter':
      if (deleteMatter($conexion, $IdNota)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente la Materia #' . $IdNota];
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
      if (updateMatter($conexion, $IdNota, $NomMateria, $Descripcion)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente la Materia #' . $IdNota];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdGrupo];
      }
      goToMatterList();
      break;
    case 'readMatter':
      $groupData = readMatter($conexion, $IdNota);
      $IdNota = $groupData['IdNota'];
      $NomMateria = $groupData['NomMateria'];
      $Descripcion = $groupData['Descripcion'];
      break;
  }
  // ========== SHOW ALL DATA ==========
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {//CONSULTA TODO GROUP
  $resultados = searchScore($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}