<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/models/TeacherGroup_Grade.php");
?>
<main class="ContainerGeneral">
  <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>GRUPO <i class="fa-solid fa-pen"></i></h1>
  <form method="post" class="formulario" enctype="multipart/form-data">
    <fieldset>
      <div class="formulario__campos1">
        <div>
          <label>Grupo<label>
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
          <label>Grado<label>
              <div class="setting">
                <input type="hidden" name="IdGrado_Actual" value="<?php echo htmlspecialchars($IdGrado) ?>">
                <select name="FornIdGrado" class="Input_Text">
                  <?php if ($isUpdate) { ?>
                    <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($NomGrado) ?></option>
                    <option value="quitar">
                      Sin Grado
                    </option>
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
          <label>Grado<label>
              <div class="setting">
                <input type="hidden" name="IdGrado_Actual" value="<?php echo htmlspecialchars($IdGrado) ?>">
                <select name="FornIdGrado" class="Input_Text">
                  <?php if ($isUpdate) { ?>
                    <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($NombreCompleto) ?></option>
                    <option value="quitar">
                      Sin Grado
                    </option>
                  <?php } else { ?>
                    <option disabled selected>...</option>
                  <?php } ?>
                  <?php
                  foreach ($mt_profesores as $opciones): ?>
                    <option value="<?php echo $opciones['IdProf'] ?>">
                      <?php echo $opciones['NombreCompleto'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
        </div>
        <div>
          <label>Profesor</label>
          <div class="setting">
            <input type="text" name="Nombre" class="Input_Text" value="<?php echo htmlspecialchars($NombreCompleto); ?>"
              placeholder="Nombre del Profesor" required>
          </div>
        </div>
        <div>
          <label>Nombre del Grupo</label>
          <div class="setting">
            <input type="text" name="Correo" class="Input_Text" value="<?php echo htmlspecialchars($NomGrupo); ?>"
              placeholder="Correo del Profesor" maxlength="50">
          </div>
        </div>
      </div>
      <div class="alinear-boton">
        <input type="hidden" name="action" value="<?php echo $isUpdate ? 'update' : 'create'; ?>">
        <input type="submit" name="Enviar2" class="boton" value="Enviar">
      </div>
    </fieldset>
  </form>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>
</body>

</html>