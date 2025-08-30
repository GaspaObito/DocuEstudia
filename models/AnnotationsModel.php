<!-- ================ CRUD PARA ANNOTATION ================ -->
<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
// Conexion Base de Datos
include("$RootPath/models/DatabaseConnection.php");
// Inicializar variables con valores por defecto
$Nombre = '';$Apellido = '';$DescFalta = '';
// Recolecion ID Annotation 
$idAnot = isset($_POST['NumIdAnnotation']) ? intval($_POST['NumIdAnnotation']) : 0;
$isUpdate = $idAnot > 0;
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
    deleteAnnotation($conexion, $idAnot);

  } elseif ($action === 'create') {
    createAnnotation($conexion, $nameTeacher, $IdObs, $tipoFalta, $descripcion);

  } elseif ($action === 'update') {
    $idAnot = $_POST["NumIdAnnotation"];
    updateAnnotation($conexion, $nameTeacher, $idAnot, $tipoFalta, $descripcion);

  } elseif ($action === 'read') { //History Annotations
    $IdObs = $_POST["IdObs"];
    $contador = 1;
    $resultados = readAnnotation($conexion, $IdObs);
    $anotacionesConsulta = $resultados['consultar'];
    $totalFilas = $resultados['totalFilas'];

  } elseif ($action === 'readespecefy') {
    $idAnot = $_POST["NumIdAnnotation"];
    $annotationsData = searchAnnotation($conexion, $idAnot);
    $NomProfCread = $annotationsData['NomProfCread'];$TipoFalta = $annotationsData['TipoFalta'];$DescFalta = $annotationsData['DescFalta'];$FecCreacion = $annotationsData['FecCreacion'];$NomProfModif = $annotationsData['NomProfModif'];$FecModif = $annotationsData['FecModif'];
  }
  // VALIDAR CUANDO NO SE INGRESE NADA PARA MOSTRAR
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET['DNI'])) {
  $IdObs = $_POST["IdObs"];
  $contador = 1;
  $resultados = searchAnnotation($conexion, $IdObs);
  // Accede a las variables retornadas desde el array de resultados
  $anotacionesConsulta = $resultados['consultar'];
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
function createAnnotation($conexion, $nameTeacher, $IdObs, $tipoFalta, $descripcion)
{
  $sql_detalle = "INSERT INTO anotacion(IdObs,NomProfCread,TipoFalta,DescFalta,FecCreacion) VALUES('" . addslashes($IdObs) . "','" . addslashes($nameTeacher) . "','" . addslashes($tipoFalta) . "','" . addslashes($descripcion) . "',NOW())";
  /* Validar insercion */
  mysqli_query($conexion, $sql_detalle) or die("ERROR EN LA INSERCION");
  mysqli_close($conexion);
  echo "<script>alert('LA ANOTACION SE INSERTO CORRECTAMENTE')</script>
  <script>location.href = '/proyectos/DocuEstudia/views/forms/ManageAnnotations.php'</script>";
}
// ========== ACTUALIZAR UPDATE FUNCTION ==========
function updateAnnotation($conexion, $nameTeacher, $idAnot, $tipoFalta, $descripcion)
{
  if ($tipoFalta === "mantener") {
    // El usuario ha seleccionado la opción "mantener", asignar el valor actual del campo
    $tipoFalta = $_POST["tipoFaltaActual"];
  }
  $sql_detalle = "UPDATE anotacion SET NomProfModif='" . $nameTeacher . "',TipoFalta='" . $tipoFalta . "', DescFalta='" . $descripcion . "'
    WHERE IdAnot=" . $idAnot;
  /* Validar insercion */
  mysqli_query($conexion, $sql_detalle) or die("ERROR EN LA INSERCION");
  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE ACTUALIZARON CORRECTAMENTE')</script>
    <script>location.href = '/proyectos/DocuEstudia/views/forms/ManageAnnotations.php  '</script>";
}
// ========== LEER READ FUNCTION ==========
function readAnnotation($conexion, $IdObs)
{
  // Inicializa la variable de consulta con la búsqueda de todos los profesores
  $consultaSQL = ("SELECT * from anotacion WHERE IdObs='$IdObs'") or die("ERROR AL TRAER LOS DATOS");
  ;
  $query = "SELECT COUNT(*) AS total FROM anotacion WHERE IdObs='$IdObs'";
  // Verifica si se envió el formulario de búsqueda
  if (!empty($_GET['DNI'])) {
    $Numero_Documento = $_GET['DNI'];
    $query = "SELECT COUNT(*) AS total FROM usuarios WHERE NumDcto=$Numero_Documento";
    // Modifica la consulta para filtrar por número de documento
    $consultaSQL .= " WHERE u.NumDcto='$Numero_Documento'";
  }
  // Realiza la consulta
  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultado = mysqli_query($conexion, $query);
  $datos = mysqli_fetch_assoc($resultado);
  $totalFilas = $datos['total'];
  // Retorna las variables como un array
  return ['consultar' => $consultar, 'totalFilas' => $totalFilas];
}
// ========== BUSCAR SEARCH FUNCTION ==========
function searchAnnotation($conexion, $idAnot)
{
  $stmt = $conexion->prepare("SELECT * FROM anotacion WHERE IdAnot = ?");
  $stmt->bind_param('i', $idAnot); // 'i' porque IdAnot es entero
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
      return $row;
  } else {
      return null;
  }
}