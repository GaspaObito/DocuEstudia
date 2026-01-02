<!-- ================ CRUD PARA Group ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/DatabaseConnection.php");
// Inicializar variables con valores por defecto
$IdGrupo = ''; $IdGrado = ''; $IdProf = ''; $NomGrupo = ''; $NomGrado = '';
// Recolecion ID
$IdGrupo = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdGrupo > 0;

$IdGrado = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdGrado > 0;
// Consulta para Tipo de Sangre y mt_grados
$mt_grados = "SELECT * FROM mt_grados";
$mt_grados = mysqli_query($conexion, $mt_grados) or die(mysqli_error($conexion));
$mt_grupos = "SELECT * FROM mt_grupos";
$mt_grupos = mysqli_query($conexion, $mt_grupos) or die(mysqli_error($conexion));
$mt_profesores = "SELECT *,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto FROM profesor pr LEFT JOIN usuarios us ON us.IdUser = pr.IdUser  ";
$mt_profesores = mysqli_query($conexion, $mt_profesores) or die(mysqli_error($conexion));
function goToGroupList()
{
  redirectTo("/views/subject/MtGroups.php?action=listarGRPS");
}
function goToGradeList()
{
  redirectTo("/views/subject/MtGrades.php?action=listarGRDS");
}
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["EnviarGrade"])) {
  $IdGrado = $_POST['IdGrado']?? $_POST['IdGrado_Actual'];;
  $NomGrado = $_POST['NomGrado'];
}
if (isset($_POST["Enviar2"])) {
  $IdGrupo = $_POST['IdGrupo'] ?? $_POST['IdGrupo_Actual'];
  $IdGrado = $_POST['FornIdGrado']; $IdProf = $_POST['FornIdProf']; $NomGrupo = $_POST['NomGrupo'];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];

  switch ($action) {
    case 'deleteGroup':
      deleteGroup($conexion, $IdGrupo);
      break;
    case 'createGroup':
      createGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo);
      break;
    case 'updateGroup':
      updateGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo);
      break;
    case 'readGroup':
      $groupData = readGroup($conexion, $IdGrupo);
      $IdGrupo = $groupData['IdGrupo'];$IdGrado = $groupData['IdGrado'];$IdProf = $groupData['IdProf'];$NomGrado = $groupData['NomGrado'];$NombreCompleto = $groupData['NombreCompleto'];$NomGrupo = $groupData['NomGrupo'];
      break;
    // GRADE OPTIONS
    case 'deleteGrade':
      deleteGrade($conexion, $IdGrado);
      break;
    case 'createGrade':
      createGrade($conexion, $IdGrado,$NomGrado);
      break;
    case 'updateGrade':
      updateGrade($conexion, $IdGrado, $NomGrado);
      break;
    case 'readGrade':
      $groupData = readGrade($conexion, $IdGrado);
      $IdGrado = $groupData['IdGrado'];$NomGrado = $groupData['NomGrado'];
      break;
  }
