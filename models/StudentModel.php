<!-- ================ CRUD PARA STUDENT ================ -->
<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia/");
// Conexion Base de Datos
include ("$RootPath/models/DatabaseConnection.php");
// Inicializar variables con valores por defecto
$Id_Persona = '';
/*GUARDIAN*/
$NombreGua = '';
$ApellidoGua = '';
$OcupacionGua = '';
$TelefonoGua = '';
$EmailGua = '';
$ParentescoGua = '';
$ViveAcudienteGua = '';
/*HISTORIAL_ESCOLAR*/
$ColegioAnterior = '';
$Direccion = '';
$UltCursoCursado = '';
$Jornada = '';
$EsRepitente = '';
$CuantasVeces = '';
$PracticaDeporte = '';
$NombreDeporte = '';
/*MEDICOS*/
$Eps = '';
$Sanitaria = '';
$Ocupación = '';
$Recomendaciones = '';
$Antecendentes = '';
$FornTipoSangre = '';
/*STUDENT*/
$NombreStu = '';
$ApellidoStu = '';
$TelefonoStu = '';
$FechaNacimientoStu = '';
$ResidenciaStu = '';
$LugarNacimientoStu = '';
$NumeroIdentifStu = '';
$FornCurso = '';
$EdadStu = '';
$TipoEntidad = '1';//Estudiante
// Recolecion ID Estudiante 
$id = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $id > 0;

