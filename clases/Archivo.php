<?php
require_once 'Usuario.php';

class Archivo {
    private $usuario;
    private $db;

    public function __construct($usuario) {
        $this->usuario = $usuario;
        $this->db = new PDO('mysql:host=localhost;dbname=documentos', 'root', '');
    }

    // Listar archivos del usuario
    public function listarArchivos() {
        $dir = "uploads/{$this->usuario}";
        return file_exists($dir) ? array_diff(scandir($dir), ['.', '..']) : [];
    }

    // Subir archivo con validación
    public function subirArchivo($file) {
        $dir = "uploads/{$this->usuario}";

        // Crear directorio si no existe
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        // Validación de extensiones permitidas
        $permitidos = ['pdf', 'txt', 'docx'];
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($ext), $permitidos)) {
            // Redirigir a la página de error con el mensaje correspondiente
            header('Location: error_subida.php?mensaje=' . urlencode("Tipo de archivo no permitido. Solo se permiten archivos PDF, TXT y DOCX."));
            exit;
        }

        // Prevención de sobrescritura de archivos
        $destino = $dir . '/' . basename($file['name']);
        $contador = 1;
        while (file_exists($destino)) {
            $destino = $dir . '/' . pathinfo($file['name'], PATHINFO_FILENAME) . "_$contador." . $ext;
            $contador++;
        }

        // Mover el archivo al directorio
        if (move_uploaded_file($file['tmp_name'], $destino)) {
            // Registrar en la base de datos
            $usuarioModel = new Usuario();
            $usuario_id = $usuarioModel->obtenerId($this->usuario);

            if ($usuario_id) {
                $stmt = $this->db->prepare("INSERT INTO archivos (usuario_id, nombre_archivo) VALUES (?, ?)");
                $stmt->execute([$usuario_id, basename($destino)]);
            } else {
                return "Error: Usuario no encontrado.";
            }

            return "Archivo subido correctamente.";
        } else {
            return "Error al subir el archivo.";
        }
    }

    // Eliminar archivo del sistema y base de datos
    public function eliminarArchivo($nombre) {
        $archivo = "uploads/{$this->usuario}/$nombre";
        if (file_exists($archivo)) {
            unlink($archivo);
        } else {
            return "El archivo no existe.";
        }

        // Eliminar de la base de datos
        $usuarioModel = new Usuario();
        $usuario_id = $usuarioModel->obtenerId($this->usuario);

        if ($usuario_id) {
            $stmt = $this->db->prepare("DELETE FROM archivos WHERE usuario_id = ? AND nombre_archivo = ?");
            $stmt->execute([$usuario_id, $nombre]);
            return "Archivo eliminado correctamente.";
        } else {
            return "Error: Usuario no encontrado.";
        }
    }
}
?>
