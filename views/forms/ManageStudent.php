<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia/templates/AnnotationHeader.php");
include ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia/models/StudentModel.php");?>
<main class="ContainerGeneral">
  <!-- ===== Formulario Acuediente ===== -->
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
              <input type="hidden" name="ViveAcu_Actual" value="<?php echo htmlspecialchars($ViveAcudienteGua)?>">                
              <select name="ViveAcudiente" class="Input_Text">
                <?php if ($isUpdate) { ?>
                    <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($ViveAcudienteGua)?></option>
                <?php  } else { ?>
                    <option disabled selected>...</option>
                <?php } ?>
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
    <!-- ===== Formulario historial_escolar ===== -->
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
            <input type="hidden" name="Repitente_Actual" value="<?php echo htmlspecialchars($EsRepitente)?>">
              <select name="Es_Repitente" class="Input_Text">
                <?php if ($isUpdate) { ?>
                    <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($EsRepitente)?></option>
                <?php  } else { ?>
                    <option disabled selected>...</option>
                <?php } ?>
                <option>Si</option>
                <option>No</option>
              </select>
            </div>
          </div>
          <div>
            <label>¿Cuantas Veces?</label>
            <div class="setting">
              <input type="hidden" name="RepiteCant_Actual" value="<?php echo htmlspecialchars($CuantasVeces)?>">
              <select name="CuantasVeces" class="Input_Text">
                <?php if ($isUpdate) { ?>
                    <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($CuantasVeces)?></option>
                <?php  } else { ?>
                    <option disabled selected>...</option>
                <?php } ?>
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
              <input type="hidden" name="PracticDep_Actual" value="<?php echo htmlspecialchars($PracticaDeporte)?>">
              <select name="PracticaDeporte" class="Input_Text">
                <?php if ($isUpdate) { ?>
                    <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($PracticaDeporte)?></option>
                <?php  } else { ?>
                    <option disabled selected>...</option>
                <?php } ?>
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
    <!-- ===== Formulario Medicos ===== -->
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
              <input type="hidden" name="GrupSangui_Actual" value="<?php echo htmlspecialchars($IdTipoSangre)?>">
              <select name="FornTipoSangre" class="Input_Text">
                <?php if ($isUpdate) { ?>
                    <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($NomTipoSangre)?></option>
                <?php  } else { ?>
                    <option disabled selected>Tipo de Sangre</option>
                <?php } ?>              
                <?php foreach ($totalSangre as $opciones): ?>
                  <option value="<?php echo $opciones['IdTipoSanMed'] ?>">
                    <?php echo $opciones['GrupoSanguineo'] ?>
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
    <!-- ===== Formulario Estudiante ===== -->
    <div id="form4" class="formulario" style="display: none;">
      <h1 id="TitleStart"><?php echo $isUpdate ? 'Actualizar ' : 'Registrar '; ?>Estudiante</h1>
      <fieldset>
        <div class="formulario__campos1">
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
              <input type="hidden" name="NomCurso_Actual" value="<?php echo htmlspecialchars($IdCurso)?>">
              <select name="FornCurso" class="Input_Text">
                <?php if ($isUpdate) { ?>
                    <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($NomCurso)?></option>
                <?php  } else { ?>
                    <option disabled selected>Selecione el Curso</option>
                <?php } ?>              
                <?php foreach ($totalCurso as $opciones): ?>
                  <option value="<?php echo $opciones['IdCurso'] ?>">
                    <?php echo $opciones['NomCurso'] ?>
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
            <input type="file" name="Imagen" class="Input_Text" <?php if (!$isUpdate) echo 'required'; ?>>
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                <path
                  d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z">
                </path>
              </svg>
            </div>
          </div>
        </div>
        <div>
          <label>Imagen Usuario Anterior</label>
          <div class="setting">
            <input type="hidden" name="Nom_Imagen" value="<?php echo htmlspecialchars($NombreImagen); ?>">
            <div class="imagenChange Input_Text">
              <img
                src="<?php echo BASE_URL; ?>/assets/images/photostudent/<?php echo htmlspecialchars($NombreImagen); ?>">
            </div>
            <div>
              <svg class="navbar-icon" style="margin:0;">
                <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Picture.svg#Picture-icon">
              </svg>
            </div>
          </div>
        </div>
        </div>
        <div class="alinear-boton" style="justify-content: space-evenly;">
          <button type="button" class="boton" onclick="mostrarFormulario('form3')">Anterior</button>
          <input type="hidden" name="action" value="<?php echo $isUpdate ? 'update' : 'create'; ?>">
          <input type="hidden" name="IdGuardian" value="<?php echo htmlspecialchars($IdDatAcudi); ?>">
          <input type="hidden" name="IdEscolar" value="<?php echo htmlspecialchars($IdHistEsc); ?>">
          <input type="hidden" name="IdMedica" value="<?php echo htmlspecialchars($IdMed); ?>">
          <input type="hidden" name="IdObservador" value="<?php echo htmlspecialchars($IdEst); ?>">
          <input type="hidden" name="IdImgEst" value="<?php echo htmlspecialchars($IdImgEst); ?>">
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