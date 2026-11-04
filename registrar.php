
<?php
require_once __DIR__ . '/conexion.php';

$mensaje = '';
$tipo_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombres = trim($_POST['nombres'] ?? '');
    $apellidos = trim($_POST['apellidos'] ?? '');
    $coreo = trim($_POST['coreo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');

    if ($nombres === '' || $apellidos === '' ||
        $coreo === '' || $telefono === '') {
        $mensaje = 'Todos los campos son obligatorios.';
        $tipo_mensaje = 'error';
    } elseif (!filter_var($coreo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = 'Introduce un correo electrónico válido.';
        $tipo_mensaje = 'error';
    } else {
        try {
            $sql = "INSERT INTO usuarios
                    (nombres, apellidos, coreo, telefono, estado)
                    VALUES (:nombres, :apellidos, :coreo, :telefono, :estado)";

            $consulta = $conexion->prepare($sql);
            $consulta->execute([
                ':nombres' => $nombres,
                ':apellidos' => $apellidos,
                ':coreo' => $coreo,
                ':telefono' => $telefono,
                ':estado' => 'Activo'
            ]);

            header('Location: index.php?registrado=1');
            exit;
        } catch (PDOException $e) {
            error_log('Error al registrar usuario: ' . $e->getMessage());
            $mensaje = 'No se pudo registrar el usuario. Comprueba los datos.';
            $tipo_mensaje = 'error';
        }
    }
}

function h($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar usuario</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 30px 15px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }
        main {
            max-width: 600px;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 12px #00000012;
        }
        h1 { color: #123b63; }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 11px;
            margin-top: 6px;
            border: 1px solid #cbd5e1;
            border-radius: 5px;
        }
        button, .volver {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 18px;
            border: 0;
            border-radius: 5px;
            background: #123b63;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }
        .mensaje {
            padding: 12px;
            border-radius: 5px;
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
<main>
    <h1>Registrar usuario</h1>
    <p>Completa los datos para registrar un nuevo usuario.</p>

    <?php if ($mensaje !== ''): ?>
        <p class="mensaje"><?= h($mensaje) ?></p>
    <?php endif; ?>

    <form method="post" action="registrar.php">
        <label for="nombres">Nombres</label>
        <input id="nombres" name="nombres" maxlength="100"
               required value="<?= h($_POST['nombres'] ?? '') ?>">

        <label for="apellidos">Apellidos</label>
        <input id="apellidos" name="apellidos" maxlength="100"
               required value="<?= h($_POST['apellidos'] ?? '') ?>">

        <label for="coreo">Correo electrónico</label>
        <input id="coreo" name="coreo" type="email" maxlength="150"
               required value="<?= h($_POST['coreo'] ?? '') ?>">

        <label for="telefono">Teléfono</label>
        <input id="telefono" name="telefono" type="tel" maxlength="20"
               required value="<?= h($_POST['telefono'] ?? '') ?>">

        <button type="submit">Guardar usuario</button>
        <a class="volver" href="index.php">Volver al listado</a>
    </form>
</main>
</body>
</html>
