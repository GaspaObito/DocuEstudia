<?php
require_once(__DIR__ . "/../../config/config.php");
require_once(ROOT_PATH . "/templates/HomeHeader.php");
require_once(ROOT_PATH . "/config/ProtectPages.php");
require_once(ROOT_PATH . "/controllers/TeacherController.php");
?>
<main class="ContainerGeneral">
  <h1 id="TitleStart"><?php echo $isUpdate ? 'ACTUALIZAR ' : 'REGISTRAR '; ?>MAESTRO DE MATERIAS X DOCENTE <?php echo $IdMateriasProf ?> <i
      class="fa-solid fa-pen"></i></h1>
  <form method="post" class="formulario" enctype="multipart/form-data">
    <fieldset>
      <div class="formulario__campos1">
        <input type="hidden" name="IdMateriasProf_Actual" value="<?php echo htmlspecialchars($IdMateriasProf) ?>">
        <!-- Selección Profesores -->
        <div>
          <label>Profesores</label>
          <div class="setting">
            <input type="hidden" name="IdUser_Actual" value="<?php echo htmlspecialchars($IdUser) ?>">
            <select name="FornIdUser" class="Input_Text">
              <?php if ($isUpdate) { ?>
                <option value="mantener" selected>Asignado:<?php echo htmlspecialchars($NombreCompleto) ?></option>
              <?php } else { ?>
                <option disabled selected>...</option>
              <?php } ?>
              <?php
              foreach ($mt_profesores as $opciones): ?>
                <option value="<?php echo $opciones['IdUser'] ?>">
                  <?php echo $opciones['NombreCompleto'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <!-- Selección materias -->
        <div>
          <label>Materia</label>
          <div class="setting">
            <input type="hidden" name="IdMateria_Actual" value="<?php echo htmlspecialchars($IdMateria) ?>">
            <select name="FornIdMateria" class="Input_Text">
              <?php if ($isUpdate) { ?>
                <option value="mantener" selected>Asignado: <?php echo htmlspecialchars($NomMateria) ?></option>
                <option value="quitar">Sin Materia</option>
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
        <!-- Selección Grado -->
        <div>
          <label>Grado</label>
          <div class="setting">
            <input type="hidden" name="IdGrado_Actual" value="<?php echo htmlspecialchars($IdGrado) ?>">
            <select name="FornIdGrado" class="Input_Text">
              <?php if ($isUpdate) { ?>
                <option value="mantener" selected>Asignado: <?php echo htmlspecialchars($NomGrado) ?></option>
                <option value="quitar">Sin Grado</option>
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
        <!-- Selección Grupo -->
          <div>
            <label>Seleccione Grupo<label>
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
      </div>
      <div class="alinear-boton">
        <input type="hidden" name="action" value="<?php echo $isUpdate ? 'updateMatterxTeacher' : 'createMatterxTeacher'; ?>">
        <input type="submit" name="EnviarMatterxTeacher" class="boton" value="Enviar">
      </div>
    </fieldset>
  </form>
</main>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>