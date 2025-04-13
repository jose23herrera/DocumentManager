<?php
session_start();
require_once 'clases/Archivo.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$archivos = new Archivo($_SESSION['usuario']);
$lista = $archivos->listarArchivos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Archivos</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            color: #2c3e50;
        }

        a.logout {
            float: right;
            text-decoration: none;
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
        }

        form {
            margin-top: 20px;
            margin-bottom: 30px;
        }

        input[type="file"] {
            padding: 8px;
            margin-right: 10px;
        }

        button {
            background-color: #3498db;
            border: none;
            padding: 10px 15px;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a.btn {
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 4px;
            color: white;
        }

        .ver {
            background-color: #2ecc71;
        }

        .eliminar {
            background-color: #e67e22;
        }

        .titulo {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="titulo">
            <h2>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></h2>
            <a class="logout" href="logout.php">Cerrar sesión</a>
        </div>

        <form action="subir.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="archivo" required>
            <button type="submit">Subir archivo</button>
        </form>

        <h3>Mis archivos</h3>
        <table>
            <tr>
                <th>Archivo</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($lista as $archivo): ?>
                <tr>
                    <td><?= htmlspecialchars($archivo) ?></td>
                    <td>
                        <a class="btn ver" href="uploads/<?= urlencode($_SESSION['usuario']) ?>/<?= urlencode($archivo) ?>" target="_blank">Ver</a>
                        <a class="btn eliminar" href="eliminar.php?archivo=<?= urlencode($archivo) ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
