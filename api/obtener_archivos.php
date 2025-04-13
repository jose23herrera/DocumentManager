<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if (!isset($_GET['usuario'])) {
    echo json_encode(["error" => "Falta el parámetro 'usuario'."]);
    exit;
}

$usuario = $_GET['usuario'];

try {
    $pdo = new PDO("mysql:host=localhost;dbname=documentos", "root", "");
    // Realizamos la consulta SQL para obtener los archivos asociados a un usuario
    $stmt = $pdo->prepare("SELECT a.nombre_archivo FROM archivos a 
                           INNER JOIN usuarios u ON a.usuario_id = u.id
                           WHERE u.username = ?");
    $stmt->execute([$usuario]);
    $archivos = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo json_encode(["archivos" => $archivos]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Error de base de datos: " . $e->getMessage()]);
}
?>
