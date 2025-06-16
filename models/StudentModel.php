<!-- ================ CRUD PARA STUDENT ================ -->
<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
// Conexion Base de Datos
include ("$RootPath/models/DatabaseConnection.php");
// Inicializar variables con valores por defecto
// Guardian
$NombreGua = '';
$ApellidoGua = '';
$OcupacionGua = '';
$TelefonoGua = '';
$EmailGua = '';
$ParentescoGua = '';
$ViveAcudienteGua = '';
// Historial_escolar
$ColegioAnterior = '';
$Direccion = '';
$UltCursoCursado = '';
$Jornada = '';
$EsRepitente = '';
$CuantasVeces = '';
$PracticaDeporte = '';
$NombreDeporte = '';
// info_medica
$Eps = '';
$Sanitaria = '';
$Ocupación = '';
$Recomendaciones = '';
$Antecendentes = '';
$FornTipoSangre = '';
// Student
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

//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["SendDataStudent"])) {
  // Guardian
  $IdDatAcudi = $_POST['IdGuardian'];
  $NombreGua = $_POST["nombre"];
  $ApellidoGua = $_POST["apellido"];
  $OcupacionGua = $_POST["ocupacion"];
  $TelefonoGua = $_POST["telefono"];
  $EmailGua = $_POST["email"];
  $ParentescoGua = $_POST["parentesco"];
  $ViveAcudienteGua = $_POST["ViveAcudiente"];
  // Historial_escolar
  $IdHistEsc = $_POST['IdEscolar'];
  $ColegioAnterior = $_POST["Colegio_Anterior"];
  $Direccion = $_POST["Direccion"];
  $UltCursoCursado = $_POST["Ult_Curso_Cursado"];
  $Jornada = $_POST["Jornada"];
  $EsRepitente = $_POST["Es_Repitente"];
  $CuantasVeces = $_POST["CuantasVeces"];
  $PracticaDeporte = $_POST["PracticaDeporte"];
  $NombreDeporte = $_POST["Nombre_Deporte"];
  // info_medica
  $IdMed = $_POST['IdMedica'];
  $Eps = $_POST["Eps"];
  $Sanitaria = $_POST["Sanitaria"];
  $Ocupación = $_POST["Ocupación"];
  $Recomendaciones = $_POST["Recomendaciones"];
  $Antecendentes = $_POST["Antecendentes"];
  $FornTipoSangre = $_POST["FornTipoSangre"];
  // Student
  $IdEst = $_POST['IdObservador'];
  $NombreStu = $_POST["Nombre_Est"];
  $ApellidoStu = $_POST["Apellido_Est"];
  $NumeroIdentifStu = $_POST["NumeroIdentif_Est"];
  $IdCurso = $_POST["FornCurso"];
  $TelefonoStu = $_POST["Telefono_Est"];
  $FechaNacimientoStu = $_POST["Fecha_Nacimiento_Est"];
  $LugarNacimientoStu = $_POST["Lugar_Nacimiento_Est"];
  $ResidenciaStu = $_POST["Residencia_Est"];
  $EdadStu = $_POST["Edad_Est"];
  //Recibimos Imagen POST
  $IdImgEst = $_POST['IdImgEst'];
  $TipoImagen = $_FILES['Imagen']['type'];
  $NombreImagenOriginal = $_FILES['Imagen']['name'];
  $Imagen_temporal = $_FILES['Imagen']['tmp_name'];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
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
  } elseif ($action === 'update') {
    updateStudent($RootPath,$conexion,$IdDatAcudi,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
      $IdHistEsc,$ColegioAnterior,$Direccion,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
      $IdMed,$Eps,$Sanitaria,$Ocupación,$Recomendaciones,$Antecendentes,$FornTipoSangre,
      $IdEst,$NombreStu,$ApellidoStu,$NumeroIdentifStu,$IdCurso,$TelefonoStu,$FechaNacimientoStu,$LugarNacimientoStu,$ResidenciaStu,$EdadStu,
      $IdImgEst,$TipoEntidad,$NombreImagenOriginal,$Imagen_temporal);
  } elseif ($action === 'read') {
    $StudentData = readStudent($conexion, $id);
    // Asignar las variables desde el array devuelto
    // Guardian
    $IdDatAcudi = $StudentData['IdDatAcudi'];
    $NombreGua =$StudentData['NomAcudi'];
    $ApellidoGua = $StudentData['ApeAcudi'];
    $OcupacionGua = $StudentData['OcupacionAcudi'];
    $TelefonoGua = $StudentData['TelAcudi'];
    $EmailGua = $StudentData['EmailAcudi'];
    $ParentescoGua = $StudentData['ParentesAcudi'];
    $ViveAcudienteGua = $StudentData['ViveEstAcudi'];
    // Historial_escolar
    $IdHistEsc = $StudentData['IdHistEsc'];
    $ColegioAnterior = $StudentData["AnteriorEsc"];
    $Direccion = $StudentData["DireccionEsc"];
    $UltCursoCursado = $StudentData["CursoEsc"];
    $Jornada = $StudentData["JornadaEsc"];
    $EsRepitente = $StudentData["RepitenteEsc"];
    $CuantasVeces = $StudentData["CantRepiEsc"];
    $PracticaDeporte = $StudentData["PracDeportEsc"];
    $NombreDeporte = $StudentData["NomDeportEsc"];
    // info_medica
    $IdMed = $StudentData['IdMed'];
    $Eps = $StudentData["NomEPSMed"];
    $Sanitaria = $StudentData["PrioSanitaMed"];
    $Ocupación = $StudentData["OcupaMed"];
    $Recomendaciones = $StudentData["RecomMed"];
    $Antecendentes = $StudentData["AnteceMed"];
    $IdTipoSangre = $StudentData["IdTipoSanMed"];
    $NomTipoSangre = $StudentData["GrupoSanguineo"];
    // Student
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
    // Consulta para Tipo de Sangre y Curso
    $totalSangre = "SELECT * FROM tipo_sangre";
    $totalSangre = mysqli_query($conexion, $totalSangre) or die(mysqli_error($conexion));
    $totalCurso = "SELECT * FROM curso";
    $totalCurso = mysqli_query($conexion, $totalCurso) or die(mysqli_error($conexion));
  }  else {
    echo 'error';
  }
