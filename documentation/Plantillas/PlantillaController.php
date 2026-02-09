<?php
/* ==========================================
   CONTROLLER: NombreModuloController.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(__DIR__ . "/../config/config.php");
require_once(ROOT_PATH . "/models/NombreModuloModel.php");
require_once(ROOT_PATH . "/models/CommonModel.php");

/* ---------- 2. ESTADO INICIAL ---------- */
$Id = 0;
$isUpdate = false;

/* Variables del formulario */
$campo1 = '';
$campo2 = '';
$campo3 = '';

/* Variables de vista */
$consultar = [];
$totalFilas = 0;

/* ---------- 3. HELPERS ---------- */
function goToList()
{
  redirectTo("/views/modulo/ManageModulo.php?action=listar");
}

/* ---------- 4. ROUTING ---------- */
$method = $_SERVER['REQUEST_METHOD'];
$action = $_POST['action'] ?? $_GET['action'] ?? '';

/* ---------- 5. POST ACTIONS ---------- */
if ($method === 'POST') {

  switch ($action) {

    /* -------- CREATE -------- */
    case 'create':
      $campo1 = $_POST['campo1'] ?? '';
      $campo2 = $_POST['campo2'] ?? '';

      if (createModulo($conexion, $campo1, $campo2)) {
        $_SESSION['alerts'][] = [
          'type' => 'success',
          'text' => 'Registro creado correctamente'
        ];
      } else {
        $_SESSION['alerts'][] = [
          'type' => 'danger',
          'text' => 'Error al crear el registro'
        ];
      }

      goToList();
      break;

    /* -------- UPDATE -------- */
    case 'update':
      $Id = intval($_POST['id'] ?? 0);
      $campo1 = $_POST['campo1'] ?? '';
      $campo2 = $_POST['campo2'] ?? '';

      if (updateModulo($conexion, $Id, $campo1, $campo2)) {
        $_SESSION['alerts'][] = [
          'type' => 'success',
          'text' => 'Registro actualizado correctamente'
        ];
      } else {
        $_SESSION['alerts'][] = [
          'type' => 'danger',
          'text' => 'Error al actualizar el registro'
        ];
      }

      goToList();
      break;

    /* -------- DELETE -------- */
    case 'delete':
      $Id = intval($_POST['id'] ?? 0);

      if (deleteModulo($conexion, $Id)) {
        $_SESSION['alerts'][] = [
          'type' => 'info',
          'text' => 'Registro eliminado correctamente'
        ];
      } else {
        $_SESSION['alerts'][] = [
          'type' => 'danger',
          'text' => 'Error al eliminar el registro'
        ];
      }

      goToList();
      break;

    /* -------- READ -------- */
    case 'read':
      $Id = intval($_POST['id'] ?? 0);
      $data = readModulo($conexion, $Id);

      if ($data) {
        $campo1 = $data['campo1'];
        $campo2 = $data['campo2'];
        $isUpdate = true;
      }
      break;
  }
}

/* ---------- 6. GET ACTIONS ---------- */
elseif ($method === 'GET') {

  switch ($action) {

    case 'listar':
      $resultados = searchModulo($conexion);
      $consultar = $resultados['consultar'];
      $totalFilas = $resultados['totalFilas'];
      break;
  }
}
