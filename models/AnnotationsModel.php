<!-- ================ CRUD PARA ANNOTATION ================ -->
<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
// Conexion Base de Datos
include ("$RootPath/models/DatabaseConnection.php");
// Inicializar variables con valores por defecto
$Nombre = '';
$Apellido = '';
// Recolecion ID Profesor 
$id = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $id > 0;

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
    deleteTeacher($conexion, $id);
  } elseif ($action === 'create') {
    createTeacher($conexion,$nameTeacher,$idEstudiante,$tipoFalta,$descripcion);
    // createProfesor($conexion, $id);
  } elseif ($action === 'update') {
    updateTeacher($conexion, $id);
  } elseif ($action === 'read') {
    $profesorData = readTeacher($conexion, $id);
    // Asignar las variables desde el array devuelto
    $Id_Profesor = $profesorData['IdProf'];
  }  else {
    echo 'error';
  }
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET' || !empty($_GET['DNI'])) {
  $resultados = searchTeacher($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}
// ========== ELIMINAR DELETE FUNCTION ==========
function deleteTeacher($conexion, $id)
{
$NumeroEliminar = $_GET['NumeroEliminar'];
mysqli_query($conexion, "delete from anotacion where Id_Anotacion='$NumeroEliminar'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
mysqli_close($conexion);
echo "<script>location.href='../Profesor/historial_anotaciones.php'</script>";
}
// ========== CREAR CREATE FUNCTION ==========
function createTeacher($conexion,$nameTeacher,$idEstudiante,$tipoFalta,$descripcion)
{
$sql_detalle = "INSERT INTO anotacion(NomProfCread,IdEst,TipoFalta,DescFalta,FecCreacion) VALUES('" . addslashes($nameTeacher) . "',
'" . addslashes($idEstudiante) . "','" . addslashes($tipoFalta) . "','" . addslashes($descripcion) . "',NOW())";
/* Validar insercion */
mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION");
mysqli_close($conexion);
echo "<script>alert('LA ANOTACION SE INSERTO CORRECTAMENTE')</script>";
echo "<script>location.href = '../controllers/teacher/Annotations.php'</script>";
}
// ========== ACTUALIZAR UPDATE FUNCTION ==========
function updateTeacher($conexion, $id)
{
 
}
// ========== LEER READ FUNCTION ==========
function readTeacher($conexion, $id)
{
  
}
// ========== BUSCAR SEARCH FUNCTION ==========
function searchTeacher($conexion)
{

}

