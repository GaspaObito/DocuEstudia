<!-- ================ CRUD PARA TEACHER ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/TeacherModel.php");
// Inicializar variables con valores por defecto
$Nombre = ''; $Apellido = ''; $TipoDcto = ''; $NumDocumento = ''; $Telefono = ''; $Fecha_Nacimiento = ''; $Direccion = ''; $AsigAcadeProf = ''; $IdMateria = ''; $AreaProf = ''; $Email = ''; $Password = ''; $IdRol = 2; $IdProf = 2; $NomMateria = '';//Profesor
// Recolecion ID Profesor 
$IdUser = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdUser > 0;
$IdMateriasxProf = isset($_POST['MateriasxProf']) ? intval($_POST['MateriasxProf']) : 0;
// Consulta para Tipo de Sangre y mt_grados
$mt_grados = "SELECT * FROM mt_grados";
$mt_grados = mysqli_query($conexion, $mt_grados) or die(mysqli_error($conexion));
$mt_grupos = "SELECT * FROM mt_grupos";
$mt_grupos = mysqli_query($conexion, $mt_grupos) or die(mysqli_error($conexion));
$mt_profesores = "SELECT *,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto FROM profesor pr LEFT JOIN usuarios us ON us.IdUser = pr.IdUser  ";
$mt_profesores = mysqli_query($conexion, $mt_profesores) or die(mysqli_error($conexion));
$mt_materias = "SELECT * FROM mt_materias";
$mt_materias = mysqli_query($conexion, $mt_materias) or die(mysqli_error($conexion));
function goToTeacherList()
{
  redirectTo("/views/admin/ManageUsers.php?action=listar");
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
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];
  if ($action === 'delete') {
    deleteTeacher($conexion, $IdUser);
    $_SESSION['alerts'][] = ['type' => 'info', 'text' => 'Se elimino Correctamente #' . $IdUser];
    goToTeacherList();
  } elseif ($action === 'create') {
    createTeacher($conexion, $ultimoId_Imagen, $Nombre, $Apellido, $TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento, $Direccion, $AsigAcadeProf, $IdMateria, $AreaProf, $Email, $Password, $IdRol, $NombreImagenOriginal, $Imagen_temporal, $IdGrupo);
    $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Los Datos del Profesor Fueron Correctamente Creados #' . $ultimoIdProf];
    goToTeacherList();
  } elseif ($action === 'update') {
    updateTeacher($conexion, $IdUser, $ultimoId_Imagen, $Nombre, $Apellido, $TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento, $Direccion, $AsigAcadeProf, $IdMateria, $AreaProf, $Email, $Password, $NombreImagenOriginal, $Imagen_temporal, $IdGrupo, $IdProf);
    $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente los datos del Profesor #' . $IdProf];
    goToTeacherList();
  } elseif ($action === 'read') {
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
    // CREA MAESTRO ASIGNACION DE MATERIAS -----------------------
    } elseif ($action === 'readMatterxTeacher') {
    $IdMateriasProf = $_POST['MateriasxProf'];
    $profesorData = readMatterxTeacher($conexion, $IdMateriasProf);
    // Asignar las variables desde el array devuelto
    $NomMateria = $profesorData['NomMateria'];
    // CREA MAESTRO ASIGNACION DE MATERIAS -----------------------
    } elseif ($action === 'updateMatterxTeacher') {
      $IdUser = $_POST['FornIdUser'];
      updateMatterxTeacher($conexion, $IdUser, $IdMateria, $IdGrado, $IdGrupo, $IdMateriasxProf);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente la materia asignada del Profesor #' . $IdUser];
      goToTeacherList();
    }  elseif ($action === 'createMatterxTeacher') {
      $IdUser = $_POST['FornIdUser'];
      $IdMateria= $_POST['FornIdMateria'];
      $IdGrado= $_POST['FornIdGrado'];
      $IdGrupo = $_POST['FornIdGrupo'];
      createMatterxTeacher($conexion, $IdUser, $IdMateria, $IdGrado, $IdGrupo);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente la materia asignada del Profesor #' . $IdUser];
      goToTeacherList();
  }  elseif ($action === 'deleteMatterxTeacher') {
      $IdMateriasProf = $_POST['MateriasxProf'];
      deleteMatterxTeacher($conexion, $IdMateriasProf);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se Elimino Correctamente la asignacion del Profesor #' . $IdMateriasProf];
      goToTeacherList();
  }
  else {
    echo 'error';
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
