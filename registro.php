<?php
session_start();
require_once 'clases/Usuario.php';

// Lógica para registrar usuario
$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario();
    $username = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    if ($usuario->registrar($username, $password)) {
        $mensaje = "<div class='mensaje exito'>¡Registro exitoso! <a href='login.php'>Inicia sesión aquí</a>.</div>";
    } else {
        $mensaje = "<div class='mensaje error'>El usuario ya existe. Intenta con otro nombre.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        .formulario {
            display: flex;
            flex-direction: column;
        }

        .formulario input[type="text"],
        .formulario input[type="password"] {
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }

        .formulario button {
            padding: 12px;
            margin-top: 15px;
            background-color: #1e3c72;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .formulario button:hover {
            background-color: #16325c;
        }

        .mensaje {
            text-align: center;
            margin-top: 20px;
            padding: 12px;
            border-radius: 6px;
            font-weight: bold;
        }

        .mensaje.exito {
            background-color: #d4edda;
            color: #155724;
        }

        .mensaje.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        a {
            color: #2a5298;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <form method="POST" class="formulario">
            <input type="text" name="usuario" placeholder="Nombre de usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <?= $mensaje ?>
    </div>
</body>
</html>
