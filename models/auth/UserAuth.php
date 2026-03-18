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
    if ($fila && password_verify($Contrasena, $fila['Password'])) {

      $_SESSION['user_id'] = $fila['IdUser'];
      $_SESSION['rol'] = $fila['IdRol'];

      // ADMIN
      if ($fila['IdRol'] == 3) {
        header("Location: " . BASE_URL . "/views/admin/ManageUsers.php?action=listar");
        exit;
      }

      // PROFESOR
      if ($fila['IdRol'] == 2) {
        header("Location: " . BASE_URL . "/views/teacher/AnnotationsSearch.php");
        exit;
      }

      // ESTUDIANTE
      if ($fila['IdRol'] == 1) {
        $idUser = $_SESSION['user_id'];
        $sqlObs = "SELECT IdObs FROM observador WHERE IdUser = ? LIMIT 1";
        $stmt = $conexion->prepare($sqlObs);
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        $res = $stmt->get_result();
        $filaObs = $res->fetch_assoc();
        $_SESSION['Id_Session'] = $filaObs['IdObs'];
        header("Location: " . BASE_URL . "/views/teacher/AnnotationsHistory.php?action=listarAnotaciones");
        exit;
      }
    } else {
      $_SESSION['alerts'][] = ['type' => 'danger', 'text' => 'Usuario o contraseña incorrectos'];
      header("Location: " . BASE_URL . "/views/login/TeacherAdminLogin.php");
      exit;
    }
  } else {
    $_SESSION['alerts'][] = ['type' => 'warning', 'text' => 'Usuario no encontrado'];
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
