<?php
session_start();
require_once 'clases/Archivo.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$archivo = new Archivo($_SESSION['usuario']);
if ($_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    $archivo->subirArchivo($_FILES['archivo']);
}
header('Location: panel.php');
exit;