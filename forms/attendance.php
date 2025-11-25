<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Parte de Asistencia</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>FORMATOS DE SALUD</h1>
        <nav>
            <a href="../index.php">Inicio</a>
        </nav>
    </header>

    <div class="container">
        <a href="../index.php" class="back-link">← Volver al Inicio</a>

        <div class="form-container">
            <h2>Parte Diario de Asistencia</h2>
            <form action="../generate_attendance.php" method="POST" target="_blank">
                <div class="form-group">
                    <label for="year">Año:</label>
                    <input type="number" id="year" name="year" value="<?php echo date('Y'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="month">Mes:</label>
                    <select id="month" name="month" required>
                        <option value="ENERO">Enero</option>
                        <option value="FEBRERO">Febrero</option>
                        <option value="MARZO">Marzo</option>
                        <option value="ABRIL">Abril</option>
                        <option value="MAYO">Mayo</option>
                        <option value="JUNIO">Junio</option>
                        <option value="JULIO">Julio</option>
                        <option value="AGOSTO">Agosto</option>
                        <option value="SEPTIEMBRE">Septiembre</option>
                        <option value="OCTUBRE">Octubre</option>
                        <option value="NOVIEMBRE">Noviembre</option>
                        <option value="DICIEMBRE">Diciembre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="center_name">Nombre del Centro o Puesto de Salud:</label>
                    <input type="text" id="center_name" name="center_name" placeholder="EJ. PUESTO DE SALUD CHAMBARA" required>
                </div>

                <button type="submit" class="btn">Generar PDF</button>
            </form>
        </div>
    </div>
</body>
</html>
