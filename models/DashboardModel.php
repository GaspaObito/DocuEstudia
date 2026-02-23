<?php
/* ==========================================
   MODEL: DashboardModel.php
========================================== */

/* ---------- 1. REQUIRES ---------- */
require_once(ROOT_PATH . "/models/DatabaseConnection.php");

/* -------- 1. Promedio por Materia | type: bar -------- */
function Promedio_por_Materia($conexion): array
{
    $sql = "SELECT m.NomMateria, AVG(n.Nota) as Promedio
            FROM mt_notas n JOIN mt_materias m ON m.IdMateria = n.IdMateria GROUP BY n.IdMateria";
    $result = mysqli_query($conexion, $sql);

    $categories = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['NomMateria'];
        $data[] = round($row['Promedio'], 2);
    }

    return [
        'categories' => $categories,
        'data' => $data
    ];
}

/* -------- 2. Promedio por Estudiante | type: radar chart -------- */
function Promedio_por_Estudiante($conexion): array
{
    $sql = "SELECT u.Nombre, u.Apellido, AVG(n.Nota) as Promedio
      FROM mt_notas n JOIN observador o ON o.IdObs = n.IdObs JOIN usuarios u ON u.IdUser = o.IdUser GROUP BY n.IdObs";

    $result = mysqli_query($conexion, $sql);

    $categories = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['Nombre'];
        $data[] = round($row['Promedio'], 2);
    }
    return [
        'categories' => $categories,
        'data' => $data
    ];
}

/* -------- 3. Evolución por Periodo (por materia) | type: line chart -------- */
function Evolucion_por_Periodo($conexion)
{
    $sql = "SELECT Periodo, AVG(Nota) as Promedio
      FROM mt_notas GROUP BY Periodo ORDER BY Periodo";

    $result = mysqli_query($conexion, $sql);

    $categories = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['Periodo'];
        $data[] = round($row['Promedio'], 2);
    }
    return [
        'categories' => $categories,
        'data' => $data
    ];
}

/* -------- 4. Estudiantes en Riesgo | type: donut chart -------- */
function Estudiantes_en_Riesgo($conexion)
{
    $sql = "SELECT u.Nombre, u.Apellido, n.Nota
      FROM mt_notas n JOIN observador o ON o.IdObs = n.IdObs JOIN usuarios u ON u.IdUser = o.IdUser WHERE n.Nota < 3";

    $result = mysqli_query($conexion, $sql);

    $categories = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['Nombre'];
        $data[] = round($row['Nota'], 2);
    }
    return [
        'categories' => $categories,
        'data' => $data
    ];
}

/* -------- 5. Total estudiantes por materia (por profesor) | type: bar -------- */
function Total_Estudiantes_por_Grado($conexion)
{
    $sql = "SELECT NumAlumnos,NomGrado FROM mt_grados";

    $result = mysqli_query($conexion, $sql);

    $categories = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['NomGrado'];
        $data[] = round($row['NumAlumnos'], 2);
    }
    return [
        'categories' => $categories,
        'data' => $data
    ];
}

/* -------- 6. Promedio por Grupo | type: column chart -------- */
function Promedio_por_Grupo($conexion)
{
    $sql = "SELECT g.IdGrupo, AVG(n.Nota) as Promedio
      FROM mt_notas n JOIN observador o ON o.IdObs = n.IdObs JOIN mt_grupos g ON g.IdGrupo = o.IdGrupo GROUP BY o.IdGrupo";

    $result = mysqli_query($conexion, $sql);

    $categories = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['IdGrupo'];
        $data[] = round($row['Promedio'], 2);
    }
    return [
        'categories' => $categories,
        'data' => $data
    ];
}

/* -------- 7. Promedio por Grado | type: bar -------- */
function Promedio_por_Grado($conexion)
{
    $sql = "SELECT g.NomGrado, AVG(n.Nota) as Promedio
      FROM mt_notas n JOIN observador o ON o.IdObs = n.IdObs JOIN mt_grados g ON g.IdGrado = o.IdGrado GROUP BY o.IdGrado";

    $result = mysqli_query($conexion, $sql);

    $categories = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['NomGrado'];
        $data[] = round($row['Promedio'], 2);
    }
    return [
        'categories' => $categories,
        'data' => $data
    ];
}

/* -------- 8. Total Anotaciones por Estudiante | type: ranking -------- */
function Total_Anotaciones_por_Estudiante($conexion)
{
    $sql = "SELECT u.Nombre, u.Apellido, COUNT(a.IdAnot) as TotalAnotaciones
      FROM anotacion a JOIN observador o ON o.IdObs = a.IdObs JOIN usuarios u ON u.IdUser = o.IdUser GROUP BY a.IdObs";

    $result = mysqli_query($conexion, $sql);

    $categories = [];
    $data = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['Nombre'];
        $data[] = round($row['TotalAnotaciones'], 2);
    }
    return [
        'categories' => $categories,
        'data' => $data
    ];
}
