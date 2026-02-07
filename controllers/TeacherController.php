<!-- ================ CRUD PARA TEACHER ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/TeacherModel.php");
require_once(ROOT_PATH . "/models/CommonModel.php");
// Inicializar variables con valores por defecto
$Nombre = '';
$Apellido = '';
$TipoDcto = '';
$NumDocumento = '';
$Telefono = '';
$Fecha_Nacimiento = '';
$Direccion = '';
$AsigAcadeProf = '';
$IdMateria = '';
$AreaProf = '';
$Email = '';
$Password = '';
$IdRol = 2;
$IdProf = 2;
$ultimoId_Imagen ='';
$NomMateria = '';//Profesor
// Recolecion ID Profesor 
$IdUser = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdUser > 0;
$IdMateriasProf = isset($_POST['MateriasxProf']) ? intval($_POST['MateriasxProf']) : 0;
$isUpdateMateriasProf = $IdMateriasProf > 0;

function goToTeacherList()
{
  redirectTo("/views/admin/ManageUsers.php?action=listar");
}
function goToMtMatterxTeacherList()
{
  redirectTo("/views/admin/MtMatterxTeacher.php?action=listarMATTERxTEACHER");
}
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["Enviar2"])) {
  $IdUser = $_POST['id_profesor'];
  $Nombre = $_POST["Nombre"];
  $Apellido = $_POST["Apellido"];
  $TipoDcto = $_POST["TipoDcto"];
  $NumDocumento = $_POST["NumDocumento"];
  $Telefono = $_POST["Telefono"];
  $Fecha_Nacimiento = $_POST["Fecha_Nacimiento"];
  $Direccion = $_POST["Direccion"];
  $AsigAcadeProf = $_POST["AsigAcadeProf"];
  $AreaProf = $_POST["Area"];
  $Email = $_POST["Correo"];
  $Password = $_POST["Contrasena"];
  $IdGrupo = $_POST['FornIdGrupo'];
  $IdMateria = $_POST['FornIdMateria'];
  //Recibimos Imagen POST
  $ultimoId_Imagen = $_POST['id_lastImg'];
  $NombreImagenOriginal = $_FILES['Imagen']['name'];
  $Imagen_temporal = $_FILES['Imagen']['tmp_name'];
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
    case 'delete':
      deleteTeacher($conexion, $IdUser);
      $_SESSION['alerts'][] = ['type' => 'info', 'text' => 'Se elimino Correctamente #' . $IdUser];
      goToTeacherList();
      break;
    case 'create':
      createTeacher($conexion, $ultimoId_Imagen, $Nombre, $Apellido, $TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento, $Direccion, $AsigAcadeProf, $IdMateria, $AreaProf, $Email, $Password, $IdRol, $NombreImagenOriginal, $Imagen_temporal, $IdGrupo);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Los Datos del Profesor Fueron Correctamente Creados #' . $ultimoIdProf];
      goToTeacherList();
      break;
    case 'update':
      updateTeacher($conexion, $IdUser, $ultimoId_Imagen, $Nombre, $Apellido, $TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento, $Direccion, $AsigAcadeProf, $IdMateria, $AreaProf, $Email, $Password, $NombreImagenOriginal, $Imagen_temporal, $IdGrupo, $IdProf);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente los datos del Profesor #' . $IdProf];
      goToTeacherList();
      break;
    case 'read':
      $profesorData = readTeacher($conexion, $IdUser);
      // Asignar las variables desde el array devuelto
      $IdUser = $profesorData['IdUser'];
      $ultimoId_Imagen = $profesorData['IdImg'];
      $Nombre = $profesorData['Nombre'];
      $Apellido = $profesorData['Apellido'];
      $TipoDcto = $profesorData["TipoDcto"];
      $NumDocumento = $profesorData['NumDcto'];
      $Telefono = $profesorData['Telefono'];
      $Fecha_Nacimiento = $profesorData['FechNacimiento'];
      $Direccion = $profesorData['Direccion'];
      $AsigAcadeProf = $profesorData['AsigAcadeProf'];
      $IdMateria = $profesorData['IdMateria'];
      $AreaProf = $profesorData['AreaProf'];
      $Email = $profesorData['Email'];
      $Password = $profesorData['Password'];
      $NombreImagen = $profesorData['NomImg'];
      $IdGrupo = $profesorData['IdGrupo'];
      $IdMateria = $profesorData['IdMateria'];
      $NomMateria = $profesorData['NomMateria'];
      break;
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
      // CREA MAESTRO ASIGNACION DE MATERIAS -----------------------
      break;
    case 'updateMatterxTeacher':
      updateMatterxTeacher($conexion, $IdUser, $IdMateria, $IdGrado, $IdGrupo, $IdMateriasProf);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente la materia asignada del Profesor #' . $IdUser];
      goToMtMatterxTeacherList();
      break;
    case 'createMatterxTeacher':
      $IdUser = $_POST['FornIdUser'];
      $IdMateria = $_POST['FornIdMateria'];
      $IdGrado = $_POST['FornIdGrado'];
      $IdGrupo = $_POST['FornIdGrupo'];
      createMatterxTeacher($conexion, $IdUser, $IdMateria, $IdGrado, $IdGrupo);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente la materia asignada del Profesor #' . $IdUser];
      goToMtMatterxTeacherList();
      break;
    case 'deleteMatterxTeacher':
      $IdMateriasProf = $_POST['MateriasxProf'];
      deleteMatterxTeacher($conexion, $IdMateriasProf);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se Elimino Correctamente la asignacion del Profesor #' . $IdMateriasProf];
      goToMtMatterxTeacherList();
  }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'listar') {//CONSULTA TODO
  $resultados = searchTeacher($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
} elseif ($_GET['action'] === 'grupos') {//CONSULTA TODO
  $resultados = gruposteacher($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}
// MATERIAS X DOCENTES
elseif ($_GET['action'] === 'listarMATTERxTEACHER') {//CONSULTA TODO
  $resultados = searchMatterTeacher($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}
