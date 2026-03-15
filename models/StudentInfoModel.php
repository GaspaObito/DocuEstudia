<?php
/* ==========================================
   MODEL: StudentInfo.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(ROOT_PATH . "/models/DatabaseConnection.php");

if (isset($_POST['NumeroModificar'])) {
   $_SESSION['Id_Session'] = $_POST['NumeroModificar'];
}
$IdObs = $_SESSION['Id_Session']??0;
$Id_Profe = $_SESSION['user_id'];

$datos = [];
/* -------- DatosUsuario -------- */
$DatosUsuario = mysqli_query($conexion, "SELECT o.*,CONCAT(u.Nombre, ' ', u.Apellido) AS NombreCompleto,u.*,d.NomGrupo, c.NomGrado, i.NomImg
   FROM observador o LEFT JOIN mt_grados c ON o.IdGrado = c.IdGrado LEFT JOIN mt_grupos d ON d.IdGrupo = o.IdGrupo LEFT JOIN usuarios u ON u.IdUser = o.IdUser LEFT JOIN imagenes i ON i.IdImg= u.IdImg  
   WHERE o.IdObs='$IdObs'") or die("ERROR AL TRAER LOS DATOS");

  while ($extraido = mysqli_fetch_array($DatosUsuario)) {
    $datos[] = $extraido;
  }

/* -------- DatosUsuarioEspecifico -------- */
$DatosUsuario2 = mysqli_query($conexion, "SELECT CONCAT(u.Nombre, ' ', u.Apellido) AS NombreCompleto, o.*,u.*, c.NomGrado 
   FROM observador o LEFT JOIN mt_grados c ON o.IdGrado = c.IdGrado LEFT JOIN usuarios u ON u.IdUser = o.IdUser 
   WHERE o.IdObs='$IdObs'") or die("ERROR AL TRAER LOS DATOS");

/* -------- DatosMedicos -------- */
$DatosMedicos = mysqli_query($conexion, "SELECT o.*, i.*, i.NomEPSMed, t.GrupoSanguineo 
   FROM observador o LEFT JOIN info_medica i ON o.IdMed = i.IdMed LEFT JOIN mt_tsangre t ON i.IdTipoSanMed = t.IdTipoSanMed 
   WHERE o.IdObs = '$IdObs'") or die("ERROR AL TRAER LOS DATOS");

/* -------- DatosAcudiente -------- */
$DatosAcudiente = mysqli_query($conexion, "SELECT o.*, i.*, i.NomAcudi
   FROM observador o LEFT JOIN datos_familiar i ON o.IdDatAcudi = i.IdDatAcudi 
   WHERE o.IdObs = '$IdObs'") or die("ERROR AL TRAER LOS DATOS");

/* -------- DatosHistorialEscolar -------- */
$DatosHistorialEscolar = mysqli_query($conexion, "SELECT o.*, i.*, i.AnteriorEsc 
   FROM observador o LEFT JOIN historial_escolar i ON o.IdHistEsc = i.IdHistEsc
   WHERE o.IdObs = '$IdObs'") or die("ERROR AL TRAER LOS DATOS");

/* -------- DatosTeacher -------- */
$DatosTeacher = mysqli_query($conexion, "SELECT CONCAT(Nombre, ' ', Apellido) AS NombreCompleto, u.*, i.NomImg,p.AsigAcadeProf,p.IdMateria,mm.NomMateria
   FROM usuarios u LEFT JOIN imagenes i ON i.IdImg = u.IdImg LEFT JOIN profesor p ON p.IdUser = u.IdUser LEFT JOIN mt_materias mm ON mm.IdMateria = p.IdMateria
   WHERE u.IdUser='$Id_Profe'") or die("ERROR AL TRAER LOS DATOS");