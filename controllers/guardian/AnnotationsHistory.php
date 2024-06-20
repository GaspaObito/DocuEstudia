<?php include ("../Template/CabeceraLogin.php"); ?>
<main class="ContainerGeneral">
  <div>
    <?php
    include '../Config/Conexion.php';
    $Identificacion = $_SESSION['Id_Estudiante'];
    $consultar = mysqli_query($conexion, "SELECT CONCAT(o.Nombre_Estudiante, ' ', o.Apellido_Estudiante) AS NombreCompleto, o.*, c.Nom_Curso, i.Nombre_Imagen
                    FROM observador o
                    LEFT JOIN imagenes i ON o.Id_Imagen = i.Id_Imagen
                    LEFT JOIN curso c ON o.Id_Curso = c.Id_Curso WHERE o.Numero_Documento='$Identificacion'") or die("ERROR AL TRAER LOS DATOS");
    while ($extraido = mysqli_fetch_array($consultar)) {
      $Id_Est = $extraido['Id_Estudiante'];
      echo '<div class="usuario__especifico">       
                <h3 id="DataUser">Perfil</h3>
                <div class="imagen">
                <img width="100" src="../Assets/Photos_Students/' . $extraido['Nombre_Imagen'] . '">
                </div> 
                <h3 id="DataUser">DATOS DEL ESTUDIANTE</h3>
                <div class="usuario__campo">
                    <label>Nombre:</label>
                    <input readonly class="Input_Text" type="text"  value="' . $extraido['NombreCompleto'] . '">
                </div>
                <div class="usuario__campo">
                    <label>N.I:</label>
                    <input readonly class="Input_Text" type="text" value="' . $extraido['Numero_Documento'] . '">
                </div>
                <div class="usuario__campo">
                    <label>Curso:</label>
                    <input readonly class="Input_Text" type="text" value="' . $extraido['Nom_Curso'] . '">
                </div>
            </div>';
      $consultar2 = mysqli_query($conexion, "select * from anotacion WHERE Id_Estudiante='$Id_Est'") or die("ERROR AL TRAER LOS DATOS");
      $query = "SELECT COUNT(*) AS total FROM anotacion WHERE Id_Estudiante='$Id_Est'";
      $resultado = mysqli_query($conexion, $query);
      $datos = mysqli_fetch_assoc($resultado);
      $totalFilas = $datos['total'];
      echo '<div class="anotaciones">
                <h1 id="TitleStart">ANOTACIONES</h1>
                <div class="formulario">
                        <div class="Container1">
                        <label>Resultados Obtenidos: (' . $totalFilas . ')</label>';
      while ($extraido = mysqli_fetch_array($consultar2)) {
        echo '
                        <div class="DatosUsuario">
                            <label>T.FALTA</label>
                                <input readonly class="Input_Text" type="text" placeholder="Tipo de falta" value="' . $extraido['Tipo_Falta'] . '">
                            <label>FECHA</label>
                                <input  readonly class="Input_Text" type="text" placeholder="Fecha" value="' . $extraido['Fecha_Creacion'] . '">
                            <form action="descripcion_anotacion.php" method="post">   
                                <input type="hidden" name="NumeroVer" value="' . $extraido['Id_Anotacion'] . '">       
                                <button name="VerAnotacion" type="submit" class="img_margen custom-button">
                                    <svg class="navbar-icon">
                                        <use xlink:href="../Assets/Svg/Arrow.svg#Arrow-icon">
                                     </svg>                                           
                                </button>
                            </form>                    
                        </div>';
      }
      echo '
                </div>';
    }
    ?>
  </div>
  </div>
</main>
<?php include ("../Template/FooterProfe2.php"); ?>