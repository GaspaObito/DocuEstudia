<?php
/* ==========================================
   CONTROLLER: StudenController.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/StudentModel.php");
require_once(ROOT_PATH . "/models/CommonModel.php");

/* ---------- 2. ESTADO INICIAL ---------- */
$changePage = 0;
// Guardian
$NombreGua = ''; $ApellidoGua = ''; $OcupacionGua = ''; $TelefonoGua = ''; $EmailGua = ''; $ParentescoGua = ''; $ViveAcudienteGua = '';
// Historial_escolar
$ColegioAnterior = '';$UltCursoCursado = ''; $Jornada = ''; $EsRepitente = ''; $CuantasVeces = ''; $PracticaDeporte = ''; $NombreDeporte = '';
// info_medica
$Eps = ''; $RestSanitaMed = ''; $DiscapMed = ''; $EnferMed = ''; $Recomendaciones = ''; $Antecendentes = ''; $FornTipoSangre = '';
// Student
$NombreStu = ''; $ApellidoStu = ''; $TipoDcto = ''; $TelefonoStu = ''; $FechaNacimientoStu = ''; $Direccion = ''; $NumDcto = ''; $IdGrado = ''; $Email = ''; $Password = ''; $IdRol = 1;//Estudiante

/* Variables del formulario */
$IdObs = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$IdGrado = $IdObs;
$isUpdate = $IdObs > 0;

/* ---------- 3. HELPERS ---------- */
function goToAnnotatSearchList()
{
  redirectTo("/views/admin/ManageStudents.php");
}