if (isset($_POST["SendDataStudent"])) {
  //RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
  /*GUARDIAN*/
  $Id_Profesor = $_POST['id_estudiante'];
  $NombreGua = $_POST["nombre"];
  $ApellidoGua = $_POST["apellido"];
  $OcupacionGua = $_POST["ocupacion"];
  $TelefonoGua = $_POST["telefono"];
  $EmailGua = $_POST["email"];
  $ParentescoGua = $_POST["parentesco"];
  $ViveAcudienteGua = $_POST["ViveAcudiente"];
  /*HISTORIAL_ESCOLAR*/
  $ColegioAnterior = $_POST["Colegio_Anterior"];
  $Direccion = $_POST["Direccion"];
  $UltCursoCursado = $_POST["Ult_Curso_Cursado"];
  $Jornada = $_POST["Jornada"];
  $EsRepitente = $_POST["Es_Repitente"];
  $CuantasVeces = $_POST["CuantasVeces"];
  $PracticaDeporte = $_POST["PracticaDeporte"];
  $NombreDeporte = $_POST["Nombre_Deporte"];
  /*MEDICOS*/
  $Eps = $_POST["Eps"];
  $Sanitaria = $_POST["Sanitaria"];
  $Ocupación = $_POST["Ocupación"];
  $Recomendaciones = $_POST["Recomendaciones"];
  $Antecendentes = $_POST["Antecendentes"];
  $FornTipoSangre = $_POST["FornTipoSangre"];
  /*ESTUDIANTE*/
  $NombreStu = $_POST["Nombre_Est"];
  $ApellidoStu = $_POST["Apellido_Est"];
  $NumeroIdentifStu = $_POST["NumeroIdentif_Est"];
  $FornCurso = $_POST["FornCurso"];
  $TelefonoStu = $_POST["Telefono_Est"];
  $FechaNacimientoStu = $_POST["Fecha_Nacimiento_Est"];
  $LugarNacimientoStu = $_POST["Lugar_Nacimiento_Est"];
  $ResidenciaStu = $_POST["Residencia_Est"];
  $EdadStu = $_POST["Edad_Est"];
  //RECIBIMOS POST IMAGEN 
  $TipoImagen = $_FILES['Imagen']['type'];
  $NombreImagenOriginal = $_FILES['Imagen']['name'];
  $Imagen_temporal = $_FILES['Imagen']['tmp_name'];
}
// Se maneja la logica de las operaciones Delete,Create,Update,Read,Search
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];
  if ($action === 'delete') {
    deleteStudent($conexion, $id);
  } elseif ($action === 'create') {
    createStudent($RootPath,$conexion,$Id_Persona,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
    $ColegioAnterior,$Direccion,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
    $Eps,$Sanitaria,$Ocupación,$Recomendaciones,$Antecendentes,$FornTipoSangre,
    $NombreStu,$ApellidoStu,$NumeroIdentifStu,$FornCurso,$TelefonoStu,$FechaNacimientoStu,$LugarNacimientoStu,$ResidenciaStu,$EdadStu,
    $TipoEntidad,$NombreImagenOriginal,$Imagen_temporal);
    // createProfesor($conexion, $id);
  } elseif ($action === 'update') {
    updateStudent($RootPath,$conexion,$Id_Persona,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
    $ColegioAnterior,$Direccion,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
    $Eps,$Sanitaria,$Ocupación,$Recomendaciones,$Antecendentes,$FornTipoSangre,
    $NombreStu,$ApellidoStu,$NumeroIdentifStu,$FornCurso,$TelefonoStu,$FechaNacimientoStu,$LugarNacimientoStu,$ResidenciaStu,$EdadStu,
    $TipoEntidad,$NombreImagenOriginal,$Imagen_temporal);
  } elseif ($action === 'read') {
    $StudentData = readStudent($conexion, $id);
    // Asignar las variables desde el array devuelto
    /*GUARDIAN*/
    $NombreGua =$StudentData['NomAcudi'];
    $ApellidoGua = $StudentData['ApeAcudi'];
    $OcupacionGua = $StudentData['OcupacionAcudi'];
    $TelefonoGua = $StudentData['TelAcudi'];
    $EmailGua = $StudentData['EmailAcudi'];
    $ParentescoGua = $StudentData['ParentesAcudi'];
    $ViveAcudienteGua = $StudentData['ViveEstAcudi'];
    /*HISTORIAL_ESCOLAR*/
    $ColegioAnterior = $StudentData["AnteriorEsc"];
    $Direccion = $StudentData["DireccionEsc"];
    $UltCursoCursado = $StudentData["CursoEsc"];
    $Jornada = $StudentData["JornadaEsc"];
    $EsRepitente = $StudentData["RepitenteEsc"];
    $CuantasVeces = $StudentData["CantRepiEsc"];
    $PracticaDeporte = $StudentData["PracDeportEsc"];
    $NombreDeporte = $StudentData["NomDeportEsc"];
    /*MEDICOS*/
    $Eps = $StudentData["NomEPSMed"];
    $Sanitaria = $StudentData["PrioSanitaMed"];
    $Ocupación = $StudentData["OcupaMed"];
    $Recomendaciones = $StudentData["RecomMed"];
    $Antecendentes = $StudentData["AnteceMed"];
    $FornTipoSangre = $StudentData["IdTipoSanMed"];
    /*ESTUDIANTE*/
    $NombreStu = $StudentData["NomEst"];
    $ApellidoStu = $StudentData["ApeEst"];
    $NumeroIdentifStu = $StudentData["NumDocEst"];
    $FornCurso = $StudentData["IdCurso"];
    $TelefonoStu = $StudentData["TelEst"];
    $FechaNacimientoStu = $StudentData["FecNacEst"];
    $LugarNacimientoStu = $StudentData["LugNacEst"];
    $ResidenciaStu = $StudentData["ResidenEst"];
    $EdadStu = $StudentData["EdadEst"];
  }  else {
    echo 'error';
  }
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET' || !empty($_GET['DNI'])) {
  $resultados = searchStudent($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}
