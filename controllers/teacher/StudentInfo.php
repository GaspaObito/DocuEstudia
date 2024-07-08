<div class="usuario__especifico">
  <?php
  if (isset($_POST['NumeroModificar'])) {
    $_SESSION['Id_Session'] = $_POST['NumeroModificar'];
  }
  $Id_Est = $_SESSION['Id_Session'];
  /* Utilizar Join para Ingresar el otro Campos de Curso */
  $consultar = mysqli_query($conexion, "SELECT CONCAT(o.NomEst, ' ', o.ApeEst) AS NombreCompleto, o.*, c.NomCurso, i.NomImg
      FROM observador o LEFT JOIN imagenes i ON o.IdImgEst = i.IdImg LEFT JOIN curso c ON o.IdCurso = c.IdCurso WHERE o.IdEst='$Id_Est'") or die("ERROR AL TRAER LOS DATOS");
  while ($extraido = mysqli_fetch_array($consultar)) {?>
    <h3 id="DataUser">Perfil</h3>
    <div class="imagen">
      <img width="100" src="<?php echo BASE_URL; ?>/assets/images/photostudent/<?php echo $extraido['NomImg'] ?>">
    </div>
    <h3 id="DataUser">DATOS DEL ESTUDIANTE</h3>
    <div class="usuario__campo">
      <label>Nombre:</label>
      <div>
        <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NombreCompleto'] ?>">
      </div>
    </div>
    <div class="usuario__campo">
      <label>DNI:</label>
      <div>
        <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NumDocEst'] ?>">
      </div>
    </div>
    <div class="usuario__campo">
      <label>Curso:</label>
      <div>
        <input readonly class="Input_Text" type="text" value="<?php echo $extraido['NomCurso'] ?>">
      </div>
    </div>
  <?php } ?>
  <div class="alinear-boton">
    <button name="VerHistorial" id="btnAbrir" name="btnAbrir2" type="submit" class="boton">MAS INFORMACIÓN</button>
  </div>
</div>

<script src="<?php echo BASE_URL; ?>/assets/js/miniventana.js"></script>

<div class="margen__miniventana">
  <?php
  if (isset($_POST["btnAbrir2"])) {
    $NumeroInsertar = $_POST['NumeroInsertar'];
    $_SESSION['Id_Session'] = $NumeroInsertar;
  }
  /*DATOS MÉDICOS DEL ESTUDIANTE*/
  $NumeroInsertar = $_SESSION['Id_Session'];
  $consultar = mysqli_query($conexion, "SELECT CONCAT(o.NomEst, ' ', o.ApeEst) AS NombreCompleto, o.*, c.NomCurso
                                      FROM observador o
                                      LEFT JOIN curso c ON o.IdCurso = c.IdCurso WHERE o.IdEst='$NumeroInsertar'") or die("ERROR AL TRAER LOS DATOS");
  ?>
  <div class="miniVentana" id="miniVentana">
    <div id="formularioContainer">
      <form id="formulario1">
        <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
          <div class="nav__miniventana">
            <a></a>
            <h3 id="DataUser">DATOS DEL ESTUDIANTE</h3>
            <div><a id="btnCerrar">
                <div class="botonAtras">
                  <div class="margen__boton">
                    <svg class="navbar-icon" style="margin:0;">
                      <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Symbol_X.svg#Symbol_X-icon">
                    </svg>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="grid__miniventana">
            <div class="formulario__miniventana">
              <label>Nombre</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['NomEst'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Apellido</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['ApeEst'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Teléfono</label>
              <input readonly class="input_miniventana" type="number" value="<?php echo $extraido['TelEst'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Fecha Nacimiento</label>
              <input readonly class="input_miniventana" type="date" value="<?php echo $extraido['FecNacEst'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Dirección</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['ResidenEst'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Lugar Nacimiento</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['LugNacEst'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Número Identificación</label>
              <input readonly class="input_miniventana" type="number" value="<?php echo $extraido['NumDocEst'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>EdadEst</label>
              <input readonly class="input_miniventana" type="number" value="<?php echo $extraido['EdadEst'] ?>">
            </div>
          </div>
          <div class="margen">
            <div> <a id="btnSiguiente1">
                <div class="botonAtras">
                  <div class="margen__boton">
                    <svg class="navbar-icon" style="margin:0;">
                      <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Arrow_Next.svg#Arrow_Next-icon">
                    </svg>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </form>
      <?php }
        /*DATOS MÉDICOS DEL ESTUDIANTE*/
        $consultar = mysqli_query($conexion, "SELECT o.*, i.*, i.NomEPSMed, t.GrupoSanguineo
                                      FROM observador o
                                      LEFT JOIN info_medica i ON o.IdMed = i.IdMed
                                      LEFT JOIN tipo_sangre t ON i.IdTipoSanMed = t.IdTipoSanMed
                                      WHERE o.IdEst = '$NumeroInsertar'") or die("ERROR AL TRAER LOS DATOS"); ?>
      <form id="formulario2" style="display: none;">
        <div class="nav__miniventana">
          <a></a>
          <h3 id="DataUser">DATOS MÉDICOS DEL ESTUDIANTE</h3>
          <div><a id="btnCerrar1">
              <div class="botonAtras">
                <div class="margen__boton">
                  <svg class="navbar-icon" style="margin:0;">
                    <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Symbol_X.svg#Symbol_X-icon">
                  </svg>
                </div>
              </div>
            </a>
          </div>
          <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
          </div>
          <div class="grid__miniventana">
            <div class="formulario__miniventana">
              <label>EPS</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['NomEPSMed'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Prioridad Sanitaria</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['PrioSanitaMed'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Recomendaciones Medicas</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['RecomMed'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Antecendentes medicos</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['RecomMed'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Grupo Sangüínea</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['GrupoSanguineo'] ?>">
            </div>
          </div>
          <div class="margen">
            <div>
              <a id="btnAnterior2">
                <div class="botonAtras">
                  <div class="margen__boton">
                    <svg class="navbar-icon" style="margin:0;">
                      <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Arrow_Back.svg#Arrow_Back-icon">
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
                      <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Arrow_Next.svg#Arrow_Next-icon">
                    </svg>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </form>
      <?php }
          /*DATOS DEL ACUDIENTE*/
          $consultar = mysqli_query($conexion, "SELECT o.*, i.*, i.NomAcudi
                   FROM observador o
                   LEFT JOIN datos_familiar i ON o.IdDatAcudi = i.IdDatAcudi        
                   WHERE o.IdEst = '$NumeroInsertar'") or die("ERROR AL TRAER LOS DATOS"); ?>
      <form id="formulario3" style="display: none;">
        <div class="nav__miniventana">
          <a></a>
          <h3 id="DataUser">DATOS DEL ACUDIENTE</h3>
          <div><a id="btnCerrar2">
              <div class="botonAtras">
                <div class="margen__boton">
                  <svg class="navbar-icon" style="margin:0;">
                    <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Symbol_X.svg#Symbol_X-icon">
                  </svg>
                </div>
              </div>
            </a>
          </div>
          <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
          </div>
          <div class="grid__miniventana">
            <div class="formulario__miniventana">
              <label>Nombre</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['NomAcudi'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Apellido</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['ApeAcudi'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Parentesco</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['ParentesAcudi'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Ocupación</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['OcupacionAcudi'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Teléfono</label>
              <input readonly class="input_miniventana" type="number" value="<?php echo $extraido['TelAcudi'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Email</label>
              <input readonly class="input_miniventana" type="email" value="<?php echo $extraido['EmailAcudi'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>¿Vive con el acudiente?</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['ViveEstAcudi'] ?>">
            </div>
          </div>
          <div class="margen">
            <div>
              <a id="btnAnterior3">
                <div class="botonAtras">
                  <div class="margen__boton">
                    <svg class="navbar-icon" style="margin:0;">
                      <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Arrow_Back.svg#Arrow_Back-icon">
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
                      <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Arrow_Next.svg#Arrow_Next-icon">
                    </svg>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </form>
      <?php }
          /*DATOS HISTORIAL_ESCOLAR*/
          $consultar = mysqli_query($conexion, "SELECT o.*, i.*, i.AnteriorEsc
                FROM observador o
                LEFT JOIN historial_escolar i ON o.IdHistEsc = i.IdHistEsc        
                WHERE o.IdEst = '$NumeroInsertar'") or die("ERROR AL TRAER LOS DATOS"); ?>
      <form id="formulario4" style="display: none;">
        <div class="nav__miniventana">
          <a></a>
          <h3 id="DataUser">DATOS HISTORIAL ESCOLAR</h3>
          <div><a id="btnCerrar3">
              <div class="botonAtras">
                <div class="margen__boton">
                  <svg class="navbar-icon" style="margin:0;">
                    <use xlink:href="<?php echo BASE_URL; ?>/assets/images/svg/Symbol_X.svg#Symbol_X-icon">
                  </svg>
                </div>
              </div>
            </a>
          </div>
          <?php while ($extraido = mysqli_fetch_array($consultar)) { ?>
          </div>
          <div class="grid__miniventana">
            <div class="formulario__miniventana">
              <label>Colegio del Anterior</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['AnteriorEsc'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Direccion</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['DireccionEsc'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Curso</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['CursoEsc'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Jornada</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['JornadaEsc'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Es Repitente</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['RepitenteEsc'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Cantidad Repitente</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['CantRepiEsc'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>¿Practica algun Deporte?</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['PracDeportEsc'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Nombre del Deporte</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['NomDeportEsc'] ?>">
            </div>
          </div>
          <div class="margen">
            <div>
              <a id="btnAnterior4">
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
        </form>
      <?php } ?>
    </div>
  </div>
</div>