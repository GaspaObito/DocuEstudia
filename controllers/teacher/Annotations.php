<?php 
$RootPath = ($_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");
include ("$RootPath/templates/HomeHeader.php");
include ("$RootPath/config/ProtectPages.php");
include ("$RootPath/models/DatabaseConnection.php"); ?>
<main class="ContainerGeneral">
  <div class="ContainerUser">
    <div class="usuario__especifico">
      <script src="<?php echo BASE_URL; ?>/assets/js/miniventana.js"></script>
      <?php
      if (isset($_POST["NumeroInsertar"])) {
        $NumeroInsertar = $_POST['NumeroInsertar'];
        $_SESSION['Id_Session'] = $NumeroInsertar;
      }
      $NumeroInsertar = $_SESSION['Id_Session'];
      /* Utilizar Join para Ingresar el otro Campos de Curso */
      $consultar = mysqli_query($conexion, "SELECT CONCAT(o.Nombre_Estudiante, ' ', o.Apellido_Estudiante) AS NombreCompleto, o.*, c.Nom_Curso, i.Nombre_Imagen
                                      FROM observador o
                                      LEFT JOIN imagenes i ON o.Id_Imagen = i.Id_Imagen
                                      LEFT JOIN curso c ON o.Id_Curso = c.Id_Curso WHERE o.Id_Estudiante='$NumeroInsertar'") or die("ERROR AL TRAER LOS DATOS");
      while ($extraido = mysqli_fetch_array($consultar)) {?>
        <h3 id="DataUser">Perfil</h3>
            <div class="imagen">
              <img width="100" src="<?php echo BASE_URL; ?>/assets/images/photostudent2/<?php echo $extraido['Nombre_Imagen']?>">
          <?php echo ' </div>   
           <h3 id="DataUser">DATOS DEL ESTUDIANTE</h3>
                        <div class="usuario__campo">';
        $IdGeneral = $extraido['Id_Estudiante'];
        $NomGeneral = $_SESSION['NombreProfe'];
        echo ' <label>Nombre:</label>
                            <div>';
        echo ' <input type="hidden" name="Id_Est" value="' . $extraido['Id_Estudiante'] . '">';
        echo '<input readonly class="Input_Text" type="text" value="' . $extraido['NombreCompleto'] . '">
                            </div>
                        </div>
                        <div class="usuario__campo">
                            <label>N.I:</label>
                            <div>';
        echo '<input readonly class="Input_Text" type="text" value="' . $extraido['Numero_Documento'] . '">
                            </div>
                        </div>
                        <div class="usuario__campo">
                            <label>Curso:</label>
                            <div>';
        echo '<input readonly class="Input_Text" type="text" value="' . $extraido['Nom_Curso'] . '">
                            </div>
                        </div>';
      }
      ?>
      <div class="alinear-boton">
        <button name="VerHistorial" id="btnAbrir" name="btnAbrir2" type="submit" class="boton">MAS
          INFORMACIÓN</button>
      </div>
      <div class="margen__miniventana">
        <?php
        if (isset($_POST["btnAbrir2"])) {
          $NumeroInsertar = $_POST['NumeroInsertar'];
          $_SESSION['Id_Session'] = $NumeroInsertar;
        }
        /*DATOS MÉDICOS DEL ESTUDIANTE*/
        $NumeroInsertar = $_SESSION['Id_Session'];
        $consultar = mysqli_query($conexion, "SELECT CONCAT(o.Nombre_Estudiante, ' ', o.Apellido_Estudiante) AS NombreCompleto, o.*, c.Nom_Curso
                                      FROM observador o
                                      LEFT JOIN curso c ON o.Id_Curso = c.Id_Curso WHERE o.Id_Estudiante='$NumeroInsertar'") or die("ERROR AL TRAER LOS DATOS");
        echo ' <div class="miniVentana" id="miniVentana">
                    <div id="formularioContainer">
                     <form id="formulario1">';
        while ($extraido = mysqli_fetch_array($consultar)) {
          echo '<div class="nav__miniventana">
                            <a></a>
                                    <h3 id="DataUser">DATOS DEL ESTUDIANTE</h3>
                                    <div><a id="btnCerrar">
                                    <div class="botonAtras">
                                        <div class="margen__boton">
                                            <svg class="navbar-icon" style="margin:0;">
                                                <use xlink:href="../../assets/images/svg/Symbol_X.svg#Symbol_X-icon">
                                            </svg>
                                        </div>
                                    </div>
                                </a></div>
                            </div>
                            <div class="grid__miniventana">
                                <div class="formulario__miniventana">
                                    <label>Nombre</label>
                                    <input readonly class="input_miniventana" type="text" value="' . $extraido['Nombre_Estudiante'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Apellido</label>
                                    <input readonly class="input_miniventana" type="text" value="' . $extraido['Apellido_Estudiante'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Teléfono</label>
                                    <input readonly class="input_miniventana" type="number" value="' . $extraido['Tel_Cel'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Fecha Nacimiento</label>
                                    <input readonly class="input_miniventana" type="date" value="' . $extraido['Fecha_Nacimiento'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Dirección</label>
                                    <input readonly class="input_miniventana" type="text" value="' . $extraido['Residencia'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Lugar Nacimiento</label>
                                    <input readonly class="input_miniventana" type="text" value="' . $extraido['LugarNacimiento'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Número Identificación</label>
                                    <input readonly class="input_miniventana" type="number" value="' . $extraido['Numero_Documento'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Edad</label>
                                    <input readonly class="input_miniventana" type="number" value="' . $extraido['Edad'] . '">
                                </div>
                            </div>                     
                            <div class="margen">
                            <div> <a id="btnSiguiente1">
                                <div class="botonAtras">
                                    <div class="margen__boton">
                                            <svg class="navbar-icon" style="margin:0;">
                                                <use xlink:href="../Assets/Svg/Arrow_Next.svg#Arrow_Next-icon">
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            
                            </div>

                                </div>
                                
                        </form>';
        }
        /*DATOS MÉDICOS DEL ESTUDIANTE*/
        $consultar = mysqli_query($conexion, "SELECT o.*, i.*, i.Nombre_EPS, t.Grupo_Sanguineo
                                      FROM observador o
                                      LEFT JOIN info_medica i ON o.Id_Medicina = i.Id_Medicina
                                      LEFT JOIN tipo_sangre t ON i.Id_Tipo_Sangre = t.Id_Tipo_Sangre
                                      WHERE o.Id_Estudiante = '$NumeroInsertar'") or die("ERROR AL TRAER LOS DATOS");
        echo '<form id="formulario2" style="display: none;">
                       <div class="nav__miniventana">
                       <a></a>
                                    <h3 id="DataUser">DATOS MÉDICOS DEL ESTUDIANTE</h3>
                                
                                <div><a id="btnCerrar1">
                                    <div class="botonAtras">
                                        <div class="margen__boton">
                                            <svg class="navbar-icon" style="margin:0;">
                                                <use xlink:href="../Assets/Svg/Symbol_X.svg#Symbol_X-icon">
                                            </svg>
                                        </div>
                                    </div>
                                </a></div>'
        ;
        while ($extraido = mysqli_fetch_array($consultar)) {
          echo '
                            </div>
                            <div class="grid__miniventana">
                                <div class="formulario__miniventana">
                                    <label>EPS</label>
                                    <input readonly class="input_miniventana" type="text" value="' . $extraido['Nombre_EPS'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Prioridad Sanitaria</label>
                                    <input readonly class="input_miniventana" type="text" value="' . $extraido['Prioridad_Sanitaria'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Recomendaciones Medicas</label>
                                    <input readonly class="input_miniventana" type="text" value="' . $extraido['Recomendaciones_Medicas'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Antecendentes medicos</label>
                                    <input readonly class="input_miniventana" type="text" value="' . $extraido['Antecedentes_Medicos'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Grupo Sangüínea</label>
                                    <input readonly class="input_miniventana" type="text" value="' . $extraido['Grupo_Sanguineo'] . '">
                                </div>             
                            </div>
                            <div class="margen">
                                <div>
                                    <a id="btnAnterior2">
                                        <div class="botonAtras">
                                            <div class="margen__boton">
                                                <svg class="navbar-icon" style="margin:0;">
                                                    <use xlink:href="../Assets/Svg/Arrow_Back.svg#Arrow_Back-icon">
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a id="btnSiguiente2">
                                        <div class="botonAtras">
                                            <div class="margen__boton">
                                                <svg class="navbar-icon" style="margin:0;">
                                                    <use xlink:href="../Assets/Svg/Arrow_Next.svg#Arrow_Next-icon">
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </form>';
        }
        /*DATOS DEL ACUDIENTE*/
        $consultar = mysqli_query($conexion, "SELECT o.*, i.*, i.Nombre_Acudiente
                       FROM observador o
                       LEFT JOIN datos_familiar i ON o.Id_DatosFamiliar = i.Id_DatosFamiliar        
                       WHERE o.Id_Estudiante = '$NumeroInsertar'") or die("ERROR AL TRAER LOS DATOS");
        echo '<form id="formulario3" style="display: none;">
                            <div class="nav__miniventana">
                            <a></a>
                                    <h3 id="DataUser">DATOS DEL ACUDIENTE</h3>
                                
                                <div><a id="btnCerrar2">
                                    <div class="botonAtras">
                                        <div class="margen__boton">
                                            <svg class="navbar-icon" style="margin:0;">
                                                <use xlink:href="../Assets/Svg/Symbol_X.svg#Symbol_X-icon">
                                            </svg>
                                        </div>
                                    </div>
                                </a></div>'
        ;
        while ($extraido = mysqli_fetch_array($consultar)) {
          echo '</div>
                            <div class="grid__miniventana">
                                <div class="formulario__miniventana">
                                    <label>Nombre</label>
                                    <input readonly class="input_miniventana" type="text"  value="' . $extraido['Nombre_Acudiente'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Apellido</label>
                                    <input readonly class="input_miniventana" type="text"  value="' . $extraido['Apellido_Acudiente'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Parentesco</label>
                                    <input readonly class="input_miniventana" type="text"  value="' . $extraido['Parentesco'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Ocupación</label>
                                    <input readonly class="input_miniventana" type="text"  value="' . $extraido['Ocupacion'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Teléfono</label>
                                    <input readonly class="input_miniventana" type="number"  value="' . $extraido['Tel_Cel'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>Email</label>
                                    <input readonly class="input_miniventana" type="email"  value="' . $extraido['Email'] . '">
                                </div>
                                <div class="formulario__miniventana">
                                    <label>¿Vive con el acudiente?</label>
                                    <input readonly class="input_miniventana" type="text"  value="' . $extraido['Vive_Con_Estudiante'] . '">
                                
                                </div>
                            </div>
                            <div class="margen">
                                <div>
                                    <a id="btnAnterior3">
                                        <div class="botonAtras">
                                            <div class="margen__boton">
                                                <svg class="navbar-icon" style="margin:0;">
                                                    <use xlink:href="../Assets/Svg/Arrow_Back.svg#Arrow_Back-icon">
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a id="btnSiguiente3">
                                        <div class="botonAtras">
                                            <div class="margen__boton">
                                                <svg class="navbar-icon" style="margin:0;">
                                                    <use xlink:href="../Assets/Svg/Arrow_Next.svg#Arrow_Next-icon">
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                </form>';
        }
        /*DATOS HISTORIAL_ESCOLAR*/
        $consultar = mysqli_query($conexion, "SELECT o.*, i.*, i.Colegio_Anterior
                    FROM observador o
                    LEFT JOIN historial_escolar i ON o.Id_Historial_Escolar = i.Id_Historial_Escolar        
                    WHERE o.Id_Estudiante = '$NumeroInsertar'") or die("ERROR AL TRAER LOS DATOS");
        echo '<form id="formulario4" style="display: none;">
                         <div class="nav__miniventana">
                            <a></a>
                                 <h3 id="DataUser">DATOS HISTORIAL ESCOLAR</h3>                        
                             <div><a id="btnCerrar3">
                             <div class="botonAtras">
                                 <div class="margen__boton">
                                    <svg class="navbar-icon" style="margin:0;">
                                        <use xlink:href="../Assets/Svg/Symbol_X.svg#Symbol_X-icon">
                                    </svg>
                                 </div>
                             </div>
                         </a></div>'
        ;
        while ($extraido = mysqli_fetch_array($consultar)) {
          echo '</div>
                         <div class="grid__miniventana">
                             <div class="formulario__miniventana">
                                 <label>Colegio del Anterior</label>
                                 <input readonly class="input_miniventana" type="text"  value="' . $extraido['Colegio_Anterior'] . '">
                             </div>
                             <div class="formulario__miniventana">
                                 <label>Direccion</label>
                                 <input readonly class="input_miniventana" type="text"  value="' . $extraido['Direccion'] . '">
                             </div>
                             <div class="formulario__miniventana">
                                 <label>Curso</label>
                                 <input readonly class="input_miniventana" type="text"  value="' . $extraido['Curso'] . '">
                             </div>
                             <div class="formulario__miniventana">
                                 <label>Jornada</label>
                                 <input readonly class="input_miniventana" type="text"  value="' . $extraido['Jornada'] . '">
                             </div>
                             <div class="formulario__miniventana">
                                 <label>Es Repitente</label>
                                 <input readonly class="input_miniventana" type="text"  value="' . $extraido['Repitente'] . '">
                             </div>
                             <div class="formulario__miniventana">
                                 <label>Cantidad Repitente</label>
                                 <input readonly class="input_miniventana" type="text"  value="' . $extraido['Cantidad_Repitente'] . '">
                             </div>
                             <div class="formulario__miniventana">
                                 <label>¿Practica algun Deporte?</label>
                                 <input readonly class="input_miniventana" type="text"  value="' . $extraido['Practica_Deporte'] . '">                
                             </div>
                             <div class="formulario__miniventana">
                             <label>Nombre del Deporte</label>
                             <input readonly class="input_miniventana" type="text"  value="' . $extraido['Nombre_Deporte'] . '">                
                         </div>
                         </div>
                         <div class="margen">
                            <div>
                             <a id="btnAnterior4">
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
                     </form>';
        }
        echo '</div>
                </div>
            </div>';
        ?>
      </div>
      <div class="anotaciones">
        <div class="nav__miniventana">
          <a></a>
          <h1 id="TitleStart">ANOTACIONES</h1>
          <div>
            <a href="AnnotationsSearch.php">
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
        <div class="Container1">
          <form action="../Config/Formularios_Todos.php" method="post" class="formulario">
            <fieldset>
              <?php
              echo ' <input type="hidden" name="Id_Est" value="' . $_SESSION['Id_Session'] . '">';
              $idEstudiante = $_SESSION['Id_Session']; ?>
              <?php echo ' <input type="hidden" name="Nom_Prof" value="' . $NomGeneral . '">'; ?>
              <div>
                <div class="Add_Anotacion">
                  <label>TIPO DE FALTA</label>
                  <select name="tipoFalta" class="Input_Text">
                    <option disabled selected>...</option>
                    <option>Leve</option>
                    <option>Grave</option>
                    <option>Muy grave</option>
                  </select>
                </div>
                <div class="Add_Anotacion">
                  <label>DESCRIPCION DE LA ANOTACIÓN</label>
                  <textarea maxlength="255" name="descripcion" class="Input_Text"></textarea>
                </div>
              </div>
            </fieldset>
            <div class="alinear-boton">
              <button class="boton" type="submit" name="Enviar5">ENVIAR ANOTACION</button>
            </div>
          </form>
        </div>
        <div class="alinear-boton">
          <form action="AnnotationsHistory.php" method="post">
            <?php echo '<input type="hidden" name="Id_Est" value="' . $IdGeneral . '">'; ?>
            <button name="VerHistorial" type="submit" class="boton">VER HISTORIAL</button>
          </form>
        </div>
      </div>
    </div>
</main>
<?php include ("$RootPath/templates/HomeFooter.php"); ?>