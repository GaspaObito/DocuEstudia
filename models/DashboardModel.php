<?php
/* ==========================================
   MODEL: DashboardModel.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(ROOT_PATH . "/models/DatabaseConnection.php");

/* -------- 1. Promedio por Materia | type: bar -------- */
function Promedio_por_Materia($conexion)
{
  $consultaSQL = "SELECT m.NomMateria, AVG(n.Nota) as Promedio
      FROM mt_notas n JOIN mt_materias m ON m.IdMateria = n.IdMateria GROUP BY n.IdMateria";

  $consultar = mysqli_query($conexion, $consultaSQL) 
      or die("ERROR AL TRAER LOS DATOS");

  return $consultar;
}

/* -------- 2. Evolución por Periodo (por materia) | type: radar chart -------- */
function Promedio_por_Estudiante($conexion)
{
  $consultaSQL = "SELECT u.Nombre, u.Apellido, AVG(n.Nota) as Promedio
      FROM mt_notas n JOIN observador o ON o.IdObs = n.IdObs JOIN usuarios u ON u.IdUser = o.IdUser GROUP BY n.IdObs";

  $consultar = mysqli_query($conexion, $consultaSQL)
      or die("ERROR AL TRAER LOS DATOS");

  return $consultar;
}

/* -------- 3. Evolución por Periodo (por materia) | type: line chart -------- */
function Evolucion_por_Periodo($conexion, $IdMateria)
{
  $consultaSQL = "SELECT Periodo, AVG(Nota) as Promedio
      FROM mt_notas WHERE IdMateria = $IdMateria GROUP BY Periodo ORDER BY Periodo";

  $consultar = mysqli_query($conexion, $consultaSQL)
      or die("ERROR AL TRAER LOS DATOS");

  return $consultar;
}

/* -------- 4. Estudiantes en Riesgo | type: donut chart -------- */
function Estudiantes_en_Riesgo($conexion)
{
  $consultaSQL = "SELECT u.Nombre, u.Apellido, n.Nota
      FROM mt_notas n JOIN observador o ON o.IdObs = n.IdObs JOIN usuarios u ON u.IdUser = o.IdUser WHERE n.Nota < 3";

  $consultar = mysqli_query($conexion, $consultaSQL)
      or die("ERROR AL TRAER LOS DATOS");

  return $consultar;
}

/* -------- 5. Total estudiantes por materia (por profesor) | type: bar -------- */
function Total_Estudiantes_por_Materia($conexion, $IdUser)
{
  $consultaSQL = "SELECT m.NomMateria,COUNT(o.IdObs) as TotalEstudiantes
      FROM profesor_materia_grado p JOIN mt_materias m ON m.IdMateria = p.IdMateria JOIN observador o ON o.IdGrado = p.IdGrado  AND o.IdGrupo = p.IdGrupo
      WHERE p.IdUser = $IdUser
      GROUP BY p.IdMateria";

  $consultar = mysqli_query($conexion, $consultaSQL)
      or die("ERROR AL TRAER LOS DATOS");

  return $consultar;
}

/* -------- 6. Promedio por Grupo | type: column chart -------- */
function Promedio_por_Grupo($conexion)
{
  $consultaSQL = "SELECT g.NomGrupo, AVG(n.Nota) as Promedio
      FROM mt_notas n JOIN observador o ON o.IdObs = n.IdObs JOIN mt_grupos g ON g.IdGrupo = o.IdGrupo GROUP BY o.IdGrupo";

  $consultar = mysqli_query($conexion, $consultaSQL)
      or die("ERROR AL TRAER LOS DATOS");

  return $consultar;
}

/* -------- 7. Promedio por Grado | type: bar -------- */
function Promedio_por_Grado($conexion)
{
  $consultaSQL = "SELECT g.NomGrado, AVG(n.Nota) as Promedio
      FROM mt_notas n JOIN observador o ON o.IdObs = n.IdObs JOIN mt_grados g ON g.IdGrado = o.IdGrado GROUP BY o.IdGrado";

  $consultar = mysqli_query($conexion, $consultaSQL)
      or die("ERROR AL TRAER LOS DATOS");

  return $consultar;
}

/* -------- 8. Total Anotaciones por Estudiante | type: ranking -------- */
function Total_Anotaciones_por_Estudiante($conexion)
{
  $consultaSQL = "SELECT u.Nombre, u.Apellido, COUNT(a.IdAnot) as TotalAnotaciones
      FROM anotacion a JOIN observador o ON o.IdObs = a.IdObs JOIN usuarios u ON u.IdUser = o.IdUser GROUP BY a.IdObs";

  $consultar = mysqli_query($conexion, $consultaSQL)
      or die("ERROR AL TRAER LOS DATOS");

  return $consultar;
}