// ========== SHOW ALL DATA ==========
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($action = $_GET['action'] ?? '') === 'listarGRPS') {//CONSULTA TODO GROUP
  $resultados = searchGroup($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($action = $_GET['action'] ?? '') === 'listarGRDS') {//CONSULTA TODO GRADE
  $resultados = searchGrades($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}
// ========== ELIMINAR DELETE FUNCTION GROUP ==========
function deleteGroup($conexion, $IdGrupo)
{
  mysqli_query($conexion, "delete from mt_grupos where IdGrupo='$IdGrupo'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
  mysqli_close($conexion);
  $_SESSION['alerts'][] = ['type' => 'success','text' => 'Se elimino Correctamente el Grupo #'.$IdGrupo];
  goToGroupList();
}
// ========== CREAR CREATE FUNCTION GROUP ==========
function createGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo)
{
  $creagrupo = $conexion->prepare("INSERT INTO mt_grupos (IdGrupo,IdGrado,IdProf,NomGrupo) VALUES (?,?,?,?)");
  $creagrupo->bind_param('isss', $IdGrupo, $IdGrado, $IdProf, $NomGrupo);
  $creagrupo->execute();
  $creagrupo->close();
  $_SESSION['alerts'][] = ['type' => 'success','text' => 'Se creo Correctamente el Grupo #'.$IdGrupo];
  goToGroupList();
}

// ========== ACTUALIZAR UPDATE FUNCTION GROUP ==========
function updateGroup($conexion, $IdGrupo, $IdGrado, $IdProf, $NomGrupo)
{
  if ($IdGrado === "mantener") {
    $IdGrado = $_POST["IdGrado_Actual"];
  } elseif ($IdGrado === "quitar") {
    $IdGrado = null;
  }
  if ($IdProf === "mantener") {
    $IdProf = $_POST["IdProf_Actual"];
  } elseif ($IdProf === "quitar") {
    $IdProf = null;
  }
  // 1. Actualizar tabla usuarios 
  $actgrupo = $conexion->prepare("UPDATE mt_grupos SET  IdGrado = ?, IdProf = ?, NomGrupo = ? WHERE IdGrupo = ?");
  $actgrupo->bind_param('iisi', $IdGrado, $IdProf, $NomGrupo, $IdGrupo);
  $actgrupo->execute();
  $actgrupo->close();
  $_SESSION['alerts'][] = ['type' => 'success','text' => 'Se actualizo Correctamente el Grupo #'.$IdGrupo];
  goToGroupList();
}
// ========== LEER READ FUNCTION GROUP ==========
function readGroup($conexion, $IdGrupo)
{
  $stmt = $conexion->prepare("SELECT mt.IdGrupo,mt.IdGrado,mt.IdProf,mg.NomGrado,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto,mt.NomGrupo FROM mt_grupos mt
                    LEFT JOIN mt_grados mg ON mt.IdGrado = mg.IdGrado LEFT JOIN profesor pr ON pr.IdProf = mt.IdProf LEFT JOIN usuarios us ON us.IdUser = pr.IdUser  
                    WHERE mt.IdGrupo = ?");
  $stmt->bind_param('i', $IdGrupo);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  } else {
    return null;
  }
}
// ========== BUSCAR SEARCH FUNCTION GROUP==========
function searchGroup($conexion)
{
  $consultaSQL = "SELECT mt.IdGrupo,mg.NomGrado,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto,mt.NomGrupo FROM mt_grupos mt
                    LEFT JOIN mt_grados mg ON mt.IdGrado = mg.IdGrado LEFT JOIN profesor pr ON pr.IdProf = mt.IdProf LEFT JOIN usuarios us ON us.IdUser = pr.IdUser";
  // Consulta para contar el total
  $consultaCount = "SELECT COUNT(*) AS total FROM mt_grupos mg";
  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultCount = mysqli_query($conexion, $consultaCount);
  $datos = mysqli_fetch_assoc($resultCount);
  return [
    'consultar' => $consultar,
    'totalFilas' => $datos['total']
  ];
}
// ========== ELIMINAR DELETE FUNCTION GRADE==========
function deleteGrade($conexion, $IdGrado)
{
  mysqli_query($conexion, "delete from mt_grados where IdGrado='$IdGrado'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
  mysqli_close($conexion);
  $_SESSION['alerts'][] = ['type' => 'success','text' => 'Se elimino Correctamente el Grado #'.$IdGrado];
  goToGradeList();
}
// ========== CREAR CREATE FUNCTION GRADE==========
function createGrade($conexion,$IdGrado,$NomGrado)
{
  $creargrado = $conexion->prepare("INSERT INTO mt_grados (IdGrado,NomGrado) VALUES (?,?)");
  $creargrado->bind_param('is', $IdGrado, $NomGrado);
  $creargrado->execute();
  $creargrado->close();
  $_SESSION['alerts'][] = ['type' => 'success','text' => 'Se creo Correctamente el Grado #'.$IdGrado];
  goToGradeList();
}

// ========== ACTUALIZAR UPDATE FUNCTION GRADE==========
function updateGrade($conexion,$IdGrado,$NomGrado)
{
  $actgrado = $conexion->prepare("UPDATE mt_grados SET  NomGrado = ? WHERE IdGrado = ?");
  $actgrado->bind_param('si', $NomGrado,$IdGrado);
  $actgrado->execute();
  $actgrado->close();
  $_SESSION['alerts'][] = ['type' => 'success','text' => 'Se actualizo Correctamente el Grado #'.$IdGrado];
  goToGradeList();
}
// ========== LEER READ FUNCTION GROUP ==========
function readGrade($conexion, $IdGrado)
{
  $stmt = $conexion->prepare("SELECT * FROM mt_grados mt WHERE mt.IdGrado = ?");
  $stmt->bind_param('i', $IdGrado);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  } else {
    return null;
  }
}
// ========== SEARCH FUNCTION GRADE ==========
function searchGrades($conexion)
{
  $consultaSQL = "SELECT * FROM mt_grados";
  // Consulta para contar el total
  $consultaCount = "SELECT COUNT(*) AS total FROM mt_grados";

  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultCount = mysqli_query($conexion, $consultaCount);
  $datos = mysqli_fetch_assoc($resultCount);

  return [
    'consultar' => $consultar,
    'totalFilas' => $datos['total']
  ];
}