<?php
header('Content-Type: application/json');
require_once 'clases/Archivo.php';

$usuarios = array_filter(glob('uploads/*'), 'is_dir');
$data = [];

foreach ($usuarios as $rutaUsuario) {
    $usuario = basename($rutaUsuario);
    $archivo = new Archivo($usuario);
    $data[$usuario] = $archivo->listarArchivos();
}

echo json_encode($data, JSON_PRETTY_PRINT);