<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formatos de Salud - Principal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>FORMATOS DE SALUD</h1>
        <nav>
            <a href="index.php">Inicio</a>
            <!-- Access to other future modules -->
        </nav>
    </header>

    <div class="container">
        <h2>Formatos Disponibles</h2>
        <div class="card-grid">
            <!-- Card for Daily Attendance -->
            <div class="card">
                <h3>Parte Diario de Asistencia</h3>
                <p>Genera el formato PDF para el control diario de asistencia del personal.</p>
                <a href="forms/attendance.php" class="btn">Ir al Formulario</a>
            </div>

            <!-- Future cards can be added here -->
            <div class="card" style="opacity: 0.5;">
                <h3>Próximamente</h3>
                <p>Nuevos formatos serán agregados aquí.</p>
                <button class="btn" disabled style="background-color: #555; cursor: not-allowed;">No disponible</button>
            </div>
        </div>
    </div>
</body>
</html>
