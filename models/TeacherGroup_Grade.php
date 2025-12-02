<!-- ================ CRUD PARA Group ================ -->
<?php
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/DatabaseConnection.php");
// Inicializar variables con valores por defecto
$IdGrupo= '';$IdGrado= '';$IdProf= '';$NomGrupo= '';//Grupo
// Recolecion ID Profesor 
$IdGrupo = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdGrupo > 0;
// Consulta para Tipo de Sangre y mt_grados
$mt_grados = "SELECT * FROM mt_grados";
$mt_grados = mysqli_query($conexion, $mt_grados) or die(mysqli_error($conexion));
$mt_grupos = "SELECT * FROM mt_grupos";
$mt_grupos = mysqli_query($conexion, $mt_grupos) or die(mysqli_error($conexion));
$mt_profesores = "SELECT *,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto FROM profesor pr LEFT JOIN usuarios us ON us.IdUser = pr.IdUser  ";
$mt_profesores = mysqli_query($conexion, $mt_profesores) or die(mysqli_error($conexion));

function redirectTo($path) {
    echo "<script>location.href='" . BASE_URL . "$path'</script>";
    exit;
}
function goToGroupList() {
    redirectTo("/views/subject/MtGroups.php?action=listarGRPS");
}
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["Enviar2"])) {
  $IdGrupo = $_POST['IdGrupo'] ?? $_POST['IdGrupo_Actual']; $IdGrado= $_POST['FornIdGrado'];$IdProf= $_POST['FornIdProf'];$NomGrupo= $_POST['NomGrupo'];//Grupo
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
  $action = $_POST['action'];
  if ($action === 'delete') {
    deleteGroup($conexion, $IdGrupo);
  } elseif ($action === 'create') {
    createGroup($conexion, $IdGrupo,$IdGrado,$IdProf,$NomGrupo);
  } elseif ($action === 'update') {
    updateGroup($conexion, $IdGrupo,$IdGrado,$IdProf,$NomGrupo);
  } elseif ($action === 'read') {
    $groupData = readGroup($conexion, $IdGrupo);
    // Asignar las variables desde el array devuelto
   $IdGrupo = $groupData['IdGrupo'];$IdGrado = $groupData['IdGrado'];$IdProf = $groupData['IdProf'];$NomGrado = $groupData['NomGrado'];$NombreCompleto = $groupData['NombreCompleto'];$NomGrupo = $groupData['NomGrupo'];
  }  else {
    echo 'error';
  }
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && ($action =$_GET['action'] ?? '') === 'listarGRPS') {//CONSULTA TODO
  $resultados = searchGroup($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET' &&  ($action =$_GET['action'] ?? '') === 'listarGRDS') {//CONSULTA TODO
  $resultados = searchGrades($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}
// ========== ELIMINAR DELETE FUNCTION ==========
function deleteGroup($conexion, $IdGrupo)
{
  mysqli_query($conexion, "delete from mt_grupos where IdGrupo='$IdGrupo'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
  mysqli_close($conexion);
  echo "<script>alert('SE ELIMINO CORRECTAMENTE')</script>";
  goToGroupList();
}
// ========== CREAR CREATE FUNCTION ==========
function createGroup($conexion, $IdGrupo,$IdGrado,$IdProf,$NomGrupo)
{
  $creagrupo = $conexion->prepare("INSERT INTO mt_grupos (IdGrupo,IdGrado,IdProf,NomGrupo) VALUES (?,?,?,?)");
  $creagrupo->bind_param('isss', $IdGrupo, $IdGrado, $IdProf, $NomGrupo);
  $creagrupo->execute();
  $creagrupo->close();

  echo "<script>alert('LOS REGISTROS SE INSERTARON CORRECTAMENTE')</script>";
  goToGroupList();
}

// ========== ACTUALIZAR UPDATE FUNCTION ==========
function updateGroup($conexion,$IdGrupo,$IdGrado,$IdProf,$NomGrupo)
{
  if ($IdGrado === "mantener") {
    $IdGrado = $_POST["IdGrado_Actual"];
  }elseif ($IdGrado === "quitar"){
    $IdGrado = null;
  } 
  if ($IdProf === "mantener") {
    $IdProf = $_POST["IdProf_Actual"];
  }elseif ($IdProf === "quitar"){
    $IdProf = null;
  } 
  // 1. Actualizar tabla usuarios 
  $actgrupo = $conexion->prepare("UPDATE mt_grupos SET  IdGrado = ?, IdProf = ?, NomGrupo = ? WHERE IdGrupo = ?");
  $actgrupo->bind_param('iisi', $IdGrado, $IdProf, $NomGrupo,$IdGrupo);
  $actgrupo->execute();
  $actgrupo->close();

  echo "<script>alert('SE ACTUALIZARON CORRECTAMENTE " . $IdGrupo. "');</script>";
  goToGroupList();
}
// ========== LEER READ FUNCTION ==========
function readGroup($conexion, $IdGrupo)
{
  $stmt = $conexion->prepare("SELECT mt.IdGrupo,mt.IdGrado,mt.IdProf,mg.NomGrado,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto,mt.NomGrupo
                    FROM mt_grupos mt
                    LEFT JOIN mt_grados mg ON mt.IdGrado = mg.IdGrado
                    LEFT JOIN profesor pr ON pr.IdProf = mt.IdProf
                    LEFT JOIN usuarios us ON us.IdUser = pr.IdUser  WHERE mt.IdGrupo = ?");
  $stmt->bind_param('i', $IdGrupo);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  }else {
    return null;
  }
}
// ========== GROUP TEAHCER FUNCTION ==========
function searchGroup($conexion)
{
    $consultaSQL = "SELECT mt.IdGrupo,mg.NomGrado,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto,mt.NomGrupo
                    FROM mt_grupos mt
                    LEFT JOIN mt_grados mg ON mt.IdGrado = mg.IdGrado
                    LEFT JOIN profesor pr ON pr.IdProf = mt.IdProf
                    LEFT JOIN usuarios us ON us.IdUser = pr.IdUser";

    $conditions = []; // Aquí guardamos los filtros dinámicos

    // Filtros dinámicos
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
                  FROM mt_grupos mg
                  $whereSQL";

    $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
    $resultCount  = mysqli_query($conexion, $consultaCount);
    $datos = mysqli_fetch_assoc($resultCount );

    return [
        'consultar' => $consultar,'totalFilas' => $datos['total']
    ];
}
// ========== GROUP TEAHCER FUNCTION ==========
function searchGrades($conexion)
{
    $consultaSQL = "SELECT * FROM mt_grados";

    $conditions = []; // Aquí guardamos los filtros dinámicos

    // Filtros dinámicos
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
                  FROM mt_grupos mg
                  $whereSQL";

    $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
    $resultCount  = mysqli_query($conexion, $consultaCount);
    $datos = mysqli_fetch_assoc($resultCount );

    return [
        'consultar' => $consultar,'totalFilas' => $datos['total']
    ];
}