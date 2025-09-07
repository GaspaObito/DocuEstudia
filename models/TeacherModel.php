<!-- ================ CRUD PARA TEACHER ================ -->
<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
// Conexion Base de Datos
include ("$RootPath/models/DatabaseConnection.php");
// Inicializar variables con valores por defecto
$Nombre = '';$Apellido = '';$TipoDcto = '';$NumDocumento = '';$Telefono = '';$Fecha_Nacimiento = '';$Direccion = '';$AsigAcadeProf = '';$AsigProf = '';$AreaProf = '';$Email = '';$Password = '';$IdRol = 2;//Profesor
// Recolecion ID Profesor 
$IdUser = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $IdUser > 0;
// Consulta para Tipo de Sangre y mt_grados
$mt_grados = "SELECT * FROM mt_grados";
$mt_grados = mysqli_query($conexion, $mt_grados) or die(mysqli_error($conexion));
$mt_grupos = "SELECT * FROM mt_grupos";
$mt_grupos = mysqli_query($conexion, $mt_grupos) or die(mysqli_error($conexion));
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["Enviar2"])) {
  $IdUser = $_POST['id_profesor'];$Nombre = $_POST["Nombre"];$Apellido = $_POST["Apellido"];$TipoDcto = $_POST["TipoDcto"];$NumDocumento = $_POST["NumDocumento"];$Telefono = $_POST["Telefono"];$Fecha_Nacimiento = $_POST["Fecha_Nacimiento"];$Direccion = $_POST["Direccion"];$AsigAcadeProf = $_POST["AsigAcadeProf"];$AsigProf = $_POST["AsignaturaProfe"];$AreaProf = $_POST["Area"];$Email = $_POST["Correo"];$Password = $_POST["Contrasena"];$IdGrupo =$_POST['FornIdGrupo'];
  //Recibimos Imagen POST
  $ultimoId_Imagen = $_POST['id_lastImg'];$NombreImagenOriginal = $_FILES['Imagen']['name'];$Imagen_temporal = $_FILES['Imagen']['tmp_name'];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
  $action = $_POST['action'];
  if ($action === 'delete') {
    deleteTeacher($conexion, $IdUser);
  } elseif ($action === 'create') {
    createTeacher($RootPath, $conexion, $ultimoId_Imagen, $Nombre, $Apellido,$TipoDcto,$NumDocumento,$Telefono,$Fecha_Nacimiento,$Direccion, $AsigAcadeProf, $AsigProf, $AreaProf, $Email, $Password,$IdRol, $NombreImagenOriginal, $Imagen_temporal,$IdGrupo);
    // createProfesor($conexion, $id);
  } elseif ($action === 'update') {
    updateTeacher($RootPath, $conexion, $IdUser, $ultimoId_Imagen, $Nombre, $Apellido,$TipoDcto,$NumDocumento,$Telefono,$Fecha_Nacimiento,$Direccion, $AsigAcadeProf, $AsigProf, $AreaProf,$Email, $Password,$IdRol, $NombreImagenOriginal, $Imagen_temporal,$IdGrupo,$IdProf);
  } elseif ($action === 'read') {
    $profesorData = readTeacher($conexion, $IdUser);
    // Asignar las variables desde el array devuelto
    $IdUser = $profesorData['IdUser'];$ultimoId_Imagen = $profesorData['IdImg'];$Nombre = $profesorData['Nombre'];$Apellido = $profesorData['Apellido'];$TipoDcto = $profesorData["TipoDcto"];$NumDocumento = $profesorData['NumDcto'];$Telefono = $profesorData['Telefono'];$Fecha_Nacimiento = $profesorData['FechNacimiento'];$Direccion = $profesorData['Direccion'];$AsigAcadeProf = $profesorData['AsigAcadeProf'];$AsigProf = $profesorData['AsigProf'];$AreaProf = $profesorData['AreaProf'];$Email = $profesorData['Email'];$Password = $profesorData['Password'];$NombreImagen = $profesorData['NomImg'];$IdGrupo = $profesorData['IdGrupo'];
  }  else {
    echo 'error';
  }
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET' || !empty($_GET['DNI'])) {//CONSULTA TODO
  $resultados = searchTeacher($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}
// ========== ELIMINAR DELETE FUNCTION ==========
function deleteTeacher($conexion, $IdUser)
{
  mysqli_query($conexion, "delete from profesor where IdProf='$IdUser'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
  mysqli_close($conexion);
  echo "<script>alert('SE ELIMINO CORRECTAMENTE')</script>";
  echo "<script>location.href='/proyectos/DocuEstudia/controllers/admin/ManageUsers.php'</script>";
  exit;
}
// ========== CREAR CREATE FUNCTION ==========
function createTeacher($RootPath, $conexion, $ultimoId_Imagen, $Nombre, $Apellido,$TipoDcto,$NumDocumento,$Telefono,$Fecha_Nacimiento,$Direccion, 
      $AsigAcadeProf, $AsigProf, $AreaProf, $Email, $Password,$IdRol, $NombreImagenOriginal, $Imagen_temporal,$IdGrupo)
{
  // Obtener la extensión del archivo original
  $extension = pathinfo($NombreImagenOriginal, PATHINFO_EXTENSION);
  // Crear el nuevo nombre del archivo usando el número de documento
  $NombreImagen = "Profesor_" . $NumDocumento . "." . $extension;
  // Leer el contenido binario de la imagen
  $BinarioImagen = file_get_contents($Imagen_temporal);
  // Mover la imagen a la carpeta de destino
  move_uploaded_file($Imagen_temporal, "$RootPath/assets/images/phototeacher/$NombreImagen");
  // Insertar en la base de datos 
  $sql_TbImagen = "INSERT INTO imagenes (IdRol,NomImg, BinImg) VALUES (?,?,?)";
  $stmt = $conexion->prepare($sql_TbImagen);
  $stmt->bind_param('iss', $IdRol, $NombreImagen, $BinarioImagen);
  $stmt->execute();
  $stmt->close();
  // Last Id Insert 
  $ultimoId_Imagen = mysqli_insert_id($conexion);

  $hashedPass = password_hash($Password, PASSWORD_DEFAULT); // Create password hash 

  $creausuario = $conexion->prepare("INSERT INTO usuarios (IdRol,IdImg,Nombre,Apellido,TipoDcto,NumDcto,Telefono,FechNacimiento,Direccion,Email,Password) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
  $creausuario->bind_param('iisssssssss', $IdRol, $ultimoId_Imagen, $Nombre, $Apellido,$TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento,$Direccion, $Email, $hashedPass);
  $creausuario->execute();
  $creausuario->close();
   // Last Id Insert 
  $ultimoId_User = mysqli_insert_id($conexion);

  $creaprofesor = $conexion->prepare("INSERT INTO profesor (IdUser,AsigAcadeProf,AsigProf,AreaProf) VALUES (?,?,?,?)");
  $creaprofesor->bind_param('isss', $ultimoId_User, $AsigAcadeProf, $AsigProf, $AreaProf );
  $creaprofesor->execute();
  $creaprofesor->close();
  // Last Id Insert 
  $ultimoIdProf = mysqli_insert_id($conexion);
//MANDA ERROR
if (!empty($IdGrupo) && $IdGrupo !== 'mantener') {
    $actgrupos = $conexion->prepare("UPDATE mt_grupos SET IdProf=? WHERE IdGrupo=?");
    $actgrupos->bind_param('ii', $ultimoIdProf, $IdGrupo);
    $actgrupos->execute();
    $actgrupos->close();
}
  
  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE INSERTARON CORRECTAMENTE')</script>";
  echo "<script>location.href='/proyectos/DocuEstudia/controllers/admin/ManageUsers.php'</script>";
}
// ========== ACTUALIZAR UPDATE FUNCTION ==========
function updateTeacher($RootPath, $conexion, $IdUser, $ultimoId_Imagen, $Nombre, $Apellido,$TipoDcto,$NumDocumento,$Telefono,$Fecha_Nacimiento,$Direccion, 
      $AsigAcadeProf, $AsigProf, $AreaProf, $Email, $Password,$IdRol, $NombreImagenOriginal, $Imagen_temporal,$IdGrupo,$IdProf)
{
  // Validamos si recibio o no imagen
  if (!empty($_FILES['Imagen']) && $_FILES['Imagen']['error'] === UPLOAD_ERR_OK) {
    // Comprueba si existe la imagen Anterior para Rename, Change Locate
    $Before_NameImage = $_POST["Nom_Imagen"];
    $rutaImagenAnterior = "$RootPath/assets/images/phototeacher/" . $Before_NameImage;
    if (file_exists($rutaImagenAnterior)) {
      $New_NameImage = "Obsolete_" . $Before_NameImage;
      rename($rutaImagenAnterior, "$RootPath/assets/images/phototeacher/phototeacherobsolete/" . $New_NameImage);
    }
    // Obtener la extensión del archivo original
    $extension = pathinfo($NombreImagenOriginal, PATHINFO_EXTENSION);
    // Crear el nuevo nombre del archivo usando el número de documento
    $NombreImagen = "Profesor_" . $NumDocumento . "." . $extension;
    // Leer el contenido binario de la imagen
    $BinarioImagen = file_get_contents($Imagen_temporal);
    // Mover la imagen a la carpeta de destino
    move_uploaded_file($Imagen_temporal, "$RootPath/assets/images/phototeacher/$NombreImagen");
    // Actualizar en la base de datos utilizando una consulta preparada
    $sql_TbImagen = "UPDATE imagenes SET NomImg=?, BinImg=? WHERE IdImg=?";
    $stmt = $conexion->prepare($sql_TbImagen);
    $stmt->bind_param('ssi', $NombreImagen, $BinarioImagen, $ultimoId_Imagen);
    // Ejecutar la consulta preparada y capturar la excepción en caso de error
    try {
      $stmt->execute();
    } catch (Exception $e) {
      echo "Error al actualizar la imagen: " . $e->getMessage();
    }
    $stmt->close();
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
  // 1. Actualizar tabla usuarios 
  $actusuarios = $conexion->prepare("UPDATE usuarios SET  Nombre = ?, Apellido = ?, TipoDcto = ?, NumDcto = ?, Telefono = ?, FechNacimiento = ?, Direccion = ?, Email = ?, Password = ? WHERE IdUser = ?");
  $actusuarios->bind_param('sssssssssi',$Nombre,$Apellido, $TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento, $Direccion, $Email, $hashedPass, $IdUser);
  $actusuarios->execute();
  $actusuarios->close();

  // 2. Actualizar tabla profesor
  $actprofesor = $conexion->prepare("UPDATE profesor SET AsigAcadeProf = ?, AsigProf = ?, AreaProf = ? WHERE IdUser = ?");
  $actprofesor->bind_param("sssi", $AsigAcadeProf, $AsigProf, $AreaProf, $IdUser);
  $actprofesor->execute();  
  $actprofesor->close();

  $buscarIdProf = $conexion->prepare("SELECT IdProf FROM profesor WHERE IdUser = ?");
  $buscarIdProf->bind_param('i', $IdUser);
  $buscarIdProf->execute();
  $buscarIdProf->bind_result($IdProf);
  $buscarIdProf->fetch();
  $buscarIdProf->close();

  if ($IdGrupo === "mantener") {
    $IdGrupo = $_POST["IdGrupo_Actual"];
    
  }
  if (!empty($IdGrupo)) {
  $limpiarAsignaciones = $conexion->prepare("UPDATE mt_grupos SET IdProf=NULL WHERE IdProf=?");
  $limpiarAsignaciones->bind_param('i', $IdProf);
  $limpiarAsignaciones->execute();
  $limpiarAsignaciones->close();

  $actgrupos = $conexion->prepare("UPDATE mt_grupos SET IdProf=? WHERE IdGrupo=?");
  $actgrupos->bind_param('ii', $IdProf, $IdGrupo);
  $actgrupos->execute();
  $actgrupos->close();
  }
echo "<script>alert('SE ACTUALIZARON CORRECTAMENTE " . $IdUser,$IdProf . "');</script>";
echo "<script>location.href='/proyectos/DocuEstudia/controllers/admin/ManageUsers.php'</script>";
}
// ========== LEER READ FUNCTION ==========
function readTeacher($conexion, $IdUser)
{
  $stmt = $conexion->prepare("SELECT p.*,i.IdImg,i.NomImg,u.Nombre,u.Apellido,u.TipoDcto,u.NumDcto,u.Telefono,u.FechNacimiento,u.Direccion,u.Email,u.Password,m.IdGrado,m.NomGrado,g.IdGrupo FROM profesor p 
    LEFT JOIN usuarios u ON u.IdUser = p.IdUser
    LEFT JOIN mt_grupos g ON g.IdProf = p.IdProf
    LEFT JOIN mt_grados m ON m.IdGrado = g.IdGrado
    LEFT JOIN imagenes i ON i.IdImg = u.IdImg  WHERE p.IdProf = ?");
  $stmt->bind_param('i', $IdUser);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  }else {
    return null;
  }
}
// ========== BUSCAR SEARCH FUNCTION ==========
function searchTeacher($conexion)
{
  // Inicializa la variable de consulta con la búsqueda de todos los profesores
  $consultaSQL = "SELECT u.IdRol,CONCAT(u.Nombre, ' ', u.Apellido) AS NombreCompleto, p.*,u.NumDcto, c.IdGrupo,g.NomGrado FROM profesor p LEFT JOIN usuarios u ON u.IdUser =p.IdUser 
  LEFT JOIN mt_grupos c ON p.IdProf = c.IdProf
  LEFT JOIN mt_grados g ON g.IdGrado = c.IdGrado ";
  $query = "SELECT COUNT(*) AS total FROM profesor";
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