<?php include ("../../templates/LoginHeader.php");?>
<main>
  <div class="ContainerGeneral">
    <h1 id="TitleStart">BIENVENIDO AL OBSERVADOR</h1>
    <p>El trabajo del observador en línea puede incluir la revisión de la planificación de lecciones,
      la observación de clases virtuales en tiempo real o grabadas, la revisión de
      tareas y evaluaciones, la comunicación con los estudiantes y maestros, y la elaboración de informes
      sobre
      el desempeño y el progreso de los estudiantes.
    </p>
    <form class="Form_Acudiente" style="align-items: center;" action="../Config/auth/conectar_RegistroUsuario.php"
      method="post">
      <label>Ingreso del N.i:</label>
      <input class="Input_Text" type="number" name="Identificacionn" placeholder="N.I del estudiante"
        oninput="javascript: if (this.value.length > 10) this.value = this.value.slice(0, 10);">
      <button class="boton" type="submit" name='LoginStudent'>INICIAR SESION</button>
    </form>
  </div>
</main>
<?php include ("../../templates/TeacherFooter.php"); ?>