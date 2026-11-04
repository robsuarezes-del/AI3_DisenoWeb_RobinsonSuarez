
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/conexion.php';

$usuarios = [];
$error = '';

try {
    if (!isset($conexion) || !($conexion instanceof PDO)) {
        throw new RuntimeException(
            'El archivo conexion.php no ha creado una conexion PDO valida en la variable $conexion.'
        );
    }

    $sql = "SELECT id, nombres, apellidos, coreo, telefono, estado, fecha_creacion
        FROM usuarios
        ORDER BY id DESC";

    $consulta = $conexion->query($sql);
    $usuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);

} catch (Throwable $e) {
    $error = $e->getMessage();
}

function h($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Web - Gestión de Usuarios</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        header {
            background: #123b63;
            color: white;
            padding: 25px 20px;
            text-align: center;
        }

        header h1 {
            margin-top: 10px;
        }

        main {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 18px;
        }

        .panel {
            background: white;
            padding: 24px;
            border-radius: 10px;
            box-shadow: 0 3px 12px #00000012;
        }

        .resumen {
            margin-bottom: 20px;
            color: #475569;
        }

        .tabla-contenedor {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #e2e8f0;
        }

        .mensaje {
            padding: 14px;
            margin: 15px 0;
            border-radius: 6px;
            overflow-wrap: anywhere;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .vacio {
            text-align: center;
            padding: 25px;
            color: #64748b;
        }

        .contador {
            margin: 20px 0;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #64748b;
        }
    </style>
</head>

<body>

<header>
    <h1>Sistema Web de Gestión de Usuarios</h1>
    <p>Actividad Integradora 3 - Diseño Web</p>
</header>

<main>
    <section class="panel">
        <h2>Usuarios registrados</h2>

        <p class="resumen">
            Consulta de los registros almacenados en la base de datos
            db_sistema_web.
        </p>

        <?php if ($error !== ''): ?>

            <div class="mensaje error">
                <strong>No se pudieron cargar los usuarios.</strong>
                <p><?= h($error) ?></p>
            </div>

        <?php else: ?>

            <p class="contador">
                Total de usuarios registrados:
                <strong><?= count($usuarios) ?></strong>
            </p>

            <div class="tabla-contenedor">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Fecha de creación</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (count($usuarios) > 0): ?>

                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?= h($usuario['id']) ?></td>
                                    <td><?= h($usuario['nombres']) ?></td>
                                    <td><?= h($usuario['apellidos']) ?></td>
                                    <td><?= h($usuario['coreo']) ?></td>
                                    <td><?= h($usuario['telefono']) ?></td>
                                    <td><?= h($usuario['estado']) ?></td>
                                    <td><?= h($usuario['fecha_creacion']) ?></td>
                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="7" class="vacio">
                                    No hay usuarios registrados.
                                </td>
                            </tr>

                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>
    </section>
</main>

<footer>
    Sistema desarrollado con PHP, PDO y MySQL.
</footer>

</body>
</html>
