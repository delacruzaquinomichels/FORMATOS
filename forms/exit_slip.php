<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Papeleta de Salida</title>
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
            <h2>Papeleta de Salida</h2>
            <form action="../generate_exit_slip.php" method="POST" target="_blank">
                <div class="form-group">
                    <label for="exit_slip_no">Papeleta de salida N°:</label>
                    <input type="text" id="exit_slip_no" name="exit_slip_no" required>
                </div>

                <div class="form-group">
                    <label for="full_name">Nombres y apellidos:</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>

                <div class="form-group">
                    <label for="reason">Motivo de salida:</label>
                    <input type="text" id="reason" name="reason" required>
                </div>

                <div class="form-group">
                    <label for="destination">Lugar de destino:</label>
                    <input type="text" id="destination" name="destination" required>
                </div>

                <div class="form-group">
                    <label for="district">Lugar distrito:</label>
                    <input type="text" id="district" name="district" required>
                </div>

                <div class="form-group">
                    <label for="date">Fecha:</label>
                    <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>

                <button type="submit" class="btn">Generar PDF</button>
            </form>
        </div>
    </div>
</body>
</html>
