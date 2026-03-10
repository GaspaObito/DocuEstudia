<?php
require_once(ROOT_PATH . "/models/StudentInfoModel.php");
?>
<div class="usuario__especifico">
  <?php
  while ($extraido = mysqli_fetch_array($DatosTeacher)) {
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
      <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NomMateria'] ?>">
    </div>
    <div class="usuario__campo">
      <label>Email:</label>
      <input readonly class="Input_Text" type="text" value="<?php echo $extraido['Email'] ?>">
    </div>
  </div>
<?php } ?>