<?php
include ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia/templates/AnnotationHeader.php");
include ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia/models/TeacherModel.php"); ?>
<main class="ContainerGeneral">
  <h1 id="TitleStart"><?php echo $isUpdate ? 'Actualizar ' : 'Registrar '; ?>Profesor</h1>
  <form method="post" class="formulario" enctype="multipart/form-data">
    <fieldset>
      <div class="formulario__campos1">
        <div>
          <label>Nombre</label>
          <input type="text" name="Nombre" class="Input_Text" value="<?php echo htmlspecialchars($Nombre); ?>" placeholder="Nombre del Profesor" required>
        </div>
        <div>
          <label>Apellido</label>
          <input type="text" name="Apellido" class="Input_Text" value="<?php echo htmlspecialchars($Apellido); ?>" placeholder="Apellido del Profesor" required>
        </div>
        <div>
          <label>Numero de Documento</label>
          <input type="number" name="NumDocumento" class="Input_Text" value="<?php echo htmlspecialchars($NumDocumento); ?>" placeholder="Digite Numero de documento" required>
        </div>
        <div>
          <label>Teléfono</label>
          <input type="number" name="Telefono" class="Input_Text" value="<?php echo htmlspecialchars($Telefono); ?>" placeholder="Teléfono del Profesor" required>
        </div>
        <div>
          <label>Fecha Nacimiento</label>
          <input type="date" name="Fecha_Nacimiento" class="Input_Text" value="<?php echo htmlspecialchars($Fecha_Nacimiento); ?>" placeholder="Fecha de Nacimiento del Profesor" required>
        </div>
        <div>
          <label>Asignación Academica</label>
          <input type="text" name="AsignaturaAca" class="Input_Text" value="<?php echo htmlspecialchars($AsignaturaAca); ?>" placeholder="Asignatura Academica del Profesor" maxlength="20" required>
        </div>
        <div>
          <label>Asignatura</label>
          <input type="text" name="AsignaturaProfe" class="Input_Text" value="<?php echo htmlspecialchars($AsignaturaProfe); ?>" placeholder="Asignatura del Profesor" maxlength="30" required>
        </div>
        <div>
          <label>Area</label>
          <input type="text" name="Area" class="Input_Text" value="<?php echo htmlspecialchars($Area); ?>" placeholder="Area del Profesor" maxlength="30">
        </div>
        <div>
          <label>Email</label>
          <input type="text" name="Correo" class="Input_Text" value="<?php echo htmlspecialchars($Correo); ?>" placeholder="Correo del Profesor" maxlength="50">
        </div>
        <div>
          <label>Contraseña</label>
          <input type="text" name="Contrasena" class="Input_Text" value="<?php echo htmlspecialchars($Contrasena); ?>" placeholder="Contraseña del Profesor" maxlength="255">
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
                src="<?php echo BASE_URL; ?>/assets/images/phototeacher/<?php echo htmlspecialchars($NombreImagen); ?>">
            </div>
            <div>
              <svg class="navbar-icon" style="margin:0;">
                <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Picture.svg#Picture-icon">
              </svg>
            </div>
          </div>
        </div>
        <input type="hidden" name="id_lastImg" value="<?php echo htmlspecialchars($ultimoId_Imagen); ?>">
        <input type="hidden" name="id_profesor" value="<?php echo htmlspecialchars($Id_Profesor); ?>">
      </div>
      <div class="alinear-boton">
        <input type="hidden" name="action" value="<?php echo $isUpdate ? 'update' : 'create'; ?>">
        <input type="submit" name="Enviar2" class="boton" value="Enviar">
      </div>
    </fieldset>
  </form>
</main>
</body>
</html>