<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia/models/DatabaseConnection.php");
session_start();
/* Inicio Sesion PROFESOR,ADMIN*/
if (isset($_POST["button_Auth"])) {
  $Correo = $_POST['Correo'];
  $Contrasena = $_POST['Contrasena'];
  $sentencia = $conexion->prepare("SELECT * FROM profesor WHERE EmailProf=?");
  $sentencia->bind_param('s', $Correo);
  $sentencia->execute();
  $resultado = $sentencia->get_result();
  if ($fila = $resultado->fetch_assoc()) {
    if ($fila['EmailProf'] == 'Admin@Admin.com' && password_verify($Contrasena, $fila['ContraProf'])) {
      $_SESSION['Id_Profe'] = $fila['IdProf'];
      $_SESSION['Id_Admin'] = $fila['IdProf'];
      echo "<script>alert('USUARIO ADMINISTRADOR CORRECTO')</script>";
      echo "<script>location.href='../../controllers/admin/TeacherSearchAdmin.php'</script>";
    } elseif (password_verify($Contrasena, $fila['ContraProf'])) {
      $_SESSION['Id_Profe'] = $fila['IdProf'];
      echo "<script>alert('USUARIO PROFESOR CORRECTO')</script>";
      echo "<script>location.href='../../controllers/teacher/AnnotationsSearch.php'</script>";
    } else {
      echo "<script>alert('USUARIO O CONTRASEÑA INCORRECTA')</script>";
      echo "<script>location.href='../../views/login/TeacherAdminLogin.php'</script>";
    }
  } else {
    echo "<script>alert('USUARIO NO ENCONTRADO')</script>";
    echo "<script>location.href='../../views/login/TeacherAdminLogin.php'</script>";
  }
  $sentencia->close();
  $conexion->close();
}
/* Inicio Sesion ESTUDIANTE*/
if (isset($_POST["LoginStudent"])) {
  if (empty($_POST["Identificacionn"])) {
    echo "<script>alert('NO SE PUEDE DEJAR VACIO CAMPO N.I')</script>";
    echo "<script>location.href='../../Login_Users/acudiente.php'</script>";
  } else {
    $Documento = $_POST["Identificacionn"];
    $query = "SELECT * FROM observador WHERE NumDocEst = '$Documento'";
    $resultado = mysqli_query($conexion, $query);
    if (mysqli_num_rows($resultado) > 0) {
      echo "<script>alert('USUARIO CORRECTO')</script>";
      echo "<script>location.href='../../Login_Users/historial_anotaciones.php'</script>";
      $_SESSION['Id_Estudiante'] = $_POST['Identificacionn'];
    } else {
      echo "<script>alert('ID NO ENCONTRADO')</script>";
      echo "<script>location.href='../../Login_Users/acudiente.php'</script>";
    }
    $resultado->close();
    $conexion->close();
  }
}
if (isset($_POST["Cerrar_Login"])) {
  session_destroy();
  echo "<script>alert('SESION CERRADA')</script>";
  echo "<script>location.href='/proyectos/DocuEstudia/views/login/TeacherAdminLogin.php'</script>";
}