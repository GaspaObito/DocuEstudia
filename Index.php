<?php
define("PAGE_CSS", "Index");
require_once("templates/HomeHeader.php");
?>
<section class="hero">
  <div class="overlay"></div>
  <div class="hero-content">
    <h1>DocuEstudia: Gestión Académica Escolar</h1>
    <div class="badge">
      Centraliza la información académica y administrativa en una sola plataforma
    </div>
    <p>
      Optimiza la gestión escolar mediante un sistema web modular que permite administrar estudiantes,
      observaciones, notas, materias y usuarios de forma eficiente, segura y accesible desde cualquier lugar.
    </p>
    <a class="boton" href="<?php echo BASE_URL; ?>/documentation/Diapositiva DocuEstudia V3.pdf" target="_blank" style="width: 50%;">MAS INFORMACION</a>
  </div>
  </div>
</section>
<!-- SECCION BENEFITS -->
<section class="features">
  <h2>¿Por qué usar DocuEstudia?</h2>
  <div class="cards">
    <div class="card">
      <h3>Ahorro de tiempo</h3>
      <p>Automatiza procesos académicos y reduce tareas manuales.</p>
    </div>
    <div class="card">
      <h3>Acceso desde cualquier lugar</h3>
      <p>Consulta información en tiempo real desde cualquier dispositivo.</p>
    </div>
    <div class="card">
      <h3>Reducción de errores</h3>
      <p>Centraliza datos y evita inconsistencias en la información.</p>
    </div>
  </div>
</section>
<!-- SECCION IT HAVE -->
<section class="features">
  <div class="features-container">
    <!-- Imagen Izquierda -->
    <div class="features-image">
      <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b" alt="Clases online">
    </div>
    <!-- Contenido Derecha -->
    <div class="features-content">
      <h2>
        Centraliza la información académica y administrativa en una sola plataforma
      </h2>
      <p class="description">
        Accede, registra y analiza datos en tiempo real para mejorar la toma de decisiones institucionales.
      </p>
      <div class="cards">
        <div class="card">
          <h3>Gestión de Estudiantes</h3>
          <p>Registra estudiantes y docentes</p>
        </div>
        <div class="card">
          <h3>Observador Escolar</h3>
          <p>Configura materias y cursos</p>
        </div>
        <div class="card">
          <h3>Gestión de Notas</h3>
          <p>Gestiona notas y observaciones</p>
        </div>
        <div class="card">
          <h3>Administración de Usuarios</h3>
          <p>Genera reportes y toma decisiones</p>
        </div>
      </div>
    </div>

  </div>
</section>
<!-- SECCION BENEFITS -->
<section class="features">
  <h2>Diseñado para todos</h2>
  <div class="cards">
    <div class="card">
      <h3>Docentes</h3>
      <p>Registran notas y observaciones fácilmente.</p>
    </div>
    <div class="card">
      <h3>Administrativos</h3>
      <p>Control total de estudiantes y reportes.</p>
    </div>
    <div class="card">
      <h3>Padres</h3>
      <p>Consulta el rendimiento académico.</p>
    </div>
  </div>
</section>
<!-- SECCION FEACTURES -->
<section class="features">
  <div class="features-container">
    <!-- Contenido izquierda -->
    <div class="features-content">
      <h2>
        Control total de la información académica
      </h2>
      <p class="description">Accede, registra y analiza datos en tiempo real para mejorar la toma de decisiones
        institucionales.</p>
      <div class="cards">
        <div class="card">
          <h3>Gestión de Estudiantes</h3>
          <p>Administra estudiantes, grados y grupos de forma organizada y centralizada.</p>
        </div>
        <div class="card">
          <h3>Observador Escolar</h3>
          <p>Registra anotaciones académicas y disciplinarias con trazabilidad completa.</p>
        </div>
        <div class="card">
          <h3>Gestión de Notas</h3>
          <p>Consulta y registra calificaciones por materia, facilitando el seguimiento académico.</p>
        </div>
        <div class="card">
          <h3>Materias y Cursos</h3>
          <p>Define materias, asigna docentes y organiza la estructura académica.</p>
        </div>
        <div class="card">
          <h3>Administración de Usuarios</h3>
          <p>Gestiona roles, permisos y accesos según el perfil del usuario.</p>
        </div>
        <div class="card">
          <h3>Reportes y Análisis</h3>
          <p>Genera reportes académicos para mejorar la toma de decisiones institucionales.</p>
        </div>
        <div class="card">
          <h3>Seguridad y Control</h3>
          <p>Protege la información mediante control de accesos y gestión de datos segura.</p>
        </div>
      </div>
      <a class="boton" href="<?php echo BASE_URL; ?>/documentation/Diapositiva DocuEstudia V3.pdf" target="_blank" style="width: 50%;margin-top:4rem">CONOCE MAS BENEFICIOS</a>
    </div>
    <!-- Imagen derecha -->
    <div class="features-image">
      <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b" alt="Clases online">
    </div>
  </div>
</section>

<section class="features" style="justify-content: space-evenly;text-align: center;display: grid;gap: 20px;">
  <h2>Empieza ahora con DocuEstudia</h2>
  <div class="badge">
    <p>Digitaliza tu institución educativa </p>
  </div>
  <div class="badge">
    <p>Mejora la gestión académica hoy mismo</p>
  </div>
</section>

<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>