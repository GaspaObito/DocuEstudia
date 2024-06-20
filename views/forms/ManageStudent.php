<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia/templates/AnnotationHeader.php");
include ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia/models/StudentModel.php");
$consulta_T = "SELECT * FROM tipo_sangre";
$ejecutar_T = mysqli_query($conexion, $consulta_T) or die(mysqli_error($conexion));
$consulta_C = "SELECT * FROM curso";
$ejecutar_C = mysqli_query($conexion, $consulta_C) or die(mysqli_error($conexion));?>
<main class="ContainerGeneral">
  <!--Formulario Acuediente-->
  <form method="post" enctype="multipart/form-data">
    <div id="form1" class="formulario">
      <h1 id="TitleStart"><?php echo $isUpdate ? 'Actualizar ' : 'Registrar '; ?>Acudiente</h1>
      <fieldset>
        <div class="formulario__campos1">
          <div>
            <label>Nombre</label>
            <div class="setting">
              <input type="text" name="nombre" class="Input_Text" value="<?php echo htmlspecialchars($NombreGua); ?>" placeholder="Nombre del acudiente" required>
            </div>
          </div>
          <div>
            <label>Apellido</label>
            <div class="setting">
              <input type="text" name="apellido" class="Input_Text" value="<?php echo htmlspecialchars($ApellidoGua); ?>" placeholder="Apellido del acudiente" required>
            </div>
          </div>
          <div>
            <label>Ocupación</label>
            <div class="setting">
              <input type="text" name="ocupacion" class="Input_Text" value="<?php echo htmlspecialchars($OcupacionGua); ?>" placeholder="Ocupación del acudiente" required>
            </div>
          </div>
          <div>
            <label>Teléfono</label>
            <div class="setting">
              <input class="Input_Text" type="number" name="telefono"  class="Input_Text" value="<?php echo htmlspecialchars($TelefonoGua); ?>" placeholder="Teléfono del acudiente" required>
            </div>
          </div>
          <div>
            <label>Email</label>
            <div class="setting">
              <input type="text" name="email" class="Input_Text" value="<?php echo htmlspecialchars($EmailGua); ?>" placeholder="Email del acudiente" required>
            </div>
          </div>
          <div>
            <label>Parentesco</label>
            <div class="setting">
              <input type="text" name="parentesco" class="Input_Text" value="<?php echo htmlspecialchars($ParentescoGua); ?>" placeholder="Parentesco del acudiente" required>
            </div>
          </div>
          <div>
            <label>¿Vive con el acudiente?</label>
            <div class="setting">
              <select name="ViveAcudiente" class="Input_Text">
                <option disabled selected>...</option>
                <option>Si</option>
                <option>No</option>
              </select>
            </div>
          </div>
        </div>
        <div class="alinear-boton" style="justify-content: space-evenly;">
          <button type="button" class="boton" onclick="mostrarFormulario('form2')">Siguiente</button>
        </div>
      </fieldset>
    </div>
    <!--Formulario historial_escolar-->
    <div id="form2" class="formulario" style="display: none;">
      <h1 id="TitleStart"><?php echo $isUpdate ? 'Actualizar ' : 'Registrar '; ?>Hisorial Escolar</h1>
      <fieldset>
        <div class="formulario__campos1">
          <div>
            <label>Colegio</label>
            <div class="setting">
              <input type="text" name="Colegio_Anterior" class="Input_Text" value="<?php echo htmlspecialchars($ColegioAnterior); ?>" placeholder="Nombre Colegio">
            </div>
          </div>
          <div>
            <label>Direccion del Colegio</label>
            <div class="setting">
              <input type="text" name="Direccion" class="Input_Text" value="<?php echo htmlspecialchars($Direccion); ?>" placeholder="Direccion Colegio" required>
            </div>
          </div>
          <div>
            <label>Ultimo Curso</label>
            <div class="setting">
              <input type="text" name="Ult_Curso_Cursado" class="Input_Text" value="<?php echo htmlspecialchars($UltCursoCursado); ?>" placeholder="Ultimo Curso Cursado" required>
            </div>
          </div>
          <div>
            <label>Jornada</label>
            <div class="setting">
              <input type="text" name="Jornada" class="Input_Text" value="<?php echo htmlspecialchars($Jornada); ?>" placeholder="Horario Jornada" required>
            </div>
          </div>
          <div>
            <label>¿Es repitente?</label>
            <div class="setting">
              <select name="Es_Repitente" class="Input_Text">
                <option disabled selected>...</option>
                <option>Si</option>
                <option>No</option>
              </select>
            </div>
          </div>
          <div>
            <label>¿Cuantas Veces?</label>
            <div class="setting">
              <select name="CuantasVeces" class="Input_Text">
                <option disabled selected>...</option>
                <option>Ninguna</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>Mas de 4</option>
              </select>
            </div>
          </div>
          <div>
            <label>¿Practica Deporte?</label>
            <div class="setting">
              <select name="PracticaDeporte" class="Input_Text">
                <option disabled selected>...</option>
                <option>Si</option>
                <option>No</option>
              </select>
            </div>
          </div>
          <div>
            <label>Nombre Deporte</label>
            <div class="setting">
              <input type="text" name="Nombre_Deporte" class="Input_Text" value="<?php echo htmlspecialchars($NombreDeporte); ?>" placeholder="Ingrese Nombre Deporte">
            </div>
          </div>
        </div>
        <div class="alinear-boton" style="justify-content: space-evenly;">
          <button type="button" class="boton" onclick="mostrarFormulario('form1')">Anterior</button>
          <button type="button" class="boton" onclick="mostrarFormulario('form3')">Siguiente</button>
        </div>
      </fieldset>
    </div>
    <!--Formulario Medicos-->
    <div id="form3" class="formulario" style="display: none;">
      <h1 id="TitleStart"><?php echo $isUpdate ? 'Actualizar ' : 'Registrar '; ?>Datos Medicos</h1>
      <fieldset>
        <div class="formulario__campos1">
          <div>
            <label>Eps</label>
            <div class="setting">
              <input type="text" name="Eps" class="Input_Text" value="<?php echo htmlspecialchars($Eps); ?>" placeholder="Nombre Eps">
            </div>
          </div>
          <div>
            <label>Prioridad Sanitaria</label>
            <div class="setting">
              <input type="text" name="Sanitaria" class="Input_Text" value="<?php echo htmlspecialchars($Sanitaria); ?>" placeholder="Parentesco del acudiente" required>
            </div>
          </div>
          <div>
            <label>Ocupación</label>
            <div class="setting">
              <input type="text" name="Ocupación" class="Input_Text" value="<?php echo htmlspecialchars($Ocupación); ?>" placeholder="Ocupación del acudiente" required>
            </div>
          </div>
          <div>
            <label>Recomendaciones Medicas</label>
            <div class="setting">
              <input type="text" name="Recomendaciones" class="Input_Text" value="<?php echo htmlspecialchars($Recomendaciones); ?>" placeholder="Recomendaciones Medicas" required>
            </div>
          </div>
          <div>
            <label>Antecendentes medicos</label>
            <div class="setting">
              <input type="text" name="Antecendentes" class="Input_Text" value="<?php echo htmlspecialchars($Antecendentes); ?>" placeholder="Antecendentes Medicas" required>
            </div>
          </div>
          <div>
            <label>Grupo Sangüínea</label>
            <div class="setting">
              <select name="FornTipoSangre" class="Input_Text">
                <option disabled selected>Tipo de Sangre</option>
                <?php foreach ($ejecutar_T as $opciones): ?>
                  <option value="<?php echo $opciones['Id_Tipo_Sangre'] ?>">
                    <?php echo $opciones['Grupo_Sanguineo'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="alinear-boton" style="justify-content: space-evenly;">
          <button type="button" class="boton" onclick="mostrarFormulario('form2')">Anterior</button>
          <button type="button" class="boton" onclick="mostrarFormulario('form4')">Siguiente</button>
        </div>
      </fieldset>
    </div>
    <!--Formulario Estudiante-->
    <div id="form4" class="formulario" style="display: none;">
      <h1 id="TitleStart"><?php echo $isUpdate ? 'Actualizar ' : 'Registrar '; ?>Estudiante</h1>
      <fieldset>
        <div class="formulario__campos1">
          <input type="hidden" name="id_estudiante" class="Input_Text" value="<?php echo $extraido['Id_Estudiante']; ?>">
          <div>
            <label>Nombre</label>
            <div class="setting">
              <input  type="text" name="Nombre_Est" class="Input_Text" value="<?php echo htmlspecialchars($NombreStu); ?>" placeholder="Nombre del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Apellido</label>
            <div class="setting">
              <input type="text" name="Apellido_Est" class="Input_Text" value="<?php echo htmlspecialchars($ApellidoStu); ?>" placeholder="Apellido del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Teléfono</label>
            <div class="setting">
              <input type="number" name="Telefono_Est" class="Input_Text" value="<?php echo htmlspecialchars($TelefonoStu); ?>" placeholder="Teléfono del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Fecha Nacimiento</label>
            <div class="setting">
              <input type="date" name="Fecha_Nacimiento_Est" class="Input_Text" value="<?php echo htmlspecialchars($FechaNacimientoStu); ?>" placeholder="Fecha de Nacimiento del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Residencia</label>
            <div class="setting">
              <input type="text" name="Residencia_Est" class="Input_Text" value="<?php echo htmlspecialchars($ResidenciaStu); ?>" placeholder="Dirección del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Lugar Nacimiento</label>
            <div class="setting">
              <input type="text" name="Lugar_Nacimiento_Est" class="Input_Text" value="<?php echo htmlspecialchars($LugarNacimientoStu); ?>" placeholder="Lugar de Nacimiento del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Número Identificación</label>
            <div class="setting">
              <input type="number" name="NumeroIdentif_Est" class="Input_Text" value="<?php echo htmlspecialchars($NumeroIdentifStu); ?>" placeholder="NºI del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Curso Estudiante</label>
            <div class="setting">
              <select name="FornCurso" class="Input_Text">
                <option disabled selected>Ingreso Curso</option>
                <?php foreach ($ejecutar_C as $opciones): ?>
                  <option value="<?php echo $opciones['Id_Curso'] ?>">
                    <?php echo $opciones['Nom_Curso'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div>
            <label>Edad</label>
            <div class="setting">
              <input type="number" name="Edad_Est" class="Input_Text" value="<?php echo htmlspecialchars($EdadStu); ?>" placeholder="Edad del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Imagen Usuario Nueva</label>
            <div class="setting">
              <input type="file" name="Imagen" class="Input_Text"required>
              <svg class="navbar-icon" style="margin:0">
                <use xlink:href="../Assets/Svg/Upload.svg#Upload-icon">
              </svg>
            </div>
          </div>
        </div>
        <div class="alinear-boton" style="justify-content: space-evenly;">
          <button type="button" class="boton" onclick="mostrarFormulario('form3')">Anterior</button>
          <input type="hidden" name="action" value="<?php echo $isUpdate ? 'update' : 'create'; ?>">
          <button type="submit" class="boton" name="SendDataStudent">Enviar</button>
        </div>
      </fieldset>
    </div>
  </form>
</main>
<script>
  function mostrarFormulario(formulario) {
    document.getElementById('form1').style.display = 'none';
    document.getElementById('form2').style.display = 'none';
    document.getElementById('form3').style.display = 'none';
    document.getElementById('form4').style.display = 'none';
    document.getElementById(formulario).style.display = 'block';
  }
</script>
<?php include ("../../templates/TeacherFooter.php"); ?>