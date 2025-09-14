<!-- ================ CRUD PARA STUDENT ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/DatabaseConnection.php");
// ========== Inicializar variables con valores por defecto ==========
// Guardian
$NombreGua = '';$ApellidoGua = '';$OcupacionGua = '';$TelefonoGua = '';$EmailGua = '';$ParentescoGua = '';$ViveAcudienteGua = '';
// Historial_escolar
$ColegioAnterior = '';$UltCursoCursado = '';$Jornada = '';$EsRepitente = '';$CuantasVeces = '';$PracticaDeporte = '';$NombreDeporte = '';
// info_medica
$Eps = '';$RestSanitaMed = '';$DiscapMed = '';$EnferMed = '';$Recomendaciones = '';$Antecendentes = '';$FornTipoSangre = '';
// Student
$NombreStu = '';$ApellidoStu = '';$TipoDcto = '';$TelefonoStu = '';$FechaNacimientoStu = '';$Direccion = '';$NumDcto = '';$IdGrado = '';$Email = '';$Password = '';$IdRol = 1;//Estudiante
// Recolecion ID Observador 
$IdObs = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdObs > 0;
// Consulta para Tipo de Sangre y mt_grados
$mt_grupos = "SELECT * FROM mt_grupos";
$mt_grupos = mysqli_query($conexion, $mt_grupos) or die(mysqli_error($conexion));
$mt_grados = "SELECT * FROM mt_grados";
$mt_grados = mysqli_query($conexion, $mt_grados) or die(mysqli_error($conexion));
$totalSangre = "SELECT * FROM mt_tsangre";
$totalSangre = mysqli_query($conexion, $totalSangre) or die(mysqli_error($conexion));
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["SendDataStudent"])) {
  // Guardian
  $IdDatAcudi = $_POST['IdGuardian'];$NombreGua = $_POST["nombre"];$ApellidoGua = $_POST["apellido"];$OcupacionGua = $_POST["ocupacion"];$TelefonoGua = $_POST["telefono"];$EmailGua = $_POST["emailgua"];$ParentescoGua = $_POST["parentesco"];$ViveAcudienteGua = $_POST["ViveAcudiente"];
  // Historial_escolar
  $IdHistEsc = $_POST['IdEscolar'];$ColegioAnterior = $_POST["Colegio_Anterior"];$UltCursoCursado = $_POST["Ult_Curso_Cursado"];$Jornada = $_POST["Jornada"];$EsRepitente = $_POST["Es_Repitente"];$CuantasVeces = $_POST["CuantasVeces"];$PracticaDeporte = $_POST["PracticaDeporte"];$NombreDeporte = $_POST["Nombre_Deporte"];
  // info_medica
  $IdMed = $_POST['IdMedica'];$Eps = $_POST["Eps"];$RestSanitaMed = $_POST["RestSanitaMed"];$DiscapMed = $_POST["DiscapMed"];$EnferMed = $_POST["EnferMed"];$Recomendaciones = $_POST["Recomendaciones"];$Antecendentes = $_POST["Antecendentes"];$FornTipoSangre = $_POST["FornTipoSangre"];
  // Student
  $IdObs = $_POST['IdObservador'];$IdUser = $_POST['IdUser'];$NombreStu = $_POST["Nombre_Est"];$ApellidoStu = $_POST["Apellido_Est"];$TipoDcto = $_POST["TipoDcto"];$NumDcto = $_POST["NumeroIdentif_Est"];$IdGrado = $_POST["FornIdGrado"];$IdGrupo = $_POST["FornIdGrupo"];$TelefonoStu = $_POST["Telefono_Est"];$FechaNacimientoStu = $_POST["Fecha_Nacimiento_Est"];$Direccion = $_POST["Residencia_Est"];$Email = $_POST["Correo"];$Password = $_POST["Contrasena"];
  //Recibimos Imagen POST
  $IdImg= $_POST['IdImg'];$TipoImagen = $_FILES['Imagen']['type'];$NombreImagenOriginal = $_FILES['Imagen']['name'];$Imagen_temporal = $_FILES['Imagen']['tmp_name'];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];
  if ($action === 'delete') {
    deleteStudent($conexion, $IdObs);
  } elseif ($action === 'create') {
    createStudent($conexion,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
      $ColegioAnterior,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
      $Eps,$RestSanitaMed,$DiscapMed,$EnferMed,$Recomendaciones,$Antecendentes,$FornTipoSangre,
      $NombreStu,$ApellidoStu,$TipoDcto,$NumDcto,$IdGrado,$IdGrupo,$TelefonoStu,$FechaNacimientoStu,$Direccion,$Email,$Password,$IdRol,
      $NombreImagenOriginal,$Imagen_temporal);
  } elseif ($action === 'update') {
    updateStudent($conexion,$IdDatAcudi,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
     $IdHistEsc,$ColegioAnterior,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
     $IdMed,$Eps,$RestSanitaMed,$DiscapMed,$EnferMed,$Recomendaciones,$Antecendentes,$FornTipoSangre,
     $IdObs,$IdUser,$NombreStu,$ApellidoStu,$TipoDcto,$NumDcto,$IdGrado,$IdGrupo,$TelefonoStu,$FechaNacimientoStu,$Direccion,$Email,$Password,$IdRol,
     $IdImg,$NombreImagenOriginal,$Imagen_temporal);
  } elseif ($action === 'read') {
    $StudentData = readStudent($conexion, $IdObs);
    // Asignar las variables desde el array devuelto
    // Guardian
    $IdDatAcudi = $StudentData['IdDatAcudi'];$NombreGua =$StudentData['NomAcudi'];$ApellidoGua = $StudentData['ApeAcudi'];$OcupacionGua = $StudentData['OcupacionAcudi'];$TelefonoGua = $StudentData['TelAcudi'];$EmailGua = $StudentData['EmailAcudi'];$ParentescoGua = $StudentData['ParentesAcudi'];$ViveAcudienteGua = $StudentData['ViveEstAcudi'];
    // Historial_escolar
    $IdHistEsc = $StudentData['IdHistEsc'];$ColegioAnterior = $StudentData["AnteriorEsc"];$UltCursoCursado = $StudentData["CursoEsc"];$Jornada = $StudentData["JornadaEsc"];$EsRepitente = $StudentData["RepitenteEsc"];$CuantasVeces = $StudentData["CantRepiEsc"];$PracticaDeporte = $StudentData["PracDeportEsc"];$NombreDeporte = $StudentData["NomDeportEsc"];
    // info_medica
    $IdMed = $StudentData['IdMed'];$Eps = $StudentData["NomEPSMed"];$RestSanitaMed = $StudentData["RestSanitaMed"];$DiscapMed = $StudentData["DiscapMed"];$EnferMed = $StudentData["EnferMed"];$Recomendaciones = $StudentData["RecomMed"];$Antecendentes = $StudentData["AnteceMed"];$IdTipoSanMed = $StudentData["IdTipoSanMed"];$NomTipoSangre = $StudentData["GrupoSanguineo"];
    // Student
    $IdObs = $StudentData['IdObs'];$IdUser = $StudentData['IdUser'];$IdImg= $StudentData['IdImg'];$NombreImagen = $StudentData['NomImg'];$NombreStu = $StudentData["Nombre"];$ApellidoStu = $StudentData["Apellido"];$TipoDcto = $StudentData["TipoDcto"];$NumDcto = $StudentData["NumDcto"];$IdGrado = $StudentData["IdGrado"];$IdGrupo = $StudentData["IdGrupo"];$NomGrado = $StudentData["NomGrado"];$TelefonoStu = $StudentData["Telefono"];$FechaNacimientoStu = $StudentData["FechNacimiento"];$Direccion = $StudentData["Direccion"];$Email = $StudentData["Email"];$Password = $StudentData["Password"];
  }  else {
    echo 'error';
  }
