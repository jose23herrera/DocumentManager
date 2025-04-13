<?php
require_once 'Archivo.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $usuario = 'usuario_5';  // Suponiendo que el usuario se obtiene de la sesión o algo similar
    $archivo = new Archivo($usuario);

    try {
        // Llamamos a la función subirArchivo y mostramos el mensaje de resultado
        $resultado = $archivo->subirArchivo($_FILES['file']);
        
        // Redirigir con mensaje de éxito o error
        header('Location: subir_archivo.html?mensaje=' . urlencode($resultado));
        exit;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
