<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/TeacherController.php");
?>
<main class="ContainerGeneral">
  <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>PROFESOR <i class="fa-solid fa-pen"></i></h1>
  <form method="post" class="formulario" enctype="multipart/form-data">
    <fieldset>
      <div class="formulario__campos1">
        <div>
          <label>Nombre *</label>
          <div class="setting">
            <input type="text" name="Nombre" class="Input_Text" value="<?php echo htmlspecialchars($Nombre); ?>" placeholder="Nombre del Profesor" required>
          </div>
        </div>
        <div>
          <label>Apellido *</label>
          <div class="setting">
            <input type="text" name="Apellido" class="Input_Text" value="<?php echo htmlspecialchars($Apellido); ?>" placeholder="Apellido del Profesor" required>
          </div>
        </div>
        <div>
          <label>Tipo de Documento *</label>
          <div class="setting">
          <input type="hidden" name="TipoDcto_Actual" value="<?php echo htmlspecialchars($TipoDcto) ?>">
          <select type="text" name="TipoDcto" class="Input_Text">
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
          <label>Numero de Documento *</label>
          <div class="setting">
          <input type="number" name="NumDocumento" class="Input_Text"
            value="<?php echo htmlspecialchars($NumDocumento); ?>" placeholder="Digite Numero de documento" required>
            </div>
        </div>
        <div>
          <label>Teléfono *</label>
          <div class="setting">
          <input type="number" name="Telefono" class="Input_Text" value="<?php echo htmlspecialchars($Telefono); ?>" placeholder="Teléfono del Profesor" required>
            </div>
        </div>
        <div>
          <label>Fecha Nacimiento *</label>
          <div class="setting">
            <input type="date" name="Fecha_Nacimiento" class="Input_Text" value="<?php echo htmlspecialchars($Fecha_Nacimiento); ?>" placeholder="Fecha de Nacimiento del Profesor" required>
          </div>
        </div>
        <div>
          <label>Direccion *</label>
          <div class="setting">
            <input type="text" name="Direccion" class="Input_Text" value="<?php echo htmlspecialchars($Direccion); ?>" placeholder="Localidad Hogar" required>
          </div>
        </div>
        <div>
          <label>Asignación Academica *</label>
          <div class="setting">
            <input type="text" name="AsigAcadeProf" class="Input_Text" value="<?php echo htmlspecialchars($AsigAcadeProf); ?>" placeholder="Asignatura Academica del Profesor" maxlength="20" required>
          </div>
        </div>
        <div>
          <label>Seleccione Materia a Dictar *<label>
            <div class="setting">
              <input type="hidden" name="IdMateria_Actual" value="<?php echo htmlspecialchars($IdMateria) ?>">
              <select name="FornIdMateria" class="Input_Text">
                <?php if ($isUpdate) { ?>
                  <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($NomMateria) ?></option>
                  <option value="quitar">
                    Sin grupo
                  </option>
                <?php } else { ?>
                  <option disabled selected>...</option>
                <?php } ?>
                <?php
                foreach ($mt_materias as $opciones): ?>
                  <option value="<?php echo $opciones['IdMateria'] ?>">
                    <?php echo $opciones['NomMateria'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
        <div>
          <label>Area *</label>
          <div class="setting">
            <input type="text" name="Area" class="Input_Text" value="<?php echo htmlspecialchars($AreaProf); ?>" placeholder="Area del Profesor" maxlength="30">
          </div>
        </div>
        <div>
          <label>Seleccione Grupo si es Director<label>
            <div class="setting">
              <input type="hidden" name="IdGrupo_Actual" value="<?php echo htmlspecialchars($IdGrupo) ?>">
              <select name="FornIdGrupo" class="Input_Text">
                <?php if ($isUpdate) { ?>
                  <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($IdGrupo) ?></option>
                  <option value="quitar">
                    Sin grupo
                  </option>
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
            <input type="text" name="Correo" class="Input_Text" value="<?php echo htmlspecialchars($Email); ?>" placeholder="Correo del Profesor" maxlength="50">
          </div>
        </div>
        <div>
          <label>Contraseña</label>
          <div class="setting">
            <input type="text" name="Contrasena" class="Input_Text" value="<?php echo htmlspecialchars($Password); ?>" placeholder="Contraseña del Profesor" maxlength="255">
          </div>
        </div>
        <div>
          <label>Imagen Usuario Nueva</label>
          <div class="setting">
            <input type="file" name="Imagen" class="Input_Text" <?php if ($isUpdate) echo 'required'; ?>>
            <i class="fa-solid fa-download fa-2xl"></i>
          </div>
        </div>
        <div>
          <label>Imagen Usuario Anterior</label>
          <div class="setting">
            <input type="hidden" name="Nom_Imagen" value="<?php echo htmlspecialchars($NombreImagen); ?>">
            <div class="imagenChange Input_Text">
              <img src="<?php echo BASE_URL; ?>/assets/images/phototeacher/<?php echo htmlspecialchars($NombreImagen); ?>">
            </div>
           <i class="fa-solid fa-image fa-2xl"></i>
          </div>
        </div>
        <input type="hidden" name="id_lastImg" value="<?php echo htmlspecialchars($ultimoId_Imagen); ?>">
        <input type="hidden" name="id_profesor" value="<?php echo htmlspecialchars($IdUser); ?>">
      </div>
      <div class="alinear-boton">
        <input type="hidden" name="action" value="<?php echo $isUpdate ? 'update' : 'create'; ?>">
        <input type="submit" name="Enviar2" class="boton" value="Enviar">
      </div>
    </fieldset>
  </form>
</main>
<?php include(ROOT_PATH."/templates/HomeFooter.php"); ?>