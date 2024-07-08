<?php
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
include ("$RootPath/templates/HomeHeader.php");
include ("$RootPath/config/ProtectPages.php");
include ("$RootPath/models/DatabaseConnection.php"); ?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <?php include ("$RootPath/controllers/teacher/StudentInfo.php"); ?>
    <div class="anotaciones">
      <div class="nav__miniventana">
        <a></a>
        <h1 id="TitleStart">ANOTACIONES</h1>
        <div>
          <a href="AnnotationsHistory.php">
            <div class="botonAtras">
              <div class="margen__boton">
                <svg class="navbar-icon" style="margin:0;">
                  <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Arrow_Back.svg#Arrow_Back-icon">
                </svg>
              </div>
            </div>
          </a>
        </div>
      </div>
      <?php
      $Id_Anota = $_POST['NumIdAnnotation'];
      $consultar2 = mysqli_query($conexion, "select * from anotacion WHERE IdAnot='$Id_Anota'") or die("ERROR AL TRAER LOS DATOS");
      ?>
      <form action="../../models/FormulariosTodos.php" method="post" class="formulario">
        <fieldset>
          <?php while ($extraido = mysqli_fetch_array($consultar2)) { ?>
            <div>
              <div class="Add_Anotacion">
                <label>TIPO DE FALTA</label>
                <input type="hidden" name="NumeroModificar" value="<?php echo $Id_Anota; ?>">
                <input type="hidden" name="tipoFaltaActual" value="<?php echo $extraido['TipoFalta']; ?>">
                <select name="TipoFalta" class="Input_Text" required>
                  <option value="mantener" selected>Asignado: <?php echo $extraido['TipoFalta']; ?></option>
                  <option>Leve</option>
                  <option>Grave</option>
                  <option>Muy grave</option>
                </select>
              </div>
              <div class="Add_Anotacion">
                <label>DESCRIPCION DE LA ANOTACIÓN</label>
                <textarea maxlength="255" class="Input_Text" name="descripcion"
                  required><?php echo $extraido['DescFalta']; ?></textarea>
              </div>
              <div class="Add_Anotacion">
                <label>ANOTACION CREADA POR</label>
                <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NomProfCread']; ?>">
              </div>
              <div class="Add_Anotacion">
                <label>ULTIMA MODIFICACION REALIZADA POR</label>
                <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NomProfModif']; ?>">
              </div>
            </div>
          <?php } ?>
        </fieldset>
        <div class="alinear-boton">
          <input class="boton" type="submit" name="Enviar6" value="ENVIAR ANOTACIÓN">
        </div>
      </form>
    </div>
  </div>
</main>
<?php include ("$RootPath/templates/HomeFooter.php"); ?>