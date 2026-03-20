<?php
define("PAGE_CSS", "Index");
require_once("templates/HomeHeader.php");
?>
<section class="hero">
    <div class="overlay"></div>

    <div class="hero-content">
        <h1>OBSERVADOR ONLINE</h1>

        <div class="badge">
            📊 Mejora la observación escolar de forma remota y efectiva
        </div>

        <p>
            Observa el desempeño docente de manera remota y eficaz.
            Reduce costos, flexibiliza horarios y graba sesiones para un análisis detallado.
        </p>

        <div class="buttons">
            <button class="boton">COMENZAR AHORA</button>
        </div>
    </div>
</section>

<section class="features">
    <div class="features-container">
        <!-- Imagen izquierda -->
        <div class="features-image">
            <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b" alt="Clases online">
        </div>
        <!-- Contenido derecha -->
        <div class="features-content">
            <h2>
                📋 FÁCIL ACCESO A DATOS Y ANÁLISIS
            </h2>
            <p class="description">
                Accede a observaciones grabadas, analiza el rendimiento docente en cualquier momento
                y mejora la calidad educativa sin interrupciones.
            </p>
            <div class="cards">
                <div class="card">
                    <h3>⏱️ Flexibilidad Horaria</h3>
                    <p>
                        Observa clases en diferido y en cualquier momento sin tener que desplazarte.
                    </p>
                </div>
                <div class="card">
                    <h3>💰 Reducción de Costes</h3>
                    <p>
                        Ahorra en desplazamientos y recursos, haciéndolo todo de manera virtual.
                    </p>
                </div>
                <div class="card">
                    <h3>🎥 Grabación de Clases</h3>
                    <p>
                        Graba y revisa sesiones para un análisis detallado y efectivo.
                    </p>
                </div>
            </div>
            <div class="buttons" style="margin-top:3rem">
                <button class="boton">CONOCE MAS BENEFICIOS</button>
            </div>
        </div>
    </div>
</section>
<?php include(ROOT_PATH . "/templates/HomeFooter.php"); ?>