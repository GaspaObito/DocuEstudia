<?php
/* ==========================================
   MODEL: CommonModel.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(ROOT_PATH . "/models/DatabaseConnection.php");

/* -------- GRADES -------- */
$mt_grados = "SELECT * FROM mt_grados";
$mt_grados = mysqli_query($conexion, $mt_grados) or die(mysqli_error($conexion));

/* -------- GROUPS -------- */
$mt_grupos = "SELECT * FROM mt_grupos";
$mt_grupos = mysqli_query($conexion, $mt_grupos) or die(mysqli_error($conexion));

/* -------- TEACHER -------- */
$mt_profesores = "SELECT *,CONCAT(us.Nombre, ' ', us.Apellido) AS NombreCompleto FROM profesor pr LEFT JOIN usuarios us ON us.IdUser = pr.IdUser";
$mt_profesores = mysqli_query($conexion, $mt_profesores) or die(mysqli_error($conexion));

/* -------- MATTERS -------- */
$mt_materias = "SELECT * FROM mt_materias";
$mt_materias = mysqli_query($conexion, $mt_materias) or die(mysqli_error($conexion));

/* -------- BLOOD TYPE -------- */
$totalSangre = "SELECT * FROM mt_tsangre";
$totalSangre = mysqli_query($conexion, $totalSangre) or die(mysqli_error($conexion));