<?php
session_start();
require_once 'clases/Archivo.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['archivo'])) {
    $archivo = new Archivo($_SESSION['usuario']);
    $archivo->eliminarArchivo($_GET['archivo']);
}

header('Location: panel.php');
exit;