// Se inicia la busqueda automatica de los estudiantes
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $resultados = searchStudent($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $sql_observador = $resultados['sql_observador'];
  $totalFilas = $resultados['totalFilas'];
}
// ========== ELIMINAR DELETE FUNCTION ==========
function deleteStudent($conexion, $IdObs)
{
  mysqli_query($conexion, "delete from observador where IdObs='$IdObs'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
  // ---StartCurso
  $sql_curso = "UPDATE mt_grados c SET NumAlumnos = (SELECT COUNT(*) FROM observador o 
  WHERE o.IdGrado = c.IdGrado)";
  mysqli_query($conexion, $sql_curso) or die ("ERROR EN LA INSERCION" . $IdObs);
  mysqli_close($conexion);
  echo "<script>alert('SE ELIMINO CORRECTAMENTE')</script>";
  echo "<script>location.href='" . BASE_URL . "/controllers/teacher/AnnotationsSearch.php'</script>";
  exit;
}
// ========== CREAR CREATE FUNCTION ==========
function createStudent($conexion,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
  $ColegioAnterior,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
  $Eps,$RestSanitaMed,$DiscapMed,$EnferMed,$Recomendaciones,$Antecendentes,$FornTipoSangre,
  $NombreStu,$ApellidoStu,$TipoDcto,$NumDcto,$IdGrado,$IdGrupo,$TelefonoStu,$FechaNacimientoStu,$Direccion,$Email,$Password,$IdRol,
  $NombreImagenOriginal,$Imagen_temporal)
{
  // ---StartGuardian
  $insert_familiar = $conexion->prepare("INSERT INTO datos_familiar (NomAcudi, ApeAcudi, OcupacionAcudi, TelAcudi, EmailAcudi, ParentesAcudi, ViveEstAcudi) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $insert_familiar->bind_param("sssssss", $NombreGua, $ApellidoGua, $OcupacionGua, $TelefonoGua, $EmailGua, $ParentescoGua, $ViveAcudienteGua);
  $insert_familiar->execute();
  $insert_familiar->close();
  $ultimoId_DatosFamiliar = mysqli_insert_id($conexion);  // Last Id Insert 
  // ---StartHistorial_escolar
  $insert_historial = $conexion->prepare("INSERT INTO historial_escolar (AnteriorEsc, CursoEsc, JornadaEsc, RepitenteEsc, CantRepiEsc, PracDeportEsc, NomDeportEsc) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $insert_historial->bind_param("sssssss",$ColegioAnterior,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte);
  $insert_historial->execute();
  $insert_historial->close();
  $ultimoId_HistorialEscolar = mysqli_insert_id($conexion);  //  Last Id Insert
  // ---Startinfo_medicaEnferMed
  $insert_infomedica = $conexion->prepare("INSERT INTO info_medica  (NomEPSMed, RestSanitaMed, DiscapMed, EnferMed, RecomMed, AnteceMed, IdTipoSanMed)  VALUES (?, ?, ?, ?, ?, ?, ?)");
  $insert_infomedica->bind_param("ssssssi",$Eps,$RestSanitaMed,$DiscapMed,$EnferMed,$Recomendaciones,$Antecendentes,$FornTipoSangre);
  $insert_infomedica->execute();
  $insert_infomedica->close();
  $ultimoId_InfoMedica = mysqli_insert_id($conexion);  // Last Id Insert 
  // ---StartStudent
  // Obtener la extensión del archivo original
  $extension = pathinfo($NombreImagenOriginal, PATHINFO_EXTENSION);
  // Crear el nuevo nombre del archivo usando el número de documento
  $NombreImagen = "Estudiante_" . $NumDcto . "." . $extension;
  // Leer el contenido binario de la imagen
  $BinarioImagen = file_get_contents($Imagen_temporal);
  // Mover la imagen a la carpeta de destino
  move_uploaded_file($Imagen_temporal, ROOT_PATH."/assets/images/photostudent/$NombreImagen");
  // Insertar en la base de datos
  $sql_TbImagen = "INSERT INTO imagenes (IdRol,NomImg,BinImg) VALUES (?,?,?)";//MAX FILE SIZE 8MG
  $stmt = $conexion->prepare($sql_TbImagen); 
  $stmt->bind_param('iss', $IdRol, $NombreImagen, $BinarioImagen);
  $stmt->execute();
  $stmt->close();
  $ultimoId_Imagen = mysqli_insert_id($conexion);   // Last Id Insert
  $hashedPass = password_hash($Password, PASSWORD_DEFAULT); // Create password hash 
  // ---StartUsuario
  $insert_usuario = $conexion->prepare("INSERT INTO usuarios (IdRol, IdImg, Nombre, Apellido, TipoDcto, NumDcto, Telefono, FechNacimiento, Direccion, Email, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $insert_usuario->bind_param("iisssssssss",$IdRol,$ultimoId_Imagen,$NombreStu,$ApellidoStu,$TipoDcto,$NumDcto,$TelefonoStu,$FechaNacimientoStu, $Direccion,$Email,$hashedPass);
  $insert_usuario->execute();
  $insert_usuario->close();
  $ultimoId_Usuario = mysqli_insert_id($conexion);  // Last Id Insert 
  // ---StartObservador
  $insert_observador = $conexion->prepare("INSERT INTO observador (IdUser, IdDatAcudi, IdHistEsc, IdMed, IdGrado,IdGrupo) VALUES (?, ?, ?, ?, ?, ?)");
  $insert_observador->bind_param("iiiiii",$ultimoId_Usuario,$ultimoId_DatosFamiliar,$ultimoId_HistorialEscolar,$ultimoId_InfoMedica,$IdGrado,$IdGrupo);
  $insert_observador->execute();
  $insert_observador->close();
  // ---StartCurso
  $sql_curso = $conexion->prepare("UPDATE mt_grados c SET NumAlumnos = (SELECT COUNT(*) FROM observador o WHERE o.IdGrado = c.IdGrado)");
  $sql_curso->execute();
  $sql_curso->close();
  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE CREARON CORRECTAMENTE')</script>";
  echo "<script>location.href='" . BASE_URL . "/controllers/teacher/AnnotationsSearch.php'</script>";
}
// ========== ACTUALIZAR UPDATE FUNCTION ==========
function updateStudent($conexion,$IdDatAcudi,$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,
  $IdHistEsc,$ColegioAnterior,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,
  $IdMed,$Eps,$RestSanitaMed,$DiscapMed,$EnferMed,$Recomendaciones,$Antecendentes,$FornTipoSangre,
  $IdObs,$IdUser,$NombreStu,$ApellidoStu,$TipoDcto,$NumDcto,$IdGrado,$IdGrupo,$TelefonoStu,$FechaNacimientoStu,$Direccion,$Email,$Password,$IdRol,
  $IdImg,$NombreImagenOriginal,$Imagen_temporal)
{
  // ---StartGuardian
  // El usuario ha seleccionado la opción "mantener"
  if ($ViveAcudienteGua === "mantener") {
    $ViveAcudienteGua = $_POST["ViveAcu_Actual"];
  }
  // ---Startfamiliar
  $sql_familiar = $conexion->prepare("UPDATE datos_familiar SET NomAcudi = ?, ApeAcudi = ?, OcupacionAcudi = ?, TelAcudi = ?, EmailAcudi = ?, ParentesAcudi = ?, ViveEstAcudi = ? WHERE IdDatAcudi = ?");
  $sql_familiar->bind_param("sssssssi",$NombreGua,$ApellidoGua,$OcupacionGua,$TelefonoGua,$EmailGua,$ParentescoGua,$ViveAcudienteGua,$IdDatAcudi);
  $sql_familiar->execute();
  $sql_familiar->close();
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
  $sql_datosescolar = $conexion->prepare("UPDATE historial_escolar SET AnteriorEsc=?,CursoEsc=?,JornadaEsc=?,RepitenteEsc=?,CantRepiEsc=?,PracDeportEsc=?,NomDeportEsc=? WHERE IdHistEsc =?");
  $sql_datosescolar->bind_param("sssssssi",$ColegioAnterior,$UltCursoCursado,$Jornada,$EsRepitente,$CuantasVeces,$PracticaDeporte,$NombreDeporte,$IdHistEsc);
  $sql_datosescolar->execute();
  $sql_datosescolar->close();
  // ---Startinfo_medica
  // El usuario ha seleccionado la opción "mantener"
  if ($FornTipoSangre === "mantener") {
    $FornTipoSangre = $_POST["GrupSangui_Actual"];
  }
  $act_infomedica = $conexion->prepare("UPDATE info_medica SET NomEPSMed = ?, RestSanitaMed = ?, DiscapMed=?, EnferMed = ?, RecomMed = ?, AnteceMed = ?, IdTipoSanMed = ? WHERE IdMed = ?");
  $act_infomedica->bind_param("sssssssi", $Eps, $RestSanitaMed, $DiscapMed, $EnferMed, $Recomendaciones, $Antecendentes, $FornTipoSangre, $IdMed);
  $act_infomedica->execute();
  $act_infomedica->close();
  // Validamos si recibio o no imagen
  if (!empty($_FILES['Imagen']) && $_FILES['Imagen']['error'] === UPLOAD_ERR_OK) {
    // Comprueba si existe la imagen Anterior para Rename, Change Locate
    $Before_NameImage = $_POST["Nom_Imagen"];
    $rutaImagenAnterior = ROOT_PATH."/assets/images/photostudent/" . $Before_NameImage;
    if (file_exists($rutaImagenAnterior)) {
      $New_NameImage = "Obsolete_" . $Before_NameImage;
      rename($rutaImagenAnterior, ROOT_PATH."/assets/images/photostudent/photostudentobsolete/" . $New_NameImage);
    }
    // Obtener la extensión del archivo original
    $extension = pathinfo($NombreImagenOriginal, PATHINFO_EXTENSION);
    // Crear el nuevo nombre del archivo usando el número de documento
    $NombreImagen = "Estudiante_" . $NumDcto . "." . $extension;
    // Leer el contenido binario de la imagen
    $BinarioImagen = file_get_contents($Imagen_temporal);
    // Mover la imagen a la carpeta de destino
    move_uploaded_file($Imagen_temporal, ROOT_PATH."/assets/images/photostudent/$NombreImagen");
    // Actualizar en la base de datos utilizando una consulta preparada
    $sql_TbImagen = "UPDATE imagenes SET NomImg=?, BinImg=? WHERE IdImg=?";//MAX FILE SIZE 8MG
    $stmt = $conexion->prepare($sql_TbImagen);
    $stmt->bind_param('ssi', $NombreImagen, $BinarioImagen, $IdImg);
    // Ejecutar la consulta preparada y capturar la excepción en caso de error
    try {
      $stmt->execute();
    } catch (Exception $e) {
      echo "Error al actualizar la imagen: " . $e->getMessage();
    }
    $stmt->close();
  }
  // El usuario ha seleccionado la opción "mantener"
  if ($IdGrado === "mantener") {
    $IdGrado = $_POST["IdGrado_Actual"];
  }
  //Revisa si la contraseña cambia oh sigue igual
  $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE IdUser=$IdUser");
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  if ($fila = $resultado->fetch_assoc()) {
    if ($Password == $fila['Password']) {
      $hashedPass = $fila['Password'];
    } else {
      $hashedPass = password_hash($Password, PASSWORD_DEFAULT);
    }
  }
  if ($TipoDcto === "mantener") {
    $TipoDcto = $_POST["TipoDcto_Actual"];
  }
  // ---StartUsuario
  $act_usuario =  $conexion->prepare("UPDATE usuarios SET IdRol = ?, IdImg = ?, Nombre = ?, Apellido = ?, TipoDcto = ?, NumDcto = ?, Telefono = ?, FechNacimiento = ?, Direccion = ?, Email = ?, Password = ? WHERE IdUser = ?");
  $act_usuario->bind_param("iisssssssssi", $IdRol, $IdImg, $NombreStu, $ApellidoStu, $TipoDcto, $NumDcto, $TelefonoStu, $FechaNacimientoStu, $Direccion, $Email, $hashedPass, $IdUser);
  $act_usuario->execute();
  $act_usuario->close();
  // ---StartObservador
  $sql_Actualizar = "UPDATE observador SET IdDatAcudi =?, IdHistEsc =?, IdMed =?, IdGrado =?, IdGrupo =? WHERE IdObs =?";
  $stmt = $conexion->prepare($sql_Actualizar);
  $stmt->bind_param('iiiiii', $IdDatAcudi, $IdHistEsc, $IdMed, $IdGrado,$IdGrupo, $IdObs);
  $stmt->execute();
  $stmt->close();
  // ---StartCurso
  $sql_curso = $conexion->prepare("UPDATE mt_grados c SET NumAlumnos = (SELECT COUNT(*) FROM observador o WHERE o.IdGrado = c.IdGrado)");
  $sql_curso->execute();
  $sql_curso->close();
  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE ACTUALIZARON CORRECTAMENTE')</script>";
  echo "<script>location.href = '" . BASE_URL . "/controllers/teacher/AnnotationsSearch.php'</script>";
}
// ========== SHOW DATA FOR STUDENT UPDATE READ FUNCTION ==========
function readStudent($conexion, $IdObs)
{
  $stmt = $conexion->prepare("SELECT *,t.GrupoSanguineo,c.NomGrado,p.NomImg FROM observador o 
  JOIN datos_familiar d ON o.IdDatAcudi  = d.IdDatAcudi 
  JOIN historial_escolar h ON o.IdHistEsc  = h.IdHistEsc 
  LEFT JOIN info_medica i ON o.IdMed  = i.IdMed 
  LEFT JOIN mt_tsangre t ON i.IdTipoSanMed = t.IdTipoSanMed
  LEFT JOIN mt_grados c ON o.IdGrado = c.IdGrado 
  JOIN usuarios s ON s.IdUser = o.IdUser
  LEFT JOIN imagenes p ON p.IdImg = s.IdImg  WHERE IdObs = ?");
  $stmt->bind_param('i', $IdObs);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  }else {
    return null;
  }
}
// ========== SHOW DATA ALL STUDENTS FUNCTION ==========
function searchStudent($conexion,$dni = null)
{
  // Inicializa la variable de consulta con la búsqueda de todos los profesores
  $consultaSQL = "SELECT u.IdUser,o.IdObs,NumDcto,u.Nombre,u.Apellido,o.IdGrupo, c.NomGrado FROM observador o
  LEFT JOIN mt_grados c ON o.IdGrado = c.IdGrado
  LEFT JOIN mt_grupos g ON g.IdGrupo = o.IdGrupo
  LEFT JOIN usuarios u ON u.IdUser = o.IdUser";

  $conditions = []; // Aquí guardamos los filtros dinámicos

  // Filtros dinámicos
  if (!empty($_GET['DNI'])) {
      $dni = mysqli_real_escape_string($conexion, $_GET['DNI']);
      $conditions[] = "u.NumDcto = '$dni'";
  }

  if (!empty($_GET['Nombre'])) {
      $nombre = mysqli_real_escape_string($conexion, $_GET['Nombre']);
      $conditions[] = "u.Nombre LIKE '%$nombre%'";
  }

   if (!empty($_GET['Apellido'])) {
      $apellido = mysqli_real_escape_string($conexion, $_GET['Apellido']);
       $conditions[] = "u.Apellido LIKE '%$apellido%'";
   }

   if (!empty($_GET['Grado'])) {
       $Grado = (int) $_GET['Grado']; // entero, no hace falta escapar
       $conditions[] = "c.IdGrado = $Grado";
   }
  if (!empty($conditions)) {
      $whereSQL = " WHERE " . implode(" AND ", $conditions);
      $consultaSQL .= $whereSQL;
  }else {
      $whereSQL = ""; // Para reutilizar en el COUNT
  }
    // Consulta para contar el total
    $consultaCount = "SELECT COUNT(*) AS total
                  FROM observador o
                  LEFT JOIN usuarios u ON u.IdUser = o.IdUser 
                  LEFT JOIN mt_grupos c ON o.IdGrupo = c.IdGrupo
                  LEFT JOIN mt_grados g ON g.IdGrado = c.IdGrado
                  $whereSQL";
  // Realiza la consulta
  $sql_observador = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultCount = mysqli_query($conexion, $consultaCount);
  $datos = mysqli_fetch_assoc($resultCount);
  $totalFilas = $datos['total'];
  // Retorna las variables como un array
  return ['sql_observador' => $sql_observador,  'totalFilas' => $totalFilas];
}