/* ---------- 4. ROUTING ---------- */
$method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["SendDataStudent"])) {
  // Guardian
  $IdDatAcudi = $_POST['IdGuardian'];$NombreGua = $_POST["nombre"];
  $ApellidoGua = $_POST["apellido"]; $OcupacionGua = $_POST["ocupacion"]; $TelefonoGua = $_POST["telefono"]; $EmailGua = $_POST["emailgua"]; $ParentescoGua = $_POST["parentesco"];
  $ViveAcudienteGua = $_POST["ViveAcudiente"];
  // Historial_escolar
  $IdHistEsc = $_POST['IdEscolar']; $ColegioAnterior = $_POST["Colegio_Anterior"]; $UltCursoCursado = $_POST["Ult_Curso_Cursado"];
  $Jornada = $_POST["Jornada"]; $EsRepitente = $_POST["Es_Repitente"]; $CuantasVeces = $_POST["CuantasVeces"]; $PracticaDeporte = $_POST["PracticaDeporte"]; $NombreDeporte = $_POST["Nombre_Deporte"];
  // info_medica
  $IdMed = $_POST['IdMedica']; $Eps = $_POST["Eps"]; $RestSanitaMed = $_POST["RestSanitaMed"]; $DiscapMed = $_POST["DiscapMed"];
  $EnferMed = $_POST["EnferMed"]; $Recomendaciones = $_POST["Recomendaciones"]; $Antecendentes = $_POST["Antecendentes"]; $FornTipoSangre = $_POST["FornTipoSangre"];
  // Student
  $IdObs = $_POST['IdObservador']; $IdUser = $_POST['IdUser']; $NombreStu = $_POST["Nombre_Est"];
  $ApellidoStu = $_POST["Apellido_Est"]; $TipoDcto = $_POST["TipoDcto"]; $NumDcto = $_POST["NumeroIdentif_Est"]; $IdGrado = $_POST["FornIdGrado"]; $IdGrupo = $_POST["FornIdGrupo"];
  $TelefonoStu = $_POST["Telefono_Est"]; $FechaNacimientoStu = $_POST["Fecha_Nacimiento_Est"]; $Direccion = $_POST["Residencia_Est"]; $Email = $_POST["Correo"]; $Password = $_POST["Contrasena"];
  //Recibimos Imagen POST
  $IdImg = $_POST['IdImg']; $TipoImagen = $_FILES['Imagen']['type']; $NombreImagenOriginal = $_FILES['Imagen']['name']; $Imagen_temporal = $_FILES['Imagen']['tmp_name'];
}
/* ---------- 5. POST ACTIONS ---------- */
if ($method === 'POST') {

  switch ($action) {
    
    /* -------- CREATE -------- */
    case 'create':
      if (createStudent($conexion, $NombreGua, $ApellidoGua, $OcupacionGua, $TelefonoGua, $EmailGua, $ParentescoGua, $ViveAcudienteGua, $ColegioAnterior, $UltCursoCursado, $Jornada, $EsRepitente, $CuantasVeces, $PracticaDeporte, $NombreDeporte, $Eps, $RestSanitaMed, $DiscapMed, $EnferMed, $Recomendaciones, $Antecendentes, $FornTipoSangre, $NombreStu, $ApellidoStu, $TipoDcto, $NumDcto, $IdGrado, $IdGrupo, $TelefonoStu, $FechaNacimientoStu, $Direccion, $Email, $Password, $IdRol, $NombreImagenOriginal, $Imagen_temporal)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se creo Correctamente el Estudiante #' . $ultimoId_Usuario];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #'];
      }
      goToAnnotatSearchList();
      break;

    /* -------- UPDATE -------- */
    case 'update':
      if (updateStudent( $conexion, $IdDatAcudi, $NombreGua, $ApellidoGua, $OcupacionGua, $TelefonoGua, $EmailGua, $ParentescoGua, $ViveAcudienteGua, $IdHistEsc, $ColegioAnterior, $UltCursoCursado, $Jornada, $EsRepitente, $CuantasVeces,$PracticaDeporte,$NombreDeporte,$IdMed,$Eps,$RestSanitaMed, $DiscapMed, $EnferMed, $Recomendaciones, $Antecendentes, $FornTipoSangre, $IdObs, $IdUser, $NombreStu, $ApellidoStu, $TipoDcto, $NumDcto, $IdGrado, $IdGrupo, $TelefonoStu, $FechaNacimientoStu, $Direccion, $Email, $Password, $IdRol, $IdImg, $NombreImagenOriginal, $Imagen_temporal)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se actualizo Correctamente el Estudiante #' . $IdUser];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #'. $IdUser];
      }
      goToAnnotatSearchList();
      break;

    /* -------- DELETE -------- */
    case 'delete':
      if (deleteStudent($conexion, $IdObs)) {
        $_SESSION['alerts'][] = ['type' => 'success', 'text' => 'Se elimino Correctamente el Estudiante #' . $IdObs];
      } else {
        $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'ERROR en la ejecucion #' . $IdObs];
      }
      goToAnnotatSearchList();
      break;

    /* -------- READ -------- */
    case 'read':
      $StudentData = readStudent($conexion, $IdObs);
      // Guardian
      $IdDatAcudi = $StudentData['IdDatAcudi']; $NombreGua = $StudentData['NomAcudi']; $ApellidoGua = $StudentData['ApeAcudi']; $OcupacionGua = $StudentData['OcupacionAcudi']; $TelefonoGua = $StudentData['TelAcudi']; $EmailGua = $StudentData['EmailAcudi']; $ParentescoGua = $StudentData['ParentesAcudi']; $ViveAcudienteGua = $StudentData['ViveEstAcudi'];
      // Historial_escolar
      $IdHistEsc = $StudentData['IdHistEsc']; $ColegioAnterior = $StudentData["AnteriorEsc"]; $UltCursoCursado = $StudentData["CursoEsc"]; $Jornada = $StudentData["JornadaEsc"]; $EsRepitente = $StudentData["RepitenteEsc"]; $CuantasVeces = $StudentData["CantRepiEsc"]; $PracticaDeporte = $StudentData["PracDeportEsc"]; $NombreDeporte = $StudentData["NomDeportEsc"];
      // info_medica
      $IdMed = $StudentData['IdMed']; $Eps = $StudentData["NomEPSMed"]; $RestSanitaMed = $StudentData["RestSanitaMed"]; $DiscapMed = $StudentData["DiscapMed"]; $EnferMed = $StudentData["EnferMed"]; $Recomendaciones = $StudentData["RecomMed"]; $Antecendentes = $StudentData["AnteceMed"]; $IdTipoSanMed = $StudentData["IdTipoSanMed"]; $NomTipoSangre = $StudentData["GrupoSanguineo"];
      // Student
      $IdObs = $StudentData['IdObs']; $IdUser = $StudentData['IdUser']; $IdImg = $StudentData['IdImg']; $NombreImagen = $StudentData['NomImg']; $NombreStu = $StudentData["Nombre"]; $ApellidoStu = $StudentData["Apellido"]; $TipoDcto = $StudentData["TipoDcto"]; $NumDcto = $StudentData["NumDcto"]; $IdGrado = $StudentData["IdGrado"]; $IdGrupo = $StudentData["IdGrupo"]; $NomGrado = $StudentData["NomGrado"]; $TelefonoStu = $StudentData["Telefono"]; $FechaNacimientoStu = $StudentData["FechNacimiento"]; $Direccion = $StudentData["Direccion"]; $Email = $StudentData["Email"]; $Password = $StudentData["Password"];
      break;
     
    /* -------- READ BY STUDENTS -------- */
    case 'listarNOTAS':
      $changePage = 1;
      $resultados = getStudentsByGradeAndGroup($conexion, $IdGrado);
      $sql_observador = $resultados['estudiantes'];
      $totalFilas = $resultados['totalFilas'];
      break;
    // Se inicia la busqueda automatica de los estudiantes
  }
}

/* ---------- 6. GET ACTIONS ---------- */
elseif ($method === 'GET') {
  $resultados = searchStudent($conexion);
  $sql_observador = $resultados['sql_observador'];
  $totalFilas = $resultados['totalFilas'];
}