<?php include ("../Template/CabeceraLogin.php"); ?>
<main class="ContainerGeneral contenedor sombra">
  <div>
    <?php
    include '../Config/Conexion.php';
    $Identificacion = $_SESSION['Id_Estudiante'];
    $consultar = mysqli_query($conexion, "SELECT CONCAT(o.Nombre_Estudiante, ' ', o.Apellido_Estudiante) AS NombreCompleto, o.*, c.Nom_Curso, i.Nombre_Imagen
                    FROM observador o
                    LEFT JOIN imagenes i ON o.Id_Imagen = i.Id_Imagen
                    LEFT JOIN curso c ON o.Id_Curso = c.Id_Curso WHERE o.Numero_Documento='$Identificacion'") or die("ERROR AL TRAER LOS DATOS");
    while ($extraido = mysqli_fetch_array($consultar)) {
      ?>
      <div class="usuario__especifico">
        <div class="nav__miniventana">
          <a></a>
          <h3 id="DataUser">Perfil</h3>
          <div>
            <a href="historial_anotaciones.php">
              <div class="botonAtras">
                <div class="margen__boton">
                  <svg class="navbar-icon" style="margin:0;">
                    <use xlink:href="../Assets/Svg/Arrow_Back.svg#Arrow_Back-icon">
                  </svg>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="imagen">
          <img width="100" src="../Assets/Photos_Students/<?php echo $extraido['Nombre_Imagen']; ?>">
        </div>
        <h3 id="DataUser">DATOS DEL ESTUADIANTE</h3>
        <div class="usuario__campo"><label>Nombre:</label>
          <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NombreCompleto']; ?>">
        </div>
        <div class="usuario__campo">
          <label>N.I:</label>
          <input readonly class="Input_Text" type="text" value="<?php echo $extraido['Numero_Documento']; ?>">
        </div>
        <div class="usuario__campo">
          <label>Curso:</label>
          <input readonly class="Input_Text" type="text" value="<?php echo $extraido['Nom_Curso']; ?>">
        </div>
      </div>
    <?php } ?>
    <div class="anotaciones">
      <h1 id="TitleStart">ANOTACIONES</h1>
      <?php
      $Id_Anota = $_POST['NumeroVer'];
      $consultar2 = mysqli_query($conexion, "select * from anotacion WHERE Id_Anotacion='$Id_Anota'") or die("ERROR AL TRAER LOS DATOS");
      ?>
      <form class="formulario">
        <fieldset>
          <?php while ($extraido = mysqli_fetch_array($consultar2)) { ?>
            <div>
              <div class="Add_Anotacion">
                <label>TIPO DE FALTA</label>
                <input readonly class="Input_Text" type="text" placeholder="TIPO DE FALTA"
                  value="<?php echo $extraido['Tipo_Falta']; ?>">
              </div>
              <div class="Add_Anotacion">
                <label>DESCRIPCION DE LA ANOTACIÓN</label>
                <textarea readonly class="Input_Text"><?php echo $extraido['Descripcion_Falta']; ?></textarea>
              </div>
            </div>
          <?php } ?>
        </fieldset>
      </form>
    </div>
  </div>
</main>
<?php include ("../Template/FooterProfe2.php"); ?>