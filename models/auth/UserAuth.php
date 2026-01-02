<?php
require_once(__DIR__ . "/../../config/config.php");
include(ROOT_PATH . "/models/DatabaseConnection.php");
/* Inicio Sesion PROFESOR,ADMIN*/
if (isset($_POST["button_Auth"])) {
  $Correo = $_POST['Correo'];
  $Contrasena = $_POST['Contrasena'];
  $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE Email=?");
  $sentencia->bind_param('s', $Correo);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  if ($fila = $resultado->fetch_assoc()) {
    //------ USUARIO ADMIN ------
    if ($fila['IdRol'] == '3' && password_verify($Contrasena, $fila['Password'])) {
      $_SESSION['Id_Profe'] = $fila['IdUser'];
      $_SESSION['IdRol'] = $fila['IdRol'];
      echo "<script>alert('USUARIO ADMINISTRADOR CORRECTO')</script>";
      echo "<script>location.href='" . BASE_URL . "/controllers/admin/ManageUsers.php?action=listar'</script>";
    //------ USUARIO TEACHER ------
    } elseif ($fila['IdRol'] == '2' && password_verify($Contrasena, $fila['Password'])) {
      $_SESSION['Id_Profe'] = $fila['IdUser'];
      $_SESSION['IdRol'] = $fila['IdRol'];
      echo "<script>alert('USUARIO PROFESOR CORRECTO')</script>"; 
      echo "<script>location.href='" . BASE_URL . "/controllers/teacher/AnnotationsSearch.php'</script>";
    //------ USUARIO STUDENT ------
    } elseif ($fila['IdRol'] == '1' && password_verify($Contrasena, $fila['Password'])) {
      $_SESSION['Id_Estu'] = $fila['IdUser'];
         // Consultar IdObs en la tabla observador
    $idUser = $_SESSION['Id_Estu'];
    $sqlObs = "SELECT IdObs FROM observador WHERE IdUser = '$idUser' LIMIT 1";
    $resObs = mysqli_query($conexion, $sqlObs);
    $filaObs = mysqli_fetch_assoc($resObs);
    $_SESSION['Id_Session'] = $filaObs['IdObs']; 
    $IdObs = $filaObs['IdObs']; 
    // Generar formulario oculto y enviarlo automáticamente
    echo "<script>alert('USUARIO ESTUDIANTE CORRECTO')</script>";
    echo "
    <form id='autoForm' action='" . BASE_URL . "/controllers/teacher/AnnotationsHistory.php' method='post'>
        <input type='hidden' name='IdObs' value='{$IdObs}'>
        <input type='hidden' name='action' value='read'>
    </form>
    <script>
        document.getElementById('autoForm').submit();
    </script>
    ";
    } else {
      $_SESSION['alerts'][] = ['type' => 'danger','text' => 'Usuario o contraseña incorrectos'];
      header("Location: " . BASE_URL . "/views/login/TeacherAdminLogin.php");
      exit;
    }
  } else {
    $_SESSION['alerts'][] = ['type' => 'warning','text' => 'Usuario no encontrado'];
    header("Location: " . BASE_URL . "/views/login/TeacherAdminLogin.php");
    exit;
  }
  $sentencia->close();
  $conexion->close();
}
if (isset($_POST["Cerrar_Login"])) {
  session_destroy();
  echo "<script>alert('SESION CERRADA')</script>";
  echo "<script>location.href='" . BASE_URL . "/views/login/TeacherAdminLogin.php'</script>";
}
