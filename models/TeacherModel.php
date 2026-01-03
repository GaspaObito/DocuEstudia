<!-- ================ CRUD PARA TEACHER ================ -->
<?php
require_once(ROOT_PATH . "/models/DatabaseConnection.php");
// ========== ELIMINAR DELETE FUNCTION ==========
function deleteTeacher($conexion, $IdUser)
{
  $stmt = $conexion->prepare("DELETE FROM profesor WHERE IdProf = ?");
  $stmt->bind_param("i", $IdUser);
  return $stmt->execute();
}
// ========== CREAR CREATE FUNCTION ==========
function createTeacher($conexion, $ultimoId_Imagen, $Nombre, $Apellido, $TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento, $Direccion, $AsigAcadeProf, $IdMateria, $AreaProf, $Email, $Password, $IdRol, $NombreImagenOriginal, $Imagen_temporal, $IdGrupo)
{
  // Obtener la extensión del archivo original
  $extension = pathinfo($NombreImagenOriginal, PATHINFO_EXTENSION);
  // Crear el nuevo nombre del archivo usando el número de documento
  $NombreImagen = "Profesor_" . $NumDocumento . "." . $extension;
  // Leer el contenido binario de la imagen
  $BinarioImagen = file_get_contents($Imagen_temporal);
  // Mover la imagen a la carpeta de destino
  move_uploaded_file($Imagen_temporal, ROOT_PATH . "/assets/images/phototeacher/$NombreImagen");
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
  $creausuario->bind_param('iisssssssss', $IdRol, $ultimoId_Imagen, $Nombre, $Apellido, $TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento, $Direccion, $Email, $hashedPass);
  $creausuario->execute();
  $creausuario->close();
  // Last Id Insert 
  $ultimoId_User = mysqli_insert_id($conexion);

  $creaprofesor = $conexion->prepare("INSERT INTO profesor (IdUser,AsigAcadeProf,IdMateria,AreaProf) VALUES (?,?,?,?)");
  $creaprofesor->bind_param('isis', $ultimoId_User, $AsigAcadeProf, $IdMateria, $AreaProf);
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
}
// ========== ACTUALIZAR UPDATE FUNCTION ==========
function updateTeacher($conexion, $IdUser, $ultimoId_Imagen, $Nombre, $Apellido, $TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento, $Direccion, $AsigAcadeProf, $IdMateria, $AreaProf, $Email, $Password, $NombreImagenOriginal, $Imagen_temporal, $IdGrupo, $IdProf)
{
  // Validamos si recibio o no imagen
  if (!empty($_FILES['Imagen']) && $_FILES['Imagen']['error'] === UPLOAD_ERR_OK) {
    // Comprueba si existe la imagen Anterior para Rename, Change Locate
    $Before_NameImage = $_POST["Nom_Imagen"];
    $rutaImagenAnterior = ROOT_PATH . "/assets/images/phototeacher/" . $Before_NameImage;
    if (file_exists($rutaImagenAnterior)) {
      $New_NameImage = "Obsolete_" . $Before_NameImage;
      rename($rutaImagenAnterior, ROOT_PATH . "/assets/images/phototeacher/phototeacherobsolete/" . $New_NameImage);
    }
    // Obtener la extensión del archivo original
    $extension = pathinfo($NombreImagenOriginal, PATHINFO_EXTENSION);
    // Crear el nuevo nombre del archivo usando el número de documento
    $NombreImagen = "Profesor_" . $NumDocumento . "." . $extension;
    // Leer el contenido binario de la imagen
    $BinarioImagen = file_get_contents($Imagen_temporal);
    // Mover la imagen a la carpeta de destino
    move_uploaded_file($Imagen_temporal, ROOT_PATH . "/assets/images/phototeacher/$NombreImagen");
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
  $actusuarios->bind_param('sssssssssi', $Nombre, $Apellido, $TipoDcto, $NumDocumento, $Telefono, $Fecha_Nacimiento, $Direccion, $Email, $hashedPass, $IdUser);
  $actusuarios->execute();
  $actusuarios->close();

  if ($IdMateria === "mantener") {
    $IdMateria = $_POST["IdMateria_Actual"];
  } elseif ($IdMateria === "quitar") {
    $IdMateria = null;
  }
  // 2. Actualizar tabla profesor
  $actprofesor = $conexion->prepare("UPDATE profesor SET AsigAcadeProf = ?, IdMateria = ?, AreaProf = ? WHERE IdUser = ?");
  $actprofesor->bind_param("sisi", $AsigAcadeProf, $IdMateria, $AreaProf, $IdUser);
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
}
// ========== LEER READ FUNCTION ==========
function readTeacher($conexion, $IdUser)
{
  $stmt = $conexion->prepare("SELECT p.*,i.IdImg,i.NomImg,u.Nombre,u.Apellido,u.TipoDcto,u.NumDcto,u.Telefono,u.FechNacimiento,u.Direccion,u.Email,u.Password,m.IdGrado,m.NomGrado,g.IdGrupo,mm.NomMateria FROM profesor p 
    LEFT JOIN usuarios u ON u.IdUser = p.IdUser
    LEFT JOIN mt_grupos g ON g.IdProf = p.IdProf
    LEFT JOIN mt_grados m ON m.IdGrado = g.IdGrado
    LEFT JOIN imagenes i ON i.IdImg = u.IdImg  
    LEFT JOIN mt_materias mm ON mm.IdMateria = p.IdMateria WHERE p.IdProf = ?");
  $stmt->bind_param('i', $IdUser);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($row = $result->fetch_assoc()) {
    return $row;
  } else {
    return null;
  }
}
// ========== BUSCAR SEARCH FUNCTION ==========
function searchTeacher($conexion)
{
  $consultaSQL = "SELECT u.IdRol,u.Nombre, u.Apellido,p.*, u.NumDcto, c.IdGrupo, g.NomGrado ,mm.NomMateria
                    FROM profesor p
                    LEFT JOIN usuarios u ON u.IdUser = p.IdUser 
                    LEFT JOIN mt_grupos c ON p.IdProf = c.IdProf
                    LEFT JOIN mt_grados g ON g.IdGrado = c.IdGrado
                    LEFT JOIN mt_materias mm ON mm.IdMateria = p.IdMateria";

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
  } else {
    $whereSQL = ""; // Para reutilizar en el COUNT
  }
  // Consulta para contar el total
  $consultaCount = "SELECT COUNT(*) AS total FROM profesor p 
  LEFT JOIN usuarios u ON u.IdUser = p.IdUser  LEFT JOIN mt_grupos c ON p.IdProf = c.IdProf LEFT JOIN mt_grados g ON g.IdGrado = c.IdGrado
  $whereSQL";

  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultCount = mysqli_query($conexion, $consultaCount);
  $datos = mysqli_fetch_assoc($resultCount);

  return [
    'consultar' => $consultar,
    'totalFilas' => $datos['total']
  ];
}
// ========== GROUP TEAHCER FUNCTION ==========
function gruposTeacher($conexion)
{
  $consultaSQL = "SELECT mt.IdGrupo,mg.NomGrado,CONCAT(us.Nombre, ' ', .us.Apellido) AS NombreCompleto,mt.NomGrupo FROM mt_grupos mt
                    LEFT JOIN mt_grados mg ON mt.IdGrado = mg.IdGrado LEFT JOIN profesor pr ON pr.IdProf = mt.IdProf LEFT JOIN usuarios us ON us.IdUser = pr.IdUser";
  $conditions = []; // Aquí guardamos los filtros dinámicos

  // Filtros dinámicos
  if (!empty($_GET['Grado'])) {
    $Grado = (int) $_GET['Grado']; // entero, no hace falta escapar
    $conditions[] = "c.IdGrado = $Grado";
  }

  if (!empty($conditions)) {
    $whereSQL = " WHERE " . implode(" AND ", $conditions);
    $consultaSQL .= $whereSQL;
  } else {
    $whereSQL = ""; // Para reutilizar en el COUNT
  }
  // Consulta para contar el total
  $consultaCount = "SELECT COUNT(*) AS total FROM mt_grupos mg $whereSQL";

  $consultar = mysqli_query($conexion, $consultaSQL) or die("ERROR AL TRAER LOS DATOS");
  $resultCount = mysqli_query($conexion, $consultaCount);
  $datos = mysqli_fetch_assoc($resultCount);

  return [
    'consultar' => $consultar,
    'totalFilas' => $datos['total']
  ];
}