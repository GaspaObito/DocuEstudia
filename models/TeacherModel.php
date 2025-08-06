<!-- ================ CRUD PARA TEACHER ================ -->
<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
// Conexion Base de Datos
include ("$RootPath/models/DatabaseConnection.php");
// Inicializar variables con valores por defecto
$Nombre = '';
$Apellido = '';
$TipoDcto = '';
$NumDocumento = '';
$Telefono = '';
$Fecha_Nacimiento = '';
$Direccion = '';
$AsignaturaAca = '';
$AsignaturaProfe = '';
$Area = '';
$Email = '';
$Password = '';
$IdRol = 3;//Administrador
// Recolecion ID Profesor 
$id = isset($_POST['NumeroModificar']) ? intval($_POST['NumeroModificar']) : 0;
$isUpdate = $id > 0;
//RECIBIMOS DATOS TANTO PARA ACTUALIZAR COMO PARA CREAR
if (isset($_POST["Enviar2"])) {
  $Id_Profesor = $_POST['id_profesor'];
  $Nombre = $_POST["Nombre"];
  $Apellido = $_POST["Apellido"];
  $TipoDcto = $_POST["TipoDcto"];
  $NumDocumento = $_POST["NumDocumento"];
  $Telefono = $_POST["Telefono"];
  $Fecha_Nacimiento = $_POST["Fecha_Nacimiento"];
  $Direccion = $_POST["Direccion"];
  $AsignaturaAca = $_POST["AsignaturaAca"];
  $AsignaturaProfe = $_POST["AsignaturaProfe"];
  $Area = $_POST["Area"];
  $Email = $_POST["Correo"];
  $Password = $_POST["Contrasena"];
  //Recibimos Imagen POST
  $ultimoId_Imagen = $_POST['id_lastImg'];
  $TipoImagen = $_FILES['Imagen']['type'];
  $NombreImagenOriginal = $_FILES['Imagen']['name'];
  $Imagen_temporal = $_FILES['Imagen']['tmp_name'];
}
// ========== Se maneja la logica de las operaciones Delete,Create,Update,Read,Search ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
  $action = $_POST['action'];
  if ($action === 'delete') {
    deleteTeacher($conexion, $id);
  } elseif ($action === 'create') {
    createTeacher($RootPath, $conexion, $Id_Profesor, $ultimoId_Imagen, $Nombre, $Apellido,$TipoDcto,$NumDocumento,$Telefono,$Fecha_Nacimiento,$Direccion, 
      $AsignaturaAca, $AsignaturaProfe, $Area, $Email, $Password,$IdRol, $TipoImagen, $NombreImagenOriginal, $Imagen_temporal);
    // createProfesor($conexion, $id);
  } elseif ($action === 'update') {
    updateTeacher($RootPath, $conexion, $Id_Profesor, $ultimoId_Imagen, $Nombre, $Apellido, $NumDocumento,$TipoDcto,$Direccion, $Telefono, $Fecha_Nacimiento, 
      $AsignaturaAca, $AsignaturaProfe, $Area, $Email, $Password, $IdRol, $TipoImagen, $NombreImagenOriginal, $Imagen_temporal);
  } elseif ($action === 'read') {
    $profesorData = readTeacher($conexion, $id);
    // Asignar las variables desde el array devuelto
    $Id_Profesor = $profesorData['IdProf'];
    $ultimoId_Imagen = $profesorData['IdImg'];
    $Nombre = $profesorData['Nombre'];
    $Apellido = $profesorData['Apellido'];
    $TipoDcto = $profesorData["TipoDcto"];
    $NumDocumento = $profesorData['NumDcto'];
    $Telefono = $profesorData['Telefono'];
    $Fecha_Nacimiento = $profesorData['FechNacimiento'];
    $Direccion = $profesorData['Direccion'];
    $AsignaturaAca = $profesorData['AsigAcadeProf'];
    $AsignaturaProfe = $profesorData['AsigProf'];
    $Area = $profesorData['AreaProf'];
    $Email = $profesorData['Email'];
    $Password = $profesorData['Password'];
    $NombreImagen = $profesorData['NomImg'];
  }  else {
    echo 'error';
  }
}elseif ($_SERVER['REQUEST_METHOD'] === 'GET' || !empty($_GET['DNI'])) {
  $resultados = searchTeacher($conexion);
  // Accede a las variables retornadas desde el array de resultados
  $consultar = $resultados['consultar'];
  $totalFilas = $resultados['totalFilas'];
}
// ========== ELIMINAR DELETE FUNCTION ==========
function deleteTeacher($conexion, $id)
{
  mysqli_query($conexion, "delete from profesor where IdProf='$id'") or die("<script>alert('ERROR AL ELIMINAR')</script>");
  mysqli_close($conexion);
  echo "<script>alert('SE ELIMINO CORRECTAMENTE')</script>";
  echo "<script>location.href='/proyectos/DocuEstudia/controllers/admin/TeacherSearchAdmin.php'</script>";
  exit;
}
// ========== CREAR CREATE FUNCTION ==========
function createTeacher($RootPath, $conexion, $Id_Profesor, $ultimoId_Imagen, $Nombre, $Apellido,$TipoDcto,$NumDocumento,$Telefono,$Fecha_Nacimiento,$Direccion, 
      $AsignaturaAca, $AsignaturaProfe, $Area, $Email, $Password,$IdRol, $TipoImagen, $NombreImagenOriginal, $Imagen_temporal)
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
  $sql_TbImagen = "INSERT INTO imagenes (TipoEntImg,NomImg, BinImg) VALUES (?,?,?)";
  $stmt = $conexion->prepare($sql_TbImagen);
  $stmt->bind_param('iss', $IdRol, $NombreImagen, $BinarioImagen);
  $stmt->execute();
  $stmt->close();
  // Last Id Insert 
  $ultimoId_Imagen = mysqli_insert_id($conexion);

  $hashedPass = password_hash($Password, PASSWORD_DEFAULT); // Create password hash 

  $sql_detalle = "INSERT INTO usuarios (IdRol,IdImg,Nombre,Apellido,TipoDcto,NumDcto,Telefono,FechNacimiento,Direccion,Email,Password) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
  $stmt2 = $conexion->prepare($sql_detalle);
  $stmt2->bind_param('iisssssssss', $IdRol, $ultimoId_Imagen, $Nombre, $Apellido,$TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento,$Direccion, $Email, $hashedPass);
  $stmt2->execute();
  $stmt2->close();
   // Last Id Insert 
  $ultimoId_User = mysqli_insert_id($conexion);
  $sql_detalle = "INSERT INTO profesor (IdUser,AsigAcadeProf,AsigProf,AreaProf) VALUES (?,?,?,?)";
  $stmt3 = $conexion->prepare($sql_detalle);
  $stmt3->bind_param('isss', $ultimoId_User, $AsignaturaAca, $AsignaturaProfe, $Area );
  $stmt3->execute();
  $stmt3->close();

  mysqli_close($conexion);
  echo "<script>alert('LOS REGISTROS SE INSERTARON CORRECTAMENTE')</script>";
  echo "<script>location.href='/proyectos/DocuEstudia/controllers/admin/TeacherSearchAdmin.php'</script>";
  return $resultado;
}
// ========== ACTUALIZAR UPDATE FUNCTION ==========
function updateTeacher($RootPath, $conexion, $Id_Profesor, $ultimoId_Imagen, $Nombre, $Apellido, $NumDocumento, $Telefono, $Fecha_Nacimiento, 
  $AsignaturaAca, $AsignaturaProfe, $Area, $Email, $Password,$IdRol, $TipoImagen, $NombreImagenOriginal, $Imagen_temporal)
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
  $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE IdUser=$Id_Profesor");
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  if ($fila = $resultado->fetch_assoc()) {
    if ($Password == $fila['Password']) {
      $hashedPass = $fila['Password'];
    } else {
      $hashedPass = password_hash($Password, PASSWORD_DEFAULT);
    }
  }
  // 1. Actualizar tabla usuarios
  $stmt1 = $conexion->prepare("
      UPDATE usuarios 
      SET Nombre = ?, Apellido = ?, Email = ?,Password = ?,NumDcto = ?, Telefono = ?, Direccion = ?, FechActualizado = NOW()
      WHERE IdUser = ?
  ");
  $stmt1->bind_param("sssssssi", $Nombre, $Apellido,$Email, $Password, $NumDcto, $Telefono, $Direccion, $IdUser);
  $stmt1->execute();
  // 2. Actualizar tabla profesor
  $stmt2 = $conexion->prepare("
      UPDATE profesor 
      SET AsigAcadeProf = ?, AsigProf = ?, AreaProf = ?
      WHERE IdUser = ?
  ");
$stmt2->bind_param("sssi", $AsigAcadeProf, $AsigProf, $AreaProf, $IdUser);
$stmt2->execute();

// Validar insercion 
 if ($stmt1->execute()) {
    echo "Actualización exitosa";
} else {
    echo "Error: " . $stmt->error;
}

}
// ========== LEER READ FUNCTION ==========
function readTeacher($conexion, $id)
{
  $stmt = $conexion->prepare("SELECT p.*,i.IdImg,i.NomImg,u.Nombre,u.Apellido,u.TipoDcto,u.NumDcto,u.Telefono,u.FechNacimiento,u.Direccion,u.Email,u.Password FROM profesor p 
    LEFT JOIN usuarios u ON u.IdUser = p.IdUser
    LEFT JOIN imagenes i ON i.IdImg = u.IdImg  WHERE IdProf = ?");
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
function searchTeacher($conexion)
{
  // Inicializa la variable de consulta con la búsqueda de todos los profesores
  $consultaSQL = "SELECT CONCAT(u.Nombre, ' ', u.Apellido) AS NombreCompleto, p.*,u.NumDcto, c.NomCurso FROM profesor p LEFT JOIN curso c ON p.IdProf = c.IdProf 
  LEFT JOIN usuarios u ON u.IdUser = p.IdUser";
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

