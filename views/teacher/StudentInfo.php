<?php
require_once(ROOT_PATH . "/models/StudentInfoModel.php");
?>
<script src="<?php echo BASE_URL; ?>/assets/js/miniventana.js"></script>

<div class="usuario__especifico">
  <!-- DATOS GENERALES DEL ESTUDIANTE -->
  <?php foreach ($datos as $fila) { ?>
    <h3 id="DataUser">Perfil</h3>
    <div class="imagen">
      <img width="100" src="<?php echo BASE_URL; ?>/assets/images/photostudent/<?php echo $fila['NomImg'] ?>">
    </div>
    <h3 id="DataUser">DATOS DEL ESTUDIANTE</h3>
    <div class="usuario__campo">
      <label>Nombre:</label>
      <div>
        <input readonly class="Input_Text" type="text" value="<?php echo $fila['NombreCompleto'] ?>">
      </div>
    </div>
    <div class="usuario__campo">
      <label>DNI:</label>
      <div>
        <input readonly class="Input_Text" type="text" value="<?php echo $fila['NumDcto'] ?>">
      </div>
    </div>
    <div class="usuario__campo">
      <label>mt_grados:</label>
      <div>
        <input readonly class="Input_Text" type="text" value="<?php echo $fila['NomGrado'] ?>">
      </div>
    </div>
  <?php } ?>
  <div class="alinear-boton">
    <button name="VerHistorial" id="btnAbrir" name="btnAbrir2" type="submit" class="boton">MAS INFORMACIÓN</button>
  </div>
</div>

<div class="margen__miniventana">
  <!-- DATOS ESPECIFICOS DEL ESTUDIANTE -->
  <div class="miniVentana" id="miniVentana">
    <div id="formularioContainer">
      <form id="formulario1">
        <?php while ($extraido = mysqli_fetch_array($DatosUsuario2)) { ?>
          <div class="nav__miniventana">
            <a></a>
            <h3 id="DataUser">DATOS DEL ESTUDIANTE</h3>
            <div><a id="btnCerrar">
                <div class="botonAtras">
                  <div class="margen__boton">
                    <svg class="navbar-icon" style="margin:0;">
                      <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Symbol_X"></use>
                    </svg>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="grid__miniventana">
            <div class="formulario__miniventana">
              <label>Nombre</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['Nombre'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Apellido</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['Apellido'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Tipo de Documento</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['TipoDcto'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Número Identificación</label>
              <input readonly class="input_miniventana" type="number" value="<?php echo $extraido['NumDcto'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Teléfono</label>
              <input readonly class="input_miniventana" type="number" value="<?php echo $extraido['Telefono'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Fecha Nacimiento</label>
              <input readonly class="input_miniventana" type="date" value="<?php echo $extraido['FechNacimiento'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Dirección</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['Direccion'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Email</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['Email'] ?>">
            </div>
          </div>
          <div class="margen">
            <div> <a id="btnSiguiente1">
                <div class="botonAtras">
                  <div class="margen__boton">
                    <svg class="navbar-icon" style="margin:0;">
                      <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Arrow_Next"></use>
                    </svg>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </form>
      <?php } ?>

      <!-- DATOS MEDICOS DEL ESTUDIANTE -->
      <form id="formulario2" style="display: none;">
        <div class="nav__miniventana">
          <a></a>
          <h3 id="DataUser">DATOS MÉDICOS DEL ESTUDIANTE</h3>
          <div><a id="btnCerrar1">
              <div class="botonAtras">
                <div class="margen__boton">
                  <svg class="navbar-icon" style="margin:0;">
                    <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Symbol_X"></use>
                  </svg>
                </div>
              </div>
            </a>
          </div>
          <?php while ($extraido = mysqli_fetch_array($DatosMedicos)) { ?>
          </div>
          <div class="grid__miniventana">
            <div class="formulario__miniventana">
              <label>EPS</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['NomEPSMed'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Restricciones médicas</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['RestSanitaMed'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Discapacidades</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['DiscapMed'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>Enfermedades actuales</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['EnferMed'] ?>">
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
                      <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Arrow_Back"></use>
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
                      <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Arrow_Next"></use>
                    </svg>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </form>
      <?php } ?>

      <!-- DATOS DEL ACUDIENTE -->
      <form id="formulario3" style="display: none;">
        <div class="nav__miniventana">
          <a></a>
          <h3 id="DataUser">DATOS DEL ACUDIENTE</h3>
          <div><a id="btnCerrar2">
              <div class="botonAtras">
                <div class="margen__boton">
                  <svg class="navbar-icon" style="margin:0;">
                    <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Symbol_X"></use>
                  </svg>
                </div>
              </div>
            </a>
          </div>
          <?php while ($extraido = mysqli_fetch_array($DatosAcudiente)) { ?>
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
                      <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Arrow_Back"></use>
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
                      <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Arrow_Next"></use>
                    </svg>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </form>
      <?php } ?>

      <!-- DATOS HISTORIAL_ESCOLAR -->
      <form id="formulario4" style="display: none;">
        <div class="nav__miniventana">
          <a></a>
          <h3 id="DataUser">DATOS HISTORIAL ESCOLAR</h3>
          <div><a id="btnCerrar3">
              <div class="botonAtras">
                <div class="margen__boton">
                  <svg class="navbar-icon" style="margin:0;">
                    <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Symbol_X"></use>
                  </svg>
                </div>
              </div>
            </a>
          </div>
          <?php while ($extraido = mysqli_fetch_array($DatosHistorialEscolar)) { ?>
          </div>
          <div class="grid__miniventana">
            <div class="formulario__miniventana">
              <label>Colegio del Anterior</label>
              <input readonly class="input_miniventana" type="text" value="<?php echo $extraido['AnteriorEsc'] ?>">
            </div>
            <div class="formulario__miniventana">
              <label>mt_grados</label>
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
                      <use href="<?php echo BASE_URL; ?>/assets/images/svg/Sprite.svg#icon-Arrow_Back"></use>
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