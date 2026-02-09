<?php
/* ==========================================
   CONTROLLER: TeacherController.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/TeacherModel.php");
require_once(ROOT_PATH . "/models/CommonModel.php");

/* ---------- 2. ESTADO INICIAL ---------- */
$Nombre = ''; $Apellido = ''; $TipoDcto = ''; $NumDocumento = ''; $Telefono = ''; $Fecha_Nacimiento = ''; $Direccion = ''; $AsigAcadeProf = ''; $IdMateria = ''; $AreaProf = ''; $Email = ''; $Password = ''; $IdRol = 2; $IdProf = 2; $ultimoId_Imagen = ''; $NomMateria = '';//Profesor

/* Variables de vista */
$consultar = [];
$totalFilas = 0;

/* Variables del formulario */
$IdUser = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdUser > 0;

/* ---------- 3. HELPERS ---------- */
function goToTeacherList()
{
  redirectTo("/views/admin/ManageUsers.php?action=listar");
}
function goToMtMatterxTeacherList()
{
  redirectTo("/views/admin/MtMatterxTeacher.php?action=listarMATTERxTEACHER");
}

/* ---------- 4. ROUTING ---------- */
$method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';
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

/* ---------- 5. POST ACTIONS ---------- */
if ($method === 'POST') {

  switch ($action) {

    /* -------- CREATE -------- */
    case 'create':
      createTeacher($conexion, $ultimoId_Imagen, $Nombre, $Apellido, $TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento, $Direccion, $AsigAcadeProf, $IdMateria, $AreaProf, $Email, $Password, $IdRol, $NombreImagenOriginal, $Imagen_temporal, $IdGrupo);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Los Datos del Profesor Fueron Correctamente Creados #' . $ultimoIdProf];
      goToTeacherList();
      break;

    /* -------- UPDATE -------- */
    case 'update':
      updateTeacher($conexion, $IdUser, $ultimoId_Imagen, $Nombre, $Apellido, $TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento, $Direccion, $AsigAcadeProf, $IdMateria, $AreaProf, $Email, $Password, $NombreImagenOriginal, $Imagen_temporal, $IdGrupo, $IdProf);
      $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente los datos del Profesor #' . $IdProf];
      goToTeacherList();
      break;    

    /* -------- DELETE -------- */
    case 'delete':
      deleteTeacher($conexion, $IdUser);
      $_SESSION['alerts'][] = ['type' => 'info', 'text' => 'Se elimino Correctamente #' . $IdUser];
      goToTeacherList();
      break;

    /* -------- READ -------- */
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
  }
} 

/* ---------- 6. GET ACTIONS ---------- */
elseif ($method === 'GET' && $action === 'listar') {
  $resultados = searchTeacher($conexion);
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];

} elseif ($action === 'grupos') {
  $resultados = gruposteacher($conexion);
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}