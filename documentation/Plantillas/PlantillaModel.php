<?php

require_once ROOT_PATH . '/models/DatabaseConnection.php';

/* -------- CREATE -------- */
function createAnnotation($conexion, int $idObs, string $profesor, string $tipoFalta, string $descripcion): bool
{
    $sql = "INSERT INTO anotacion 
            (IdObs, NomProfCread, TipoFalta, DescFalta, FecCreacion)
            VALUES (?, ?, ?, ?, NOW())";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("isss", $idObs, $profesor, $tipoFalta, $descripcion);

    return $stmt->execute();
}

/* -------- UPDATE -------- */
function updateAnnotation(
    $conexion,
    int $idAnot,
    string $profesor,
    string $tipoFalta,
    string $descripcion
): bool {
    $sql = "UPDATE anotacion 
            SET NomProfModif = ?, TipoFalta = ?, DescFalta = ?
            WHERE IdAnot = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssi", $profesor, $tipoFalta, $descripcion, $idAnot);

    return $stmt->execute();
}

/* -------- DELETE -------- */
function deleteAnnotation($conexion, int $idAnot): bool
{
    $stmt = $conexion->prepare("DELETE FROM anotacion WHERE IdAnot = ?");
    $stmt->bind_param("i", $idAnot);

    return $stmt->execute();
}

/* -------- READ ONE -------- */
function getAnnotationById($conexion, int $idAnot): ?array
{
    $stmt = $conexion->prepare("SELECT * FROM anotacion WHERE IdAnot = ?");
    $stmt->bind_param("i", $idAnot);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc() ?: null;
}

/* -------- READ ALL BY OBSERVADO -------- */
function getAnnotationsByObs($conexion, int $idObs): array
{
    $stmt = $conexion->prepare("SELECT * FROM anotacion WHERE IdObs = ?");
    $stmt->bind_param("i", $idObs);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

/* -------- READ -------- */
function countAnnotationsByObs($conexion, int $idObs): int
{
    $stmt = $conexion->prepare("SELECT COUNT(*) AS total FROM anotacion WHERE IdObs = ?");
    $stmt->bind_param("i", $idObs);
    $stmt->execute();

    return (int) $stmt->get_result()->fetch_assoc()['total'];
}
