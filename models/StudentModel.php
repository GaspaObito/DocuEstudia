<!-- ================ CRUD PARA STUDENT ================ -->
<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
// Conexion Base de Datos
include ("$RootPath/models/DatabaseConnection.php");
// Inicializar variables con valores por defecto
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
$IdCurso = '';
$EdadStu = '';
$TipoEntidad = '1';//Estudiante
// Recolecion ID Estudiante 
$id = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $id > 0;

if (isset($_POST["SendDataStudent"])) {
  //RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
  /*GUARDIAN*/
  $IdDatAcudi = $_POST['IdGuardian'];
  $NombreGua = $_POST["nombre"];
  $ApellidoGua = $_POST["apellido"];
  $OcupacionGua = $_POST["ocupacion"];
  $TelefonoGua = $_POST["telefono"];
  $EmailGua = $_POST["email"];
  $ParentescoGua = $_POST["parentesco"];
  $ViveAcudienteGua = $_POST["ViveAcudiente"];
  /*HISTORIAL_ESCOLAR*/
  $IdHistEsc = $_POST['IdEscolar'];
  $ColegioAnterior = $_POST["Colegio_Anterior"];
  $Direccion = $_POST["Direccion"];
  $UltCursoCursado = $_POST["Ult_Curso_Cursado"];
  $Jornada = $_POST["Jornada"];
  $EsRepitente = $_POST["Es_Repitente"];
  $CuantasVeces = $_POST["CuantasVeces"];
  $PracticaDeporte = $_POST["PracticaDeporte"];
  $NombreDeporte = $_POST["Nombre_Deporte"];
  /*MEDICOS*/
  $IdMed = $_POST['IdMedica'];
  $Eps = $_POST["Eps"];
  $Sanitaria = $_POST["Sanitaria"];
  $Ocupación = $_POST["Ocupación"];
  $Recomendaciones = $_POST["Recomendaciones"];
  $Antecendentes = $_POST["Antecendentes"];
  $FornTipoSangre = $_POST["FornTipoSangre"];
  /*ESTUDIANTE*/
  $IdEst = $_POST['IdObservador'];
  $IdImgEst = $_POST['IdImgEst'];
  $NombreStu = $_POST["Nombre_Est"];
  $ApellidoStu = $_POST["Apellido_Est"];
  $NumeroIdentifStu = $_POST["NumeroIdentif_Est"];
  $IdCurso = $_POST["FornCurso"];
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
    createStudent($RootPath,$conexion,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
    $ColegioAnterior,$Direccion,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
    $Eps,$Sanitaria,$Ocupación,$Recomendaciones,$Antecendentes,$FornTipoSangre,
    $NombreStu,$ApellidoStu,$NumeroIdentifStu,$IdCurso,$TelefonoStu,$FechaNacimientoStu,$LugarNacimientoStu,$ResidenciaStu,$EdadStu,
    $TipoEntidad,$NombreImagenOriginal,$Imagen_temporal);
    // createProfesor($conexion, $id);
  } elseif ($action === 'update') {
    updateStudent($RootPath,$conexion,$IdDatAcudi,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
    $IdHistEsc,$ColegioAnterior,$Direccion,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
    $IdMed,$Eps,$Sanitaria,$Ocupación,$Recomendaciones,$Antecendentes,$FornTipoSangre,
    $IdEst,$NombreStu,$ApellidoStu,$NumeroIdentifStu,$IdCurso,$TelefonoStu,$FechaNacimientoStu,$LugarNacimientoStu,$ResidenciaStu,$EdadStu,
    $IdImgEst,$TipoEntidad,$NombreImagenOriginal,$Imagen_temporal);
  } elseif ($action === 'read') {
    $StudentData = readStudent($conexion, $id);
    // Asignar las variables desde el array devuelto
    /*GUARDIAN*/
    $IdDatAcudi = $StudentData['IdDatAcudi'];
    $NombreGua =$StudentData['NomAcudi'];
    $ApellidoGua = $StudentData['ApeAcudi'];
    $OcupacionGua = $StudentData['OcupacionAcudi'];
    $TelefonoGua = $StudentData['TelAcudi'];
    $EmailGua = $StudentData['EmailAcudi'];
    $ParentescoGua = $StudentData['ParentesAcudi'];
    $ViveAcudienteGua = $StudentData['ViveEstAcudi'];
    /*HISTORIAL_ESCOLAR*/
    $IdHistEsc = $StudentData['IdHistEsc'];
    $ColegioAnterior = $StudentData["AnteriorEsc"];
    $Direccion = $StudentData["DireccionEsc"];
    $UltCursoCursado = $StudentData["CursoEsc"];
    $Jornada = $StudentData["JornadaEsc"];
    $EsRepitente = $StudentData["RepitenteEsc"];
    $CuantasVeces = $StudentData["CantRepiEsc"];
    $PracticaDeporte = $StudentData["PracDeportEsc"];
    $NombreDeporte = $StudentData["NomDeportEsc"];
    /*MEDICOS*/
    $IdMed = $StudentData['IdMed'];
    $Eps = $StudentData["NomEPSMed"];
    $Sanitaria = $StudentData["PrioSanitaMed"];
    $Ocupación = $StudentData["OcupaMed"];
    $Recomendaciones = $StudentData["RecomMed"];
    $Antecendentes = $StudentData["AnteceMed"];
    $IdTipoSangre = $StudentData["IdTipoSanMed"];
    $NomTipoSangre = $StudentData["GrupoSanguineo"];
    /*ESTUDIANTE*/
    $IdEst = $StudentData['IdEst'];
    $IdImgEst = $StudentData['IdImgEst'];
    $NombreImagen = $StudentData['NomImg'];
    $NombreStu = $StudentData["NomEst"];
    $ApellidoStu = $StudentData["ApeEst"];
    $NumeroIdentifStu = $StudentData["NumDocEst"];
    $IdCurso = $StudentData["IdCurso"];
    $NomCurso = $StudentData["NomCurso"];
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
function createStudent($RootPath,$conexion,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
$ColegioAnterior,$Direccion,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
$Eps,$Sanitaria,$Ocupación,$Recomendaciones,$Antecendentes,$FornTipoSangre,
$NombreStu,$ApellidoStu,$NumeroIdentifStu,$IdCurso,$TelefonoStu,$FechaNacimientoStu,$LugarNacimientoStu,$ResidenciaStu,$EdadStu,
$TipoEntidad,$NombreImagenOriginal,$Imagen_temporal)
{
  /*ACUDIENTE*/
  $sql_detalle = "INSERT INTO datos_familiar(NomAcudi,ApeAcudi,OcupacionAcudi	,TelAcudi,EmailAcudi,ParentesAcudi,ViveEstAcudi) VALUES(
    '" . $NombreGua . "','" . $ApellidoGua . "','" . $OcupacionGua . "','" . $TelefonoGua . "','" . $EmailGua . "','" . $ParentescoGua . "','" . $ViveAcudienteGua. "')";
  /* Insertar datos en la tabla */
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION");
  /* Obtener el último ID insertado */
  $ultimoId_DatosFamiliar = mysqli_insert_id($conexion);
  /*FINALIZA ACUDIENTE*/
  /*HISTORIAL_ESCOLAR*/
  $sql_detalle = "INSERT INTO historial_escolar(AnteriorEsc,DireccionEsc,CursoEsc,JornadaEsc,RepitenteEsc,CantRepiEsc,PracDeportEsc,NomDeportEsc) VALUES(
    '" . $ColegioAnterior . "','" . $Direccion . "','" . $UltCursoCursado . "','" . $Jornada . "','" . $EsRepitente . "','" . $CuantasVeces . "','" . $PracticaDeporte . "','" . $NombreDeporte . "')";
  /* Insertar datos en la tabla */
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION");
  /* Obtener el último ID insertado */
  $ultimoId_HistorialEscolar = mysqli_insert_id($conexion);
  /*FINALIZA HISTORIAL_ESCOLAR*/
  /*MEDICOS*/
  $sql_detalle = "INSERT INTO info_medica(NomEPSMed,PrioSanitaMed,OcupaMed,RecomMed,AnteceMed,IdTipoSanMed ) VALUES(
    '" . $Eps . "','" . $Sanitaria . "','" . $Ocupación . "','" . $Recomendaciones . "','" . $Antecendentes . "','" . $FornTipoSangre . "')";
  /* Insertar datos en la tabla */
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION");
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
  $sql_TbImagen = "INSERT INTO imagenes (TipoEntImg,NomImg,BinImg) VALUES (?,?,?)";//MAX FILE SIZE 8MG
  $stmt = $conexion->prepare($sql_TbImagen);
  $stmt->bind_param('iss', $TipoEntidad, $NombreImagen, $BinarioImagen);
  $stmt->execute();
  $stmt->close();
  /* Obtener el último ID insertado */
  $ultimoId_Imagen = mysqli_insert_id($conexion);
  $sql_detalle = "INSERT INTO observador(NomEst,IdImgEst,ApeEst,NumDocEst,IdDatAcudi ,IdHistEsc ,IdMed,IdCurso,TelEst,FecNacEst,LugNacEst,ResidenEst,EdadEst) VALUES(
    '" . $NombreStu . "','" . $ultimoId_Imagen . "','" . $ApellidoStu . "','" . $NumeroIdentifStu . "','" . $ultimoId_DatosFamiliar . "','" . $ultimoId_HistorialEscolar . "','" . $ultimoId_InfoMedica . "','" . $IdCurso . "','" . $TelefonoStu . "','" . $FechaNacimientoStu . "','" . $LugarNacimientoStu . "','" . $ResidenciaStu . "','" . $EdadStu . "')";
  /* Insertar datos en la tabla */
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION");
  /*FINALIZA ESTUDIANTE*/
  /*ACTUALIZA CURSOS*/
  $sql_curso = "UPDATE curso c SET NumAlumnos = (SELECT COUNT(*) FROM observador o WHERE o.IdCurso = c.IdCurso)";
  mysqli_query($conexion, $sql_curso) or die ("ERROR EN LA INSERCION");
  /*FINALIZA ACTUALIZA CURSOS*/
  /*FINALIZA INSERCCION*/
  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE CREARON CORRECTAMENTE')</script>";
  echo "<script>location.href='/proyectos/DocuEstudia/controllers/teacher/AnnotationsSearch.php'</script>";
}
// ========== ACTUALIZAR UPDATE FUNCTION ==========
function updateStudent($RootPath,$conexion,$IdDatAcudi,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
$IdHistEsc,$ColegioAnterior,$Direccion,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
$IdMed,$Eps,$Sanitaria,$Ocupación,$Recomendaciones,$Antecendentes,$FornTipoSangre,
$IdEst,$NombreStu,$ApellidoStu,$NumeroIdentifStu,$IdCurso,$TelefonoStu,$FechaNacimientoStu,$LugarNacimientoStu,$ResidenciaStu,$EdadStu,
$IdImgEst,$TipoEntidad,$NombreImagenOriginal,$Imagen_temporal)
{
  /*ACUDIENTE*/
  // El usuario ha seleccionado la opción "mantener"
  if ($ViveAcudienteGua === "mantener") {
    $ViveAcudienteGua = $_POST["ViveAcu_Actual"];
  }
  $sql_Actualizar = "UPDATE datos_familiar SET NomAcudi='" . $NombreGua . "',ApeAcudi='" . $ApellidoGua . "',OcupacionAcudi='" . $OcupacionGua . "'
    ,TelAcudi='" . $TelefonoGua . "',EmailAcudi='" . $EmailGua . "',ParentesAcudi='" . $ParentescoGua . "',ViveEstAcudi='" . $ViveAcudienteGua . "' WHERE IdDatAcudi=" . $IdDatAcudi;
  /* Insertar datos en la tabla */
  mysqli_query($conexion, $sql_Actualizar) or die ("ERROR EN LA INSERCION");
  /*FINALIZA ACUDIENTE*/
  /*HISTORIAL_ESCOLAR*/
  if ($EsRepitente === "mantener") {
    $EsRepitente = $_POST["Repitente_Actual"];
  }
  if ($CuantasVeces === "mantener") {
    $CuantasVeces = $_POST["RepiteCant_Actual"];
  }
  if ($PracticaDeporte === "mantener") {
    $PracticaDeporte = $_POST["PracticDep_Actual"];
  }
  $sql_Actualizar = "UPDATE historial_escolar SET AnteriorEsc='" . $ColegioAnterior . "',DireccionEsc='" . $Direccion . "',CursoEsc='" . $UltCursoCursado . "'
    ,JornadaEsc='" . $Jornada . "',RepitenteEsc='" . $EsRepitente . "',CantRepiEsc='" . $CuantasVeces . "',PracDeportEsc='" . $PracticaDeporte . "'
    ,NomDeportEsc='" . $NombreDeporte . "' WHERE IdHistEsc =" . $IdHistEsc;
  /* Insertar datos en la tabla */
  mysqli_query($conexion, $sql_Actualizar) or die ("ERROR EN LA INSERCION");
  /*FINALIZA HISTORIAL_ESCOLAR*/
  /*MEDICOS*/
  // El usuario ha seleccionado la opción "mantener"
  if ($FornTipoSangre === "mantener") {
    $FornTipoSangre = $_POST["GrupSangui_Actual"];
  }
  $sql_Actualizar = "UPDATE info_medica SET NomEPSMed='" . $Eps . "',PrioSanitaMed='" . $Sanitaria . "',OcupaMed='" . $Ocupación . "'
    ,RecomMed='" . $Recomendaciones . "',AnteceMed='" . $Antecendentes . "',IdTipoSanMed ='" . $FornTipoSangre . "' 
    WHERE IdMed =" . $IdMed;
  /* Insertar datos en la tabla */
  mysqli_query($conexion, $sql_Actualizar) or die ("ERROR EN LA INSERCION");
  /*FINALIZA MEDICOS*/
  // Obtener la extensión del archivo original
  $extension = pathinfo($NombreImagenOriginal, PATHINFO_EXTENSION);
  // Crear el nuevo nombre del archivo usando el número de documento
  $NombreImagen = "Estudiante_" . $NumeroIdentifStu . "." . $extension;
  // Leer el contenido binario de la imagen
  $BinarioImagen = file_get_contents("$RootPath/assets/images/photostudent/$NombreImagen");
  // Mover la imagen a la carpeta de destino
  move_uploaded_file($Imagen_temporal, "$RootPath/assets/images/photostudent/$NombreImagen");
  // Actualizar en la base de datos utilizando una consulta preparada
  $sql_TbImagen = "UPDATE imagenes SET NomImg=?, BinImg=? WHERE IdImg=?";//MAX FILE SIZE 8MG
  $stmt = $conexion->prepare($sql_TbImagen);
  $stmt->bind_param('ssi', $NombreImagen, $BinarioImagen, $IdImgEst);
  // Ejecutar la consulta preparada
  // Ejecutar la consulta preparada y capturar la excepción en caso de error
  try {
    $stmt->execute();
  } catch (Exception $e) {
    echo "Error al actualizar la imagen: " . $e->getMessage();
  }
  $stmt->close();
  
  // El usuario ha seleccionado la opción "mantener"
  if ($IdCurso === "mantener") {
    $IdCurso = $_POST["NomCurso_Actual"];
  }
  $sql_Actualizar = "UPDATE observador SET IdImgEst =?, NomEst=?, ApeEst=?, NumDocEst=?, IdDatAcudi =?, IdHistEsc =?, IdMed =?, IdCurso =?, TelEst=?, FecNacEst=?, LugNacEst=?, ResidenEst=?, EdadEst=? WHERE IdEst =?";
  $stmt = $conexion->prepare($sql_Actualizar);
  $stmt->bind_param('issiiiiisssssi', $IdImgEst, $NombreStu, $ApellidoStu, $NumeroIdentifStu, $IdDatAcudi, $IdHistEsc, $IdMed, $IdCurso, $TelefonoStu, $FechaNacimientoStu, $LugarNacimientoStu, $ResidenciaStu, $EdadStu, $IdEst);
  $stmt->execute();
  $stmt->close();
  /*FINALIZA ESTUDIANTE*/
  /*ACTUALIZA CURSOS*/
  $sql_curso = "UPDATE curso c SET NumAlumnos = (SELECT COUNT(*) FROM observador o 
    WHERE o.IdCurso = c.IdCurso)";
  mysqli_query($conexion, $sql_curso) or die ("ERROR EN LA INSERCION");
  /*FINALIZA ACTUALIZA CURSOS*/
  /*FINALIZA INSERCCION*/
  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE ACTUALIZARON CORRECTAMENTE')</script>";
  echo "<script>location.href = '/proyectos/DocuEstudia/controllers/teacher/AnnotationsSearch.php'</script>";
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
