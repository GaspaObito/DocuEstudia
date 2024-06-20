<?php
/* PAGINA WEB */
include("Conexion.php");
/* R_PROFESOR */
if (isset($_POST["Enviar2"])) {
    $Id_Profesor = $_POST['id_profesor'];
    $ultimoId_Imagen = $_POST['id_lastImg'];
    $Nombre = $_POST["nombre"];
    $Apellido = $_POST["Apellido"];
    $NumDocumento = $_POST["NumDocumento"];
    $Telefono = $_POST["Telefono"];
    $Fecha_Nacimiento = $_POST["Fecha_Nacimiento"];
    $AsignaturaAca = $_POST["AsignaturaAca"];
    $AsignaturaProfe = $_POST["AsignaturaProfe"];
    $Area = $_POST["Area"];
    $Correo = $_POST["Correo"];
    $Contrasena = $_POST["Contrasena"];
    //VALIDAMOS SI RECIBIO O NO IMAGEN
    if (!empty($_FILES['Imagen']) && $_FILES['Imagen']['error'] === UPLOAD_ERR_OK) {
        //RECIBIMOS POST IMAGEN
        $TipoImagen = $_FILES['Imagen']['type'];
        $NombreImagenOriginal = $_FILES['Imagen']['name'];
        $TamañoImagen = $_FILES['Imagen']['size'];
        $Imagen_temporal = $_FILES['Imagen']['tmp_name'];
        // Comprueba si existe la imagen Anterior para Rename, Change Locate
        $Before_NameImage = $_POST["Nom_Imagen"];
        $rutaImagenAnterior = "../Assets/Photos_Teacher/".$Before_NameImage;
        if (file_exists($rutaImagenAnterior)) {
            $New_NameImage = "Obsolete_".$Before_NameImage;
            rename($rutaImagenAnterior, "../Assets/Photos_Teacher/Photos_Teacher_Obsolete/".$New_NameImage);
        }
         // Obtener la extensión del archivo original
        $extension = pathinfo($NombreImagenOriginal, PATHINFO_EXTENSION);
        // Crear el nuevo nombre del archivo usando el número de documento
        $NombreImagen = "Profesor_" . $NumDocumento . "." . $extension;
        // Mover la imagen a la carpeta de destino
        move_uploaded_file($Imagen_temporal, "../Assets/Photos_Teacher/$NombreImagen");
       // Actualizar en la base de datos utilizando una consulta preparada
        $sql_TbImagen = "UPDATE imagenes SET Nombre_Imagen=?, imagen=? WHERE Id_Imagen=?";
        $stmt = $conexion->prepare($sql_TbImagen);
        $stmt->bind_param('ssi', $NombreImagen, $BinarioImagen, $ultimoId_Imagen);
        // Leer el contenido binario de la imagen
        $BinarioImagen = file_get_contents("../Assets/Photos_Teacher/$NombreImagen");
        // Ejecutar la consulta preparada
        // Ejecutar la consulta preparada y capturar la excepción en caso de error
        try {
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error al actualizar la imagen: " . $e->getMessage();
        }
        $stmt->close();
    }
    $sentencia = $conexion->prepare("SELECT * FROM profesor WHERE Email=?");
    $sentencia->bind_param('s', $Correo);
    $sentencia->execute();
    $resultado = $sentencia->get_result();
    if ($fila = $resultado->fetch_assoc()) {
        if ($Contrasena == $fila['Contrasena']) {
            $hashedPass = $fila['Contrasena'];
        } else {
            $hashedPass = password_hash($Contrasena, PASSWORD_DEFAULT);
        }
    }
    // INSERTADOS DATOS DEL PROFESOR
    $sql_detalle = "CALL ActualizarProfesor($Id_Profesor,$ultimoId_Imagen,'$Nombre', '$Apellido','$NumDocumento','$Telefono', '$Fecha_Nacimiento', '$AsignaturaAca', '$AsignaturaProfe', '$Area', '$Correo', '$hashedPass')";

    /* Validar insercion */
    if ($conexion->query($sql_detalle) === TRUE) {
        echo "<script>alert('SE ACTUALIZO CORRECTAMENTE')</script>";
        echo "<script>location.href='../Admin/Profesor_busc_Admin.php'</script>";
    } else {
        echo "<script>alert('ERROR AL ACTUALIZAR EL PROFESOR')</script>";
        echo "<script>location.href='../Admin/Profesor_busc_Admin.php'</script>";
    }
    $conexion->close();
}
?>