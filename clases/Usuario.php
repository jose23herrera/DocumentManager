<?php
class Usuario {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=documentos', 'root', '');
    }

    public function registrar($username, $password) {
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) return false;

        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
        return $stmt->execute([$username, $hash]);
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user && password_verify($password, $user['password']);
    }

    public function obtenerId($username) {
        $stmt = $this->db->prepare("SELECT id FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user['id'] : null;
    }
}
?>