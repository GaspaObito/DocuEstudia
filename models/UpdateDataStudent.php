<?php
/* PAGINA WEB */
include ("Conexion.php");
session_start();
/* ACT_OBSERVADOR_ESTUDIANTE */
if (isset($_POST["Act_Est"])) {
  /*ACUDIENTE*/
  $Id_Acudiente = $_POST["NumeroModificar_Acud"];
  $nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];
  $parentesco = $_POST["parentesco"];
  $ocupacion = $_POST["ocupacion"];
  $telefono = $_POST["telefono"];
  $viveAcudiente = $_POST["ViveAcudiente"];
  $email = $_POST["email"];
  if ($viveAcudiente === "mantener") {
    // El usuario ha seleccionado la opción "mantener", asignar el valor actual del campo
    $viveAcudiente = $_POST["ViveAcu_Actual"];
  }
  $sql_Actualizar = "UPDATE datos_familiar SET Nombre_Acudiente='" . $nombre . "',Apellido_Acudiente='" . $apellido . "',Parentesco='" . $parentesco . "'
    ,Ocupacion='" . $ocupacion . "',Tel_Cel='" . $telefono . "',Email='" . $email . "',Vive_Con_Estudiante='" . $viveAcudiente . "' WHERE Id_DatosFamiliar=" . $Id_Acudiente;
  /* Insertar datos en la tabla */
  $resultado = mysqli_query($conexion, $sql_Actualizar) or die
    ("ERROR EN LA INSERCION" . $Id_Persona);
  /*FINALIZA ACUDIENTE*/
  /*HISTORIAL_ESCOLAR*/
  $Id_Historial_Escolar = $_POST["NumeroModificar_HistEsc"];
  $Colegio_Anterior = $_POST["Colegio_Anterior"];
  $Direccion = $_POST["Direccion"];
  $Ult_Curso_Cursado = $_POST["Ult_Curso_Cursado"];
  $Jornada = $_POST["Jornada"];
  $Es_Repitente = $_POST["Es_Repitente"];
  $CuantasVeces = $_POST["CuantasVeces"];
  $PracticaDeporte = $_POST["PracticaDeporte"];
  $Nombre_Deporte = $_POST["Nombre_Deporte"];
  if ($Es_Repitente === "mantener" && $CuantasVeces === "mantener" && $PracticaDeporte === "mantener") {
    // El usuario ha seleccionado la opción "mantener", asignar el valor actual del campo
    $Es_Repitente = $_POST["Repitente_Actual"];
    $CuantasVeces = $_POST["RepiteCant_Actual"];
    $PracticaDeporte = $_POST["PracticDep_Actual"];
  }
  $sql_Actualizar = "UPDATE historial_escolar SET Colegio_Anterior='" . $Colegio_Anterior . "',Direccion='" . $Direccion . "',Curso='" . $Ult_Curso_Cursado . "'
    ,Jornada='" . $Jornada . "',Repitente='" . $Es_Repitente . "',Cantidad_Repitente='" . $CuantasVeces . "',Practica_Deporte='" . $PracticaDeporte . "'
    ,Nombre_Deporte='" . $Nombre_Deporte . "' WHERE Id_Historial_Escolar=" . $Id_Historial_Escolar;
  /* Insertar datos en la tabla */
  $resultado = mysqli_query($conexion, $sql_Actualizar) or die
    ("ERROR EN LA INSERCION" . $Id_Persona);
  /*FINALIZA HISTORIAL_ESCOLAR*/
  /*MEDICOS*/
  $Id_Medicina = $_POST["NumeroModificar_DaMedicos"];
  $Eps = $_POST["Eps"];
  $Sanitaria = $_POST["Sanitaria"];
  $Ocupación = $_POST["Ocupación"];
  $Recomendaciones = $_POST["Recomendaciones"];
  $Antecendentes = $_POST["Antecendentes"];
  $FornTipoSangre = $_POST["FornTipoSangre"];
  if ($FornTipoSangre === "mantener") {
    // El usuario ha seleccionado la opción "mantener", asignar el valor actual del campo
    $FornTipoSangre = $_POST["GrupSangui_Actual"];

  }
  $sql_Actualizar = "UPDATE info_medica SET Nombre_EPS='" . $Eps . "',Prioridad_Sanitaria='" . $Sanitaria . "',Ocupacion='" . $Ocupación . "'
    ,Recomendaciones_Medicas='" . $Recomendaciones . "',Antecedentes_Medicos='" . $Antecendentes . "',Id_Tipo_Sangre='" . $FornTipoSangre . "' 
    WHERE Id_Medicina=" . $Id_Medicina;
  /* Insertar datos en la tabla */
  $resultado = mysqli_query($conexion, $sql_Actualizar) or die
    ("ERROR EN LA INSERCION" . $Id_Persona);
  /*FINALIZA MEDICOS*/
  /*ESTUDIANTE*/
  $Id_Estudiante = $_POST["NumeroModificar_Est"];
  $ultimoId_Imagen = $_POST['id_lastImg'];
  $Nombre_Est = $_POST["Nombre_Est"];
  $Apellido_Est = $_POST["Apellido_Est"];
  $Telefono_Est = $_POST["Telefono_Est"];
  $Fecha_Nacimiento_Est = $_POST["Fecha_Nacimiento_Est"];
  $Residencia_Est = $_POST["Residencia_Est"];
  $Lugar_Nacimiento_Est = $_POST["Lugar_Nacimiento_Est"];
  $NumeroIdentif_Est = $_POST["NumeroIdentif_Est"];
  $FornCurso = $_POST["FornCurso"];
  $Edad_Est = $_POST["Edad_Est"];
  if (!empty($_FILES['Imagen']) && $_FILES['Imagen']['error'] === UPLOAD_ERR_OK) {
    //RECIBIMOS POST IMAGEN
    $TipoImagen = $_FILES['Imagen']['type'];
    $NombreImagenOriginal = $_FILES['Imagen']['name'];
    $TamañoImagen = $_FILES['Imagen']['size'];
    $Imagen_temporal = $_FILES['Imagen']['tmp_name'];
    // Comprueba si existe la imagen Anterior para Rename, Change Locate
    $Before_NameImage = $_POST["Nom_Imagen"];
    $rutaImagenAnterior = "../Assets/Photos_Students/" . $Before_NameImage;
    if (file_exists($rutaImagenAnterior)) {
      $New_NameImage = "Obsolete_" . $Before_NameImage;
      rename($rutaImagenAnterior, "../Assets/Photos_Students/Photos_Students_Obsolete/" . $New_NameImage);
    }
    // Obtener la extensión del archivo original
    $extension = pathinfo($NombreImagenOriginal, PATHINFO_EXTENSION);
    // Crear el nuevo nombre del archivo usando el número de documento
    $NombreImagen = "Estudiante_" . $NumeroIdentif_Est . "." . $extension;
    // Mover la imagen a la carpeta de destino
    move_uploaded_file($Imagen_temporal, "../Assets/Photos_Students/$NombreImagen");
    // Actualizar en la base de datos utilizando una consulta preparada
    $sql_TbImagen = "UPDATE imagenes SET Nombre_Imagen=?, imagen=? WHERE Id_Imagen=?";//MAX FILE SIZE 8MG
    $stmt = $conexion->prepare($sql_TbImagen);
    $stmt->bind_param('ssi', $NombreImagen, $BinarioImagen, $ultimoId_Imagen);
    // Leer el contenido binario de la imagen
    $BinarioImagen = file_get_contents("../Assets/Photos_Students/$NombreImagen");
    // Ejecutar la consulta preparada
    // Ejecutar la consulta preparada y capturar la excepción en caso de error
    try {
      $stmt->execute();
    } catch (Exception $e) {
      echo "Error al actualizar la imagen: " . $e->getMessage();
    }
    $stmt->close();
  }
  if ($FornCurso === "mantener") {
    // El usuario ha seleccionado la opción "mantener", asignar el valor actual del campo
    $FornCurso = $_POST["NomCurso_Actual"];
  }
  $sql_Actualizar = "UPDATE observador SET Id_Imagen=?, Nombre_Estudiante=?, Apellido_Estudiante=?, Numero_Documento=?, Id_DatosFamiliar=?, Id_Historial_Escolar=?, Id_Medicina=?, Id_Curso=?, Tel_Cel=?, Fecha_Nacimiento=?, LugarNacimiento=?, Residencia=?, Edad=? WHERE Id_Estudiante=?";
  $stmt = $conexion->prepare($sql_Actualizar);
  $stmt->bind_param('issiiiiisssssi', $ultimoId_Imagen, $Nombre_Est, $Apellido_Est, $NumeroIdentif_Est, $Id_Acudiente, $Id_Historial_Escolar, $Id_Medicina, $FornCurso, $Telefono_Est, $Fecha_Nacimiento_Est, $Lugar_Nacimiento_Est, $Residencia_Est, $Edad_Est, $Id_Estudiante);
  $stmt->execute();
  $stmt->close();

  /*FINALIZA ESTUDIANTE*/
  /*ACTUALIZA CURSOS*/
  $sql_curso = "UPDATE curso c SET Numero_Alumnos = (SELECT COUNT(*) FROM observador o 
    WHERE o.Id_Curso = c.Id_Curso)";
  $resultado = mysqli_query($conexion, $sql_curso) or die
    ("ERROR EN LA INSERCION");
  /*FINALIZA ACTUALIZA CURSOS*/
  /*FINALIZA INSERCCION*/
  mysqli_close($conexion);
  echo "(<script>alert('LOS REGISTROS SE ACTUALIZARON CORRECTAMENTE')</script>)";
  echo "<script>location.href = '../Profesor/anotaciones_busc.php'</script>";
}
?>