// ========== ELIMINAR DELETE FUNCTION ==========
function deleteStudent($conexion, $id)
{
  mysqli_query($conexion, "delete from observador where IdEst='$id'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
  /*ACTUALIZA CURSOS*/
  $sql_curso = "UPDATE curso c SET Numero_Alumnos = (SELECT COUNT(*) FROM observador o 
  WHERE o.Id_Curso = c.Id_Curso)";
  mysqli_query($conexion, $sql_curso) or die ("ERROR EN LA INSERCION" . $id);
  /*FINALIZA ACTUALIZA CURSOS*/
  mysqli_close($conexion);
  echo "<script>alert('SE ELIMINO CORRECTAMENTE')</script>";
  echo "<script>location.href='/proyectos/DocuEstudia/controllers/teacher/AnnotationsSearch.php'</script>";
  exit;
}
// ========== CREAR CREATE FUNCTION ==========
function createStudent($RootPath,$conexion,$Id_Persona,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
$ColegioAnterior,$Direccion,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
$Eps,$Sanitaria,$Ocupación,$Recomendaciones,$Antecendentes,$FornTipoSangre,
$NombreStu,$ApellidoStu,$NumeroIdentifStu,$FornCurso,$TelefonoStu,$FechaNacimientoStu,$LugarNacimientoStu,$ResidenciaStu,$EdadStu,
$TipoEntidad,$NombreImagenOriginal,$Imagen_temporal)
{
  /*ACUDIENTE*/
  $sql_detalle = "INSERT INTO datos_familiar(Nombre_Acudiente,Apellido_Acudiente,Parentesco,Ocupacion,Tel_Cel,Email,Vive_Con_Estudiante) VALUES(
    '" . $NombreGua . "','" . $ApellidoGua . "','" . $ParentescoGua . "','" . $OcupacionGua . "','" . $TelefonoGua . "','" . $EmailGua . "','" . $ViveAcudienteGua . "')";
  /* Insertar datos en la tabla */
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION" . $Id_Persona);
  /* Obtener el último ID insertado */
  $ultimoId_DatosFamiliar = mysqli_insert_id($conexion);
  /*FINALIZA ACUDIENTE*/
  /*HISTORIAL_ESCOLAR*/
  $sql_detalle = "INSERT INTO historial_escolar(Colegio_Anterior,Direccion,Curso,Jornada,Repitente,Cantidad_Repitente,Practica_Deporte,Nombre_Deporte) VALUES(
    '" . $ColegioAnterior . "','" . $Direccion . "','" . $UltCursoCursado . "','" . $Jornada . "','" . $EsRepitente . "','" . $CuantasVeces . "','" . $PracticaDeporte . "','" . $NombreDeporte . "')";
  /* Insertar datos en la tabla */
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION" . $Id_Persona);
  /* Obtener el último ID insertado */
  $ultimoId_HistorialEscolar = mysqli_insert_id($conexion);
  /*FINALIZA HISTORIAL_ESCOLAR*/
  /*MEDICOS*/
  $sql_detalle = "INSERT INTO info_medica(Nombre_EPS,Prioridad_Sanitaria,Ocupacion,Recomendaciones_Medicas,Antecedentes_Medicos,Id_Tipo_Sangre) VALUES(
    '" . $Eps . "','" . $Sanitaria . "','" . $Ocupación . "','" . $Recomendaciones . "','" . $Antecendentes . "','" . $FornTipoSangre . "')";
  /* Insertar datos en la tabla */
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION" . $Id_Persona);
  /* Obtener el último ID insertado */
  $ultimoId_InfoMedica = mysqli_insert_id($conexion);
  /*FINALIZA MEDICOS*/
  /*ESTUDIANTE*/
  // Obtener la extensión del archivo original
  $extension = pathinfo($NombreImagenOriginal, PATHINFO_EXTENSION);
  // Crear el nuevo nombre del archivo usando el número de documento
  $NombreImagen = "Estudiante_" . $NumeroIdentifStu . "." . $extension;
  // Leer el contenido binario de la imagen
  $BinarioImagen = file_get_contents($Imagen_temporal);
  // Mover la imagen a la carpeta de destino
  move_uploaded_file($Imagen_temporal, "$RootPath/assets/images/photostudent/$NombreImagen");
  // Insertar en la base de datos
  $sql_TbImagen = "INSERT INTO imagenes (Tipo_Entidad,Nombre_Imagen,imagen) VALUES (?,?,?)";//MAX FILE SIZE 8MG
  $stmt = $conexion->prepare($sql_TbImagen);
  $stmt->bind_param('iss', $TipoEntidad, $NombreImagen, $BinarioImagen);
  $stmt->execute();
  $stmt->close();
  /* Obtener el último ID insertado */
  $ultimoId_Imagen = mysqli_insert_id($conexion);
  $sql_detalle = "INSERT INTO observador(Nombre_Estudiante,Id_Imagen,Apellido_Estudiante,Numero_Documento,Id_DatosFamiliar,Id_Historial_Escolar,Id_Medicina,Id_Curso,Tel_Cel,Fecha_Nacimiento,LugarNacimiento,Residencia,Edad) VALUES(
    '" . $NombreStu . "','" . $ultimoId_Imagen . "','" . $ApellidoStu . "','" . $NumeroIdentifStu . "','" . $ultimoId_DatosFamiliar . "','" . $ultimoId_HistorialEscolar . "','" . $ultimoId_InfoMedica . "','" . $FornCurso . "','" . $TelefonoStu . "','" . $FechaNacimientoStu . "','" . $LugarNacimientoStu . "','" . $ResidenciaStu . "','" . $EdadStu . "')";
  /* Insertar datos en la tabla */
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION" . $Id_Persona);
  /*FINALIZA ESTUDIANTE*/
  /*ACTUALIZA CURSOS*/
  $sql_curso = "UPDATE curso c SET Numero_Alumnos = (SELECT COUNT(*) FROM observador o 
    WHERE o.Id_Curso = c.Id_Curso)";
  mysqli_query($conexion, $sql_curso) or die ("ERROR EN LA INSERCION" . $Id_Persona);
  /*FINALIZA ACTUALIZA CURSOS*/
  /*FINALIZA INSERCCION*/
  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE CREARON CORRECTAMENTE')</script>";
  echo "<script>location.href='/proyectos/DocuEstudia/controllers/teacher/AnnotationsSearch.php'</script>";
}
// ========== ACTUALIZAR UPDATE FUNCTION ==========
function updateStudent($RootPath,$conexion,$Id_Persona,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
$ColegioAnterior,$Direccion,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
$Eps,$Sanitaria,$Ocupación,$Recomendaciones,$Antecendentes,$FornTipoSangre,
$NombreStu,$ApellidoStu,$NumeroIdentifStu,$FornCurso,$TelefonoStu,$FechaNacimientoStu,$LugarNacimientoStu,$ResidenciaStu,$EdadStu,
$TipoEntidad,$NombreImagenOriginal,$Imagen_temporal)
{
  
}
// ========== LEER READ FUNCTION ==========
function readStudent($conexion, $id)
{
  $stmt = $conexion->prepare("SELECT *, t.GrupoSanguineo,c.NomCurso,p.NomImg FROM observador o 
  JOIN datos_familiar d ON o.IdDatAcudi  = d.IdDatAcudi 
  JOIN historial_escolar h ON o.IdHistEsc  = h.IdHistEsc 
  JOIN info_medica i ON o.IdMed  = i.IdMed 
  JOIN tipo_sangre t ON i.IdTipoSanMed = t.IdTipoSanMed
  JOIN curso c ON o.IdCurso = c.IdCurso
  JOIN imagenes p ON o.IdImgEst = p.IdImg
  WHERE IdEst = ?");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  }else {
    return null;
  }
}
// ========== BUSCAR SEARCH FUNCTION ==========
function searchStudent($conexion)
{
  // Inicializa la variable de consulta con la búsqueda de todos los profesores
  $consultaSQL = ("SELECT CONCAT(o.NomEst, ' ', o.ApeEst) AS NombreCompleto, o.*, c.NomCurso
                FROM observador o LEFT JOIN curso c ON o.IdCurso = c.IdCurso") or die("ERROR AL TRAER LOS DATOS");
  $query = "SELECT COUNT(*) AS total FROM observador";
  // Verifica si se envió el formulario de búsqueda
  if (!empty($_GET['DNI'])) {
    $Numero_Documento = $_GET['DNI'];
    $query = "SELECT COUNT(*) AS total FROM observador WHERE Numero_Documento=$Numero_Documento";
    // Modifica la consulta para filtrar por número de documento
    $consultaSQL .= " WHERE o.Numero_Documento='$Numero_Documento'";
  }
  // Realiza la consulta
  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultado = mysqli_query($conexion, $query);
  $datos = mysqli_fetch_assoc($resultado);
  $totalFilas = $datos['total'];
  // Retorna las variables como un array
  return ['consultar' => $consultar, 'totalFilas' => $totalFilas];
}
