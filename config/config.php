<?php
// Detectar si estamos en local o en producción
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    // 💻 Configuración LOCAL
    define("BASE_URL", "http://localhost/proyectos/DocuEstudia");
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . "/proyectos/DocuEstudia");

    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "docuestudia");
} else {
    // 🌍 Configuración PRODUCCIÓN (ej: InfinityFree)
    define("BASE_URL", "http://tusitio.infinityfreeapp.com");
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT']);

    define("DB_HOST", "sql123.epizy.com"); // Lo da el hosting
    define("DB_USER", "epiz_12345678");
    define("DB_PASS", "tu_password");
    define("DB_NAME", "epiz_12345678_docuestudia");
}

$alerts = [];