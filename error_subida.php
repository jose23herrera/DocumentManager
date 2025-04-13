<?php
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : 'Ocurrió un error inesperado.';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error de Subida</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f44336, #e57373);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .error-box {
            background-color: #fff;
            color: #c62828;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            text-align: center;
        }

        .error-box h2 {
            margin-bottom: 10px;
            font-size: 24px;
        }

        .error-box p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .error-box a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #c62828;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .error-box a:hover {
            background-color: #b71c1c;
        }
    </style>
</head>
<body>

    <div class="error-box">
        <h2>⚠️ Error al subir el archivo</h2>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
        <a href="panel.php">Volver al Panel</a>
    </div>

</body>
</html>
