<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/models/StudentModel.php");
?>
<main class="ContainerGeneral">
  <!-- ===== Formulario Acuediente ===== -->
  <form method="post" enctype="multipart/form-data">
    <div id="form1" class="formulario">
      <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>ACUDIENTE <i class="fa-solid fa-user-plus"></i></h1>
      <fieldset>
        <div class="formulario__campos1">
          <div>
            <label>Nombre *</label>
            <div class="setting">
              <input type="text" name="nombre" class="Input_Text" value="<?php echo htmlspecialchars($NombreGua); ?>" placeholder="Nombre del acudiente" required>
            </div>
          </div>
          <div>
            <label>Apellido *</label>
            <div class="setting">
              <input type="text" name="apellido" class="Input_Text" value="<?php echo htmlspecialchars($ApellidoGua); ?>" placeholder="Apellido del acudiente" required>
            </div>
          </div>
          <div>
            <label>Ocupación</label>
            <div class="setting">
              <input type="text" name="ocupacion" class="Input_Text" value="<?php echo htmlspecialchars($OcupacionGua); ?>" placeholder="Ocupación del acudiente">
            </div>
          </div>
          <div>
            <label>Teléfono *</label>
            <div class="setting">
              <input class="Input_Text" type="number" name="telefono" class="Input_Text" value="<?php echo htmlspecialchars($TelefonoGua); ?>" placeholder="Teléfono del acudiente" required>
            </div>
          </div>
          <div>
            <label>Email *</label>
            <div class="setting">
              <input type="text" name="emailgua" class="Input_Text" value="<?php echo htmlspecialchars($EmailGua); ?>" placeholder="Email del acudiente" required>
            </div>
          </div>
          <div>
            <label>Parentesco *</label>
            <div class="setting">
              <input type="text" name="parentesco" class="Input_Text" value="<?php echo htmlspecialchars($ParentescoGua); ?>" placeholder="Parentesco del acudiente" required>
            </div>
          </div>
          <div>
            <label>¿Vive con el estudiante? *</label>
            <div class="setting">
              <input type="hidden" name="ViveAcu_Actual" value="<?php echo htmlspecialchars($ViveAcudienteGua) ?>" required>
              <select name="ViveAcudiente" class="Input_Text">
                <?php if ($isUpdate) { ?>
                  <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($ViveAcudienteGua) ?></option>
                <?php } else { ?>
                  <option disabled selected>...</option>
                <?php } ?>
                <option>Si</option>
                <option>No</option>
              </select>
            </div>
          </div>
        </div>
        <div class="alinear-boton" style="justify-content: space-evenly;">
          <button type="button" class="boton" onclick="mostrarFormulario('form2')">SIGUIENTE <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </fieldset>
    </div>
    <!-- ===== Formulario historial_escolar ===== -->
    <div id="form2" class="formulario" style="display: none;">
      <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>COLEGIO ANTERIOR <i class="fa-solid fa-school"></i></h1>
      <fieldset>
        <div class="formulario__campos1">
          <div>
            <label>Colegio</label>
            <div class="setting">
              <input type="text" name="Colegio_Anterior" class="Input_Text" value="<?php echo htmlspecialchars($ColegioAnterior); ?>" placeholder="Nombre Colegio">
            </div>
          </div>
          <div>
            <label>Ultimo Grado Realizado</label>
            <div class="setting">
              <input type="text" name="Ult_Curso_Cursado" class="Input_Text" value="<?php echo htmlspecialchars($UltCursoCursado); ?>" placeholder="Ultimo mt_grados Cursado">
            </div>
          </div>
          <div>
            <label>Jornada</label>
            <div class="setting">
              <input type="text" name="Jornada" class="Input_Text" value="<?php echo htmlspecialchars($Jornada); ?>" placeholder="Horario Jornada">
            </div>
          </div>
          <div>
            <label>¿Es repitente?</label>
            <div class="setting">
              <input type="hidden" name="Repitente_Actual" value="<?php echo htmlspecialchars($EsRepitente) ?>">
              <select name="Es_Repitente" class="Input_Text">
                <?php if ($isUpdate) { ?>
                  <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($EsRepitente) ?></option>
                <?php } else { ?>
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
              <input type="hidden" name="RepiteCant_Actual" value="<?php echo htmlspecialchars($CuantasVeces) ?>">
              <select name="CuantasVeces" class="Input_Text">
                <?php if ($isUpdate) { ?>
                  <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($CuantasVeces) ?></option>
                <?php } else { ?>
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
            <label>¿Practicaba algun deporte?</label>
            <div class="setting">
              <input type="hidden" name="PracticDep_Actual" value="<?php echo htmlspecialchars($PracticaDeporte) ?>">
              <select name="PracticaDeporte" class="Input_Text">
                <?php if ($isUpdate) { ?>
                  <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($PracticaDeporte) ?></option>
                <?php } else { ?>
                  <option disabled selected>...</option>
                <?php } ?>
                <option>Si</option>
                <option>No</option>
              </select>
            </div>
          </div>
          <div>
            <label>Nombre del Deporte</label>
            <div class="setting">
              <input type="text" name="Nombre_Deporte" class="Input_Text" value="<?php echo htmlspecialchars($NombreDeporte); ?>" placeholder="Ingrese Nombre Deporte">
            </div>
          </div>
        </div>
        <div class="alinear-boton" style="justify-content: space-evenly;">
          <button type="button" class="boton" onclick="mostrarFormulario('form1')"><i class="fa-solid fa-arrow-left"></i> ANTERIOR</button>
          <button type="button" class="boton" onclick="mostrarFormulario('form3')">SIGUIENTE <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </fieldset>
    </div>
    <!-- ===== Formulario Medicos ===== -->
    <div id="form3" class="formulario" style="display: none;">
      <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>DATOS MEDICOS <i class="fa-solid fa-suitcase-medical"></i></h1>
      <fieldset>
        <div class="formulario__campos1">
          <div>
            <label>Eps *</label>
            <div class="setting">
              <input type="text" name="Eps" class="Input_Text" value="<?php echo htmlspecialchars($Eps); ?>" placeholder="Nombre Eps" required>
            </div>
          </div>
          <div>
            <label>Restricciones médicas *</label>
            <div class="setting">
              <input type="text" name="RestSanitaMed" class="Input_Text" value="<?php echo htmlspecialchars($RestSanitaMed); ?>" placeholder="Parentesco del acudiente" required>
            </div>
          </div>
          <div>
            <label>Discapacidades *</label>
            <div class="setting">
              <input type="text" name="DiscapMed" class="Input_Text" value="<?php echo htmlspecialchars($DiscapMed); ?>" placeholder="Parentesco del acudiente" required>
            </div>
          </div>
          <div>
            <label>Enfermedades actuales</label>
            <div class="setting">
              <input type="text" name="EnferMed" class="Input_Text" value="<?php echo htmlspecialchars($EnferMed); ?>" placeholder="Ocupación del acudiente">
            </div>
          </div>
          <div>
            <label>Recomendaciones Medicas</label>
            <div class="setting">
              <input type="text" name="Recomendaciones" class="Input_Text"
                value="<?php echo htmlspecialchars($Recomendaciones); ?>" placeholder="Recomendaciones Medicas" required>
            </div>
          </div>
          <div>
            <label>Antecendentes medicos</label>
            <div class="setting">
              <input type="text" name="Antecendentes" class="Input_Text"
                value="<?php echo htmlspecialchars($Antecendentes); ?>" placeholder="Antecendentes Medicas" required>
            </div>
          </div>
          <div>
            <label>Grupo Sangüínea *</label>
            <div class="setting">
              <input type="hidden" name="GrupSangui_Actual" value="<?php echo htmlspecialchars($IdTipoSanMed) ?>" required>
              <select name="FornTipoSangre" class="Input_Text">
                <?php if ($isUpdate) { ?>
                  <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($NomTipoSangre) ?></option>
                <?php } else { ?>
                  <option disabled selected>Tipo de Sangre</option>
                <?php } ?>
                <?php
                foreach ($totalSangre as $opciones): ?>
                  <option value="<?php echo $opciones['IdTipoSanMed'] ?>">
                    <?php echo $opciones['GrupoSanguineo'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="alinear-boton" style="justify-content: space-evenly;">
          <button type="button" class="boton" onclick="mostrarFormulario('form2')"><i class="fa-solid fa-arrow-left"></i> ANTERIOR</button>
          <button type="button" class="boton" onclick="mostrarFormulario('form4')">SIGUIENTE <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </fieldset>
    </div>
    <!-- ===== Formulario Estudiante ===== -->
    <div id="form4" class="formulario" style="display: none;">
      <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>ESTUDIANTE <i class="fa-solid fa-address-book"></i></h1>
      <fieldset>
        <div class="formulario__campos1">
          <div>
            <label>Nombre *</label>
            <div class="setting">
              <input type="text" name="Nombre_Est" class="Input_Text" value="<?php echo htmlspecialchars($NombreStu); ?>" placeholder="Nombre del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Apellido *</label>
            <div class="setting">
              <input type="text" name="Apellido_Est" class="Input_Text" value="<?php echo htmlspecialchars($ApellidoStu); ?>" placeholder="Apellido del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Tipo de Documento *</label>
            <div class="setting">
              <input type="hidden" name="TipoDcto_Actual" value="<?php echo htmlspecialchars($TipoDcto) ?>" required>
              <select name="TipoDcto" class="Input_Text">
                <?php if ($isUpdate) { ?>
                  <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($TipoDcto) ?></option>
                <?php } else { ?>
                  <option disabled selected>...</option>
                <?php } ?>
                <option>CC</option>
                <option>TI</option>
                <option>CE</option>
              </select>
            </div>
          </div>
          <div>
            <label>Número Identificación *</label>
            <div class="setting">
              <input type="number" name="NumeroIdentif_Est" class="Input_Text" value="<?php echo htmlspecialchars($NumDcto); ?>" placeholder="NºI del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Teléfono</label>
            <div class="setting">
              <input type="number" name="Telefono_Est" class="Input_Text" value="<?php echo htmlspecialchars($TelefonoStu); ?>" placeholder="Teléfono del Estudiante">
            </div>
          </div>
          <div>
            <label>Fecha Nacimiento *</label>
            <div class="setting">
              <input type="date" name="Fecha_Nacimiento_Est" class="Input_Text" value="<?php echo htmlspecialchars($FechaNacimientoStu); ?>" placeholder="Fecha de Nacimiento del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Direccion *</label>
            <div class="setting">
              <input type="text" name="Residencia_Est" class="Input_Text" value="<?php echo htmlspecialchars($Direccion); ?>" placeholder="Dirección del Estudiante" required>
            </div>
          </div>
          <div>
            <label>Grado Actual *<label>
                <div class="setting">
                  <input type="hidden" name="IdGrado_Actual" value="<?php echo htmlspecialchars($IdGrado) ?>" required>
                  <select name="FornIdGrado" class="Input_Text">
                    <?php if ($isUpdate) { ?>
                      <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($NomGrado) ?></option>
                    <?php } else { ?>
                      <option disabled selected>...</option>
                    <?php } ?>
                    <?php
                    foreach ($mt_grados as $opciones): ?>
                      <option value="<?php echo $opciones['IdGrado'] ?>">
                        <?php echo $opciones['NomGrado'] ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
          </div>
          <div>
            <label>Seleccione Grupo al que va a pertenecer *<label>
                <div class="setting">
                  <select name="FornIdGrupo" class="Input_Text">
                    <?php if ($isUpdate) { ?>
                      <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($IdGrupo) ?></option>
                    <?php } else { ?>
                      <option disabled selected>...</option>
                    <?php } ?>
                    <?php
                    foreach ($mt_grupos as $opciones): ?>
                      <option value="<?php echo $opciones['IdGrupo'] ?>">
                        <?php echo $opciones['IdGrupo'] ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
          </div>
          <div>
            <label>Email</label>
            <div class="setting">
              <input type="text" name="Correo" class="Input_Text" value="<?php echo htmlspecialchars($Email); ?>" placeholder="Correo del Estudiante" maxlength="50">
            </div>
          </div>
          <div>
            <label>Contraseña</label>
            <div class="setting">
              <input type="text" name="Contrasena" class="Input_Text" value="<?php echo htmlspecialchars($Password); ?>" placeholder="Contraseña del Estudiante" maxlength="255">
            </div>
          </div>
          <div>
            <label>Imagen Usuario Nueva *</label>
            <div class="setting">
              <input type="file" name="Imagen" class="Input_Text" <?php if (!$isUpdate) echo 'required'; ?>>
              <i class="fa-solid fa-upload fa-2x"></i>
            </div>
          </div>
          <div>
            <label>Imagen Usuario Anterior</label>
            <div class="setting">
              <input type="hidden" name="Nom_Imagen" value="<?php echo htmlspecialchars($NombreImagen); ?>">
              <div class="imagenChange Input_Text">
                <img src="<?php echo BASE_URL; ?>/assets/images/photostudent/<?php echo htmlspecialchars($NombreImagen); ?>">
              </div>
              <i class="fa-solid fa-image fa-2x"></i>
            </div>
          </div>
        </div>
        <div class="alinear-boton" style="justify-content: space-evenly;">
          <button type="button" class="boton" onclick="mostrarFormulario('form3')"><i class="fa-solid fa-arrow-left"></i> ANTERIOR</button>
          <input type="hidden" name="action" value="<?php echo $isUpdate ? 'update' : 'create'; ?>">
          <input type="hidden" name="IdGuardian" value="<?php echo htmlspecialchars($IdDatAcudi); ?>">
          <input type="hidden" name="IdEscolar" value="<?php echo htmlspecialchars($IdHistEsc); ?>">
          <input type="hidden" name="IdMedica" value="<?php echo htmlspecialchars($IdMed); ?>">
          <input type="hidden" name="IdObservador" value="<?php echo htmlspecialchars($IdObs); ?>">
          <input type="hidden" name="IdUser" value="<?php echo htmlspecialchars($IdUser); ?>">
          <input type="hidden" name="IdImg" value="<?php echo htmlspecialchars($IdImg); ?>">
          <button type="submit" class="boton" name="SendDataStudent">ENVIAR <i class="fa-solid fa-paper-plane"></i></button>
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
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>