<!-- ================ CRUD PARA ANNOTATION ================ -->
<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
// Conexion Base de Datos
include ("$RootPath/models/DatabaseConnection.php");
// Inicializar variables con valores por defecto
$Nombre = '';
$Apellido = '';
// Recolecion ID Annotation 
$idAnot = isset($_POST['NumIdAnnotation']) ? intval($_POST['NumIdAnnotation']) : 0;
$isUpdate = $idAnot > 0;

//RECIBIMOS DATOS CREAR
if (isset($_POST["SendAnnotation"])) {
  $nameTeacher = $_POST["Nom_Prof"];
  $idEstudiante = $_POST["Id_Est"];
  $tipoFalta = $_POST["tipoFalta"];
  $descripcion = $_POST["descripcion"];
}

// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];
  if ($action === 'delete') {
    deleteAnnotation($conexion, $idAnot);
  } elseif ($action === 'create') {
    createAnnotation($conexion,$nameTeacher,$idEstudiante,$tipoFalta,$descripcion);
    // createProfesor($conexion, $id);
  } elseif ($action === 'update') {
    updateAnnotation($conexion,$nameTeacher,$idAnot,$tipoFalta,$descripcion);
  } elseif ($action === 'read') {
    $profesorData = readAnnotation($conexion, $id);
    // Asignar las variables desde el array devuelto
    $Id_Profesor = $profesorData['IdProf'];
  }  else {
    echo 'error';
  }
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET' || !empty($_GET['DNI'])) {
  $resultados = searchAnnotation($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}
// ========== ELIMINAR DELETE FUNCTION ==========
function deleteAnnotation($conexion, $idAnot)
{
mysqli_query($conexion, "delete from anotacion where IdAnot='$idAnot'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
mysqli_close($conexion);
echo "<script>alert('LA ANOTACION SE ELIMINO CORRECTAMENTE')</script>
  <script>location.href='/proyectos/DocuEstudia/controllers/teacher/AnnotationsHistory.php'</script>";
}
// ========== CREAR CREATE FUNCTION ==========
function createAnnotation($conexion,$nameTeacher,$idEstudiante,$tipoFalta,$descripcion)
{
$sql_detalle = "INSERT INTO anotacion(NomProfCread,IdEst,TipoFalta,DescFalta,FecCreacion) VALUES('" . addslashes($nameTeacher) . "',
'" . addslashes($idEstudiante) . "','" . addslashes($tipoFalta) . "','" . addslashes($descripcion) . "',NOW())";
/* Validar insercion */
mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION");
mysqli_close($conexion);
echo "<script>alert('LA ANOTACION SE INSERTO CORRECTAMENTE')</script>
  <script>location.href = '../controllers/teacher/Annotations.php'</script>";
}
// ========== ACTUALIZAR UPDATE FUNCTION ==========
function updateAnnotation($conexion,$nameTeacher,$idAnot,$tipoFalta,$descripcion)
{
  if ($tipoFalta === "mantener") {
    // El usuario ha seleccionado la opción "mantener", asignar el valor actual del campo
    $tipoFalta = $_POST["tipoFaltaActual"];
  }
  $sql_detalle = "UPDATE anotacion SET NomProfModif='" . $nameTeacher . "',TipoFalta='" . $tipoFalta . "', DescFalta='" . $descripcion . "'
    WHERE IdAnot=" . $idAnot;
  /* Validar insercion */
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION");
  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE ACTUALIZARON CORRECTAMENTE')</script>
    <script>location.href = '/proyectos/DocuEstudia/controllers/teacher/AnnotationsHistory.php  '</script>";
}
// ========== LEER READ FUNCTION ==========
function readAnnotation($conexion, $id)
{
  
}
// ========== BUSCAR SEARCH FUNCTION ==========
function searchAnnotation($conexion)
{

}

