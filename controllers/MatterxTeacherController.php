<!-- ================ CRUD PARA TEACHER ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/TeacherModel.php");
require_once(ROOT_PATH . "/models/CommonModel.php");

$IdMateriasProf = isset($_POST['MateriasxProf']) ? intval($_POST['MateriasxProf']) : 0;
$isUpdateMateriasProf = $IdMateriasProf > 0;
function goToMtMatterxTeacherList()
{
  redirectTo("/views/admin/MtMatterxTeacher.php?action=listarMATTERxTEACHER");
}
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["EnviarMatterxTeacher"])) {
  $IdMateriasProf = $_POST['IdMateriasProf_Actual'];
  $IdUser = $_POST['FornIdUser'];
  $IdMateria = $_POST['FornIdMateria'];
  $IdGrado = $_POST['FornIdGrado'];
  $IdGrupo = $_POST['FornIdGrupo'];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];
  switch ($action) {
    // CREA MAESTRO ASIGNACION DE MATERIAS -----------------------
    case 'readMatterxTeacher':
      $profesorData2 = readMatterxTeacher($conexion, $IdMateriasProf);
      $IdUser = $profesorData2['IdUser'];
      $IdMateriasProf = $profesorData2['IdMateriasProf'];
      $IdMateria = $profesorData2['IdMateria'];
      $IdGrado = $profesorData2['IdGrado'];
      $IdGrupo = $profesorData2['IdGrupo'];
      $NombreCompleto = $profesorData2['NombreCompleto'];
      $NomMateria = $profesorData2['NomMateria'];
      $NomGrado = $profesorData2['NomGrado'];
      break;

    case 'updateMatterxTeacher':
      updateMatterxTeacher($conexion, $IdUser, $IdMateria, $IdGrado, $IdGrupo, $IdMateriasProf);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente la materia asignada del Profesor #' . $IdMateriasProf];
      goToMtMatterxTeacherList();
      break;

    case 'createMatterxTeacher':
      $IdUser = $_POST['FornIdUser'];
      $IdMateria = $_POST['FornIdMateria'];
      $IdGrado = $_POST['FornIdGrado'];
      $IdGrupo = $_POST['FornIdGrupo'];
      createMatterxTeacher($conexion, $IdUser, $IdMateria, $IdGrado, $IdGrupo);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente la materia asignada del Profesor #' . $IdMateriasProf];
      goToMtMatterxTeacherList();
      break;

    case 'deleteMatterxTeacher':
      $IdMateriasProf = $_POST['MateriasxProf'];
      deleteMatterxTeacher($conexion, $IdMateriasProf);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se Elimino Correctamente la asignacion del Profesor #' . $IdMateriasProf];
      goToMtMatterxTeacherList();
  }
} // MATERIAS X DOCENTES
elseif ($_GET['action'] === 'listarMATTERxTEACHER') {//CONSULTA TODO
  $resultados = searchMatterTeacher($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}