// Se inicia la busqueda automatica de los estudiantes
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
  // ---StartCurso
  $sql_curso = "UPDATE curso c SET NumAlumnos = (SELECT COUNT(*) FROM observador o 
  WHERE o.IdCurso = c.IdCurso)";
  mysqli_query($conexion, $sql_curso) or die ("ERROR EN LA INSERCION" . $id);
  mysqli_close($conexion);
  // ---EndCurso
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
  // ---StartGuardian
  $sql_detalle = "INSERT INTO datos_familiar(NomAcudi,ApeAcudi,OcupacionAcudi	,TelAcudi,EmailAcudi,ParentesAcudi,ViveEstAcudi) VALUES(
    '" . $NombreGua . "','" . $ApellidoGua . "','" . $OcupacionGua . "','" . $TelefonoGua . "','" . $EmailGua . "','" . $ParentescoGua . "','" . $ViveAcudienteGua. "')";
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION");
  // Last Id Insert 
  $ultimoId_DatosFamiliar = mysqli_insert_id($conexion);
  // ---EndGuardian
  // ---StartHistorial_escolar
  $sql_detalle = "INSERT INTO historial_escolar(AnteriorEsc,DireccionEsc,CursoEsc,JornadaEsc,RepitenteEsc,CantRepiEsc,PracDeportEsc,NomDeportEsc) VALUES(
    '" . $ColegioAnterior . "','" . $Direccion . "','" . $UltCursoCursado . "','" . $Jornada . "','" . $EsRepitente . "','" . $CuantasVeces . "','" . $PracticaDeporte . "','" . $NombreDeporte . "')";
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION");
  //  Last Id Insert
  $ultimoId_HistorialEscolar = mysqli_insert_id($conexion);
  // ---EndHistorial_escolar
  // ---Startinfo_medica
  $sql_detalle = "INSERT INTO info_medica(NomEPSMed,PrioSanitaMed,OcupaMed,RecomMed,AnteceMed,IdTipoSanMed ) VALUES(
    '" . $Eps . "','" . $Sanitaria . "','" . $Ocupación . "','" . $Recomendaciones . "','" . $Antecendentes . "','" . $FornTipoSangre . "')";
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION");
  // Last Id Insert 
  $ultimoId_InfoMedica = mysqli_insert_id($conexion);
  // ---Endinfo_medica
  // ---StartStudent
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
  // Last Id Insert 
  $ultimoId_Imagen = mysqli_insert_id($conexion);
  $sql_detalle = "INSERT INTO observador(NomEst,IdImgEst,ApeEst,NumDocEst,IdDatAcudi ,IdHistEsc ,IdMed,IdCurso,TelEst,FecNacEst,LugNacEst,ResidenEst,EdadEst) VALUES(
    '" . $NombreStu . "','" . $ultimoId_Imagen . "','" . $ApellidoStu . "','" . $NumeroIdentifStu . "','" . $ultimoId_DatosFamiliar . "','" . $ultimoId_HistorialEscolar . "',
    '" . $ultimoId_InfoMedica . "','" . $IdCurso . "','" . $TelefonoStu . "','" . $FechaNacimientoStu . "','" . $LugarNacimientoStu . "','" . $ResidenciaStu . "','" . $EdadStu . "')";
  // Insertar datos en la tabla 
  mysqli_query($conexion, $sql_detalle) or die ("ERROR EN LA INSERCION");
  // ---EndStudent
  // ---StartCurso
  $sql_curso = "UPDATE curso c SET NumAlumnos = (SELECT COUNT(*) FROM observador o WHERE o.IdCurso = c.IdCurso)";
  mysqli_query($conexion, $sql_curso) or die ("ERROR EN LA INSERCION");
  // ---EndCurso
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
  // ---StartGuardian
  // El usuario ha seleccionado la opción "mantener"
  if ($ViveAcudienteGua === "mantener") {
    $ViveAcudienteGua = $_POST["ViveAcu_Actual"];
  }
  $sql_Actualizar = "UPDATE datos_familiar SET NomAcudi='" . $NombreGua . "',ApeAcudi='" . $ApellidoGua . "',OcupacionAcudi='" . $OcupacionGua . "'
    ,TelAcudi='" . $TelefonoGua . "',EmailAcudi='" . $EmailGua . "',ParentesAcudi='" . $ParentescoGua . "',ViveEstAcudi='" . $ViveAcudienteGua . "' WHERE IdDatAcudi=" . $IdDatAcudi;
  mysqli_query($conexion, $sql_Actualizar) or die ("ERROR EN LA INSERCION");
  // ---EndGuardian
  // ---StartHistorial_escolar
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
  mysqli_query($conexion, $sql_Actualizar) or die ("ERROR EN LA INSERCION");
  // ---EndHistorial_escolar
  // ---Startinfo_medica
  // El usuario ha seleccionado la opción "mantener"
  if ($FornTipoSangre === "mantener") {
    $FornTipoSangre = $_POST["GrupSangui_Actual"];
  }
  $sql_Actualizar = "UPDATE info_medica SET NomEPSMed='" . $Eps . "',PrioSanitaMed='" . $Sanitaria . "',OcupaMed='" . $Ocupación . "'
    ,RecomMed='" . $Recomendaciones . "',AnteceMed='" . $Antecendentes . "',IdTipoSanMed ='" . $FornTipoSangre . "' 
    WHERE IdMed =" . $IdMed;
  mysqli_query($conexion, $sql_Actualizar) or die ("ERROR EN LA INSERCION");
  // ---Endinfo_medica
  // Validamos si recibio o no imagen
  if (!empty($_FILES['Imagen']) && $_FILES['Imagen']['error'] === UPLOAD_ERR_OK) {
    // Comprueba si existe la imagen Anterior para Rename, Change Locate
    $Before_NameImage = $_POST["Nom_Imagen"];
    $rutaImagenAnterior = "$RootPath/assets/images/photostudent/" . $Before_NameImage;
    if (file_exists($rutaImagenAnterior)) {
      $New_NameImage = "Obsolete_" . $Before_NameImage;
      rename($rutaImagenAnterior, "$RootPath/assets/images/photostudent/photostudentobsolete/" . $New_NameImage);
    }
    // Obtener la extensión del archivo original
    $extension = pathinfo($NombreImagenOriginal, PATHINFO_EXTENSION);
    // Crear el nuevo nombre del archivo usando el número de documento
    $NombreImagen = "Estudiante_" . $NumeroIdentifStu . "." . $extension;
    // Leer el contenido binario de la imagen
    $BinarioImagen = file_get_contents($Imagen_temporal);
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
  }
  // El usuario ha seleccionado la opción "mantener"
  if ($IdCurso === "mantener") {
    $IdCurso = $_POST["NomCurso_Actual"];
  }
  // ---StartStudent
  $sql_Actualizar = "UPDATE observador SET IdImgEst =?, NomEst=?, ApeEst=?, NumDocEst=?, IdDatAcudi =?, IdHistEsc =?, IdMed =?, IdCurso =?, 
    TelEst=?, FecNacEst=?, LugNacEst=?, ResidenEst=?, EdadEst=? WHERE IdEst =?";
  $stmt = $conexion->prepare($sql_Actualizar);
  $stmt->bind_param('issiiiiisssssi', $IdImgEst, $NombreStu, $ApellidoStu, $NumeroIdentifStu, $IdDatAcudi, $IdHistEsc, $IdMed, $IdCurso, 
    $TelefonoStu, $FechaNacimientoStu, $LugarNacimientoStu, $ResidenciaStu, $EdadStu, $IdEst);
  $stmt->execute();
  $stmt->close();
  // ---EndStudent
  // ---StartCurso
  $sql_curso = "UPDATE curso c SET NumAlumnos = (SELECT COUNT(*) FROM observador o WHERE o.IdCurso = c.IdCurso)";
  mysqli_query($conexion, $sql_curso) or die ("ERROR EN LA INSERCION");
  // ---EndCurso
  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE ACTUALIZARON CORRECTAMENTE')</script>";
  echo "<script>location.href = '/proyectos/DocuEstudia/controllers/teacher/AnnotationsSearch.php'</script>";
}
// ========== LEER READ FUNCTION ==========
function readStudent($conexion, $id)
{
  $stmt = $conexion->prepare("SELECT *, t.GrupoSanguineo,c.NomCurso,p.NomImg FROM observador o 
  JOIN datos_familiar d ON o.IdDatAcudi  = d.IdDatAcudi JOIN historial_escolar h ON o.IdHistEsc  = h.IdHistEsc 
  JOIN info_medica i ON o.IdMed  = i.IdMed JOIN tipo_sangre t ON i.IdTipoSanMed = t.IdTipoSanMed
  JOIN curso c ON o.IdCurso = c.IdCurso JOIN imagenes p ON o.IdImgEst = p.IdImg WHERE IdEst = ?");
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
  $consultaSQL = ("SELECT CONCAT(o.NomEst, ' ', o.ApeEst) AS NombreCompleto, o.*, c.NomCurso FROM observador o 
  LEFT JOIN curso c ON o.IdCurso = c.IdCurso") or die("ERROR AL TRAER LOS DATOS");
  $query = "SELECT COUNT(*) AS total FROM observador";
  // Verifica si se envió el formulario de búsqueda
  if (!empty($_GET['DNI'])) {
    $NumDocEst = $_GET['DNI'];
    $query = "SELECT COUNT(*) AS total FROM observador WHERE NumDocEst=$NumDocEst";
    // Modifica la consulta para filtrar por número de documento
    $consultaSQL .= " WHERE o.NumDocEst='$NumDocEst'";
  }
  // Realiza la consulta
  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultado = mysqli_query($conexion, $query);
  $datos = mysqli_fetch_assoc($resultado);
  $totalFilas = $datos['total'];
  // Retorna las variables como un array
  return ['consultar' => $consultar, 'totalFilas' => $totalFilas];
}
