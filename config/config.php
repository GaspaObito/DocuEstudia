<?php
session_start();
// Detectar si estamos en local o en producción
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    // 💻 Configuración LOCAL
    define("BASE_URL", "http://localhost/DocuEstudia");
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . "/DocuEstudia");

    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "docuestudia");
} else {
    // 🌍 Configuración PRODUCCIÓN (ej: InfinityFree)
    define("BASE_URL", "https://fiction-controversy-gene-kevin.trycloudflare.com/DocuEstudia");
    define("ROOT_PATH", $_SERVER['DOCUMENT_ROOT'] . "/DocuEstudia");

    define("DB_HOST", "sql123.epizy.com"); // Lo da el hosting
    define("DB_USER", "epiz_12345678");
    define("DB_PASS", "tu_password");
    define("DB_NAME", "epiz_12345678_docuestudia");
}

$_SESSION['alerts'] ??= [];
$_SESSION['rol'] ??= '';
function redirectTo($path)
{
  echo "<script>location.href='" . BASE_URL . "$path'</script>";
  exit;
}