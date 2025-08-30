<div class="usuario__especifico">
  <?php
  $Id_Profe = $_SESSION['Id_Profe'];
  $consultar2 = mysqli_query($conexion, "SELECT CONCAT(Nombre, ' ', Apellido) AS NombreCompleto, u.*, i.NomImg,p.AsigAcadeProf,p.AsigProf
        FROM usuarios u LEFT JOIN imagenes i ON i.IdImg = u.IdImg LEFT JOIN profesor p ON p.IdUser = u.IdUser WHERE u.IdUser='$Id_Profe'") or die("ERROR AL TRAER LOS DATOS");
  while ($extraido = mysqli_fetch_array($consultar2)) {
    $_SESSION['NombreProfe'] = $extraido['NombreCompleto']; ?>
    <h3 id="DataUser">Perfil</h3>
    <div class="imagen">
      <img width="100" src="<?php echo BASE_URL; ?>/assets/images/phototeacher/<?php echo $extraido['NomImg'] ?>">
    </div>
    <h3 id="DataUser">DATOS DEL PROFESOR</h3>
    <div class="usuario__campo">
      <label>Nombre:</label>
      <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NombreCompleto'] ?>">
    </div>
    <div class="usuario__campo">
      <label>DNI:</label>
      <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NumDcto'] ?>">
    </div>
    <div class="usuario__campo">
      <label>Asignatura:</label>
      <input readonly class="Input_Text" type="text" value="<?php echo $extraido['AsigProf'] ?>">
    </div>
    <div class="usuario__campo">
      <label>Email:</label>
      <input readonly class="Input_Text" type="text" value="<?php echo $extraido['Email'] ?>">
    </div>
  </div>
<?php } ?>