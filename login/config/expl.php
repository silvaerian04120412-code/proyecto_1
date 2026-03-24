<?php
/* ============================================================
   CONFIGURACIÓN DE LA BASE DE DATOS
   ============================================================ */
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "registro_usuarios";

$conexion = new mysqli($host, $user, $pass, $dbname);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

/* ============================================================
   VARIABLES Y VALIDACIONES
   ============================================================ */
$errores = [];
$nombre = $apellido = $direccion = $correo = $telefono = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    if (empty($nombre) || !preg_match('/^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$/', $nombre)) {
        $errores[] = "El nombre solo puede contener letras.";
    }

    $apellido = trim($_POST["apellido"] ?? "");
    if (empty($apellido) || !preg_match('/^[A-Za-zÁÉÍÓÚÑáéíóúñ\s]+$/', $apellido)) {
        $errores[] = "El apellido solo puede contener letras.";
    }

    $direccion = trim($_POST["direccion"] ?? "");
    if (empty($direccion)) {
        $errores[] = "La dirección no puede estar vacía.";
    }

    $correo = trim($_POST["correo"] ?? "");
    if (empty($correo) ||
        !preg_match('/^[A-Za-z0-9._%+-]+@(gmail\.com|hotmail\.com|outlook\.com|yahoo\.com)$/i', $correo)) {
        $errores[] = "El correo debe pertenecer a gmail.com, hotmail.com, outlook.com o yahoo.com.";
    }

    $telefono = trim($_POST["telefono"] ?? "");
    if (empty($telefono) || !preg_match('/^[0-9]{7,15}$/', $telefono)) {
        $errores[] = "El teléfono debe tener entre 7 y 15 números.";
    }

    if (empty($errores)) {

        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, direccion, correo, telefono) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $apellido, $direccion, $correo, $telefono);

        if ($stmt->execute()) {
            echo "<p class='exito'>Registro guardado correctamente.</p>";
            $nombre = $apellido = $direccion = $correo = $telefono = "";
        } else {
            echo "<p class='error'>Error al guardar: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}

/* ============================================================
   CONSULTA PARA LISTAR USUARIOS
   ============================================================ */
$consultaUsuarios = $conexion->query("SELECT * FROM usuarios ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>

    <style>
        body {
            background: #f3e8ff;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        /* Contenedor principal: formulario + lista */
        .contenedor {
            display: flex;
            gap: 20px;
            justify-content: center;
            align-items: flex-start;
        }

        form {
            background: #ffffff;
            border: 2px solid #3b2e7e;
            border-radius: 8px;
            padding: 20px;
            width: 350px;
            box-shadow: 0 0 10px rgba(59, 46, 126, 0.3);
        }

        h2 {
            text-align: center;
            color: #3b2e7e;
        }

        label {
            font-weight: bold;
            color: #3b2e7e;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #b39ddb;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #3b2e7e;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #6a4fbf;
        }

        /* Tabla de usuarios */
        table {
            border-collapse: collapse;
            width: 400px;
            background: white;
            border: 2px solid #3b2e7e;
            box-shadow: 0 0 10px rgba(59, 46, 126, 0.3);
        }

        th {
            background: #3b2e7e;
            color: white;
            padding: 10px;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f3e8ff;
        }

        .exito, .error {
            width: 350px;
            margin: 10px auto;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .exito {
            background: #d4ffd4;
            border: 1px solid #5cb85c;
        }

        .error {
            background: #ffe6e6;
            border: 1px solid #ff9999;
        }
    </style>
</head>
<body>

<h2>Formulario de Registro</h2>

<div class="contenedor">

    <!-- FORMULARIO -->
    <form method="post" action="">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>"><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>"><br><br>

        <label>Dirección:</label><br>
        <textarea name="direccion" rows="3"><?php echo htmlspecialchars($direccion); ?></textarea><br><br>

        <label>Correo electrónico:</label><br>
        <input type="email" name="correo" value="<?php echo htmlspecialchars($correo); ?>"><br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>"><br><br>

        <button type="submit">Registrar</button>
    </form>

    <!-- LISTA DE USUARIOS -->
    <table>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>telefono</th>
        </tr>

        <?php while ($fila = $consultaUsuarios->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($fila['nombre'] . " " . $fila['apellido']); ?></td>
            <td><?php echo htmlspecialchars($fila['correo']); ?></td>
            <td><?php echo htmlspecialchars($fila['direccion']); ?></td>
            <td><?php echo htmlspecialchars($fila['telefono']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>