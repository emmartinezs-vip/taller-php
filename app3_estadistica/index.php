<?php
require_once '../classes/StatisticsCalculator.php';

$promedio = "";
$mediana = "";
$moda = "";
$numerosMostrados = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $entrada = $_POST["numeros"] ?? "";

    $stats = new StatisticsCalculator();
    $numeros = $stats->parseNumbers($entrada);

    if (!empty($numeros)) {
        $promedio = $stats->average($numeros);
        $mediana = $stats->median($numeros);
        $moda = $stats->mode($numeros);
        $numerosMostrados = implode(", ", $numeros);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadística</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>3. Promedio, Mediana y Moda</h1>
        <p>Ingrese una serie de números reales separados por coma.</p>

        <form method="POST">
            <label for="numeros">Números:</label>
            <textarea name="numeros" id="numeros" rows="4" placeholder="Ej: 2, 4, 4, 5, 6" required></textarea>
            <button type="submit" class="btn">Calcular</button>
        </form>

        <?php if ($numerosMostrados !== ""): ?>
            <div class="result">
                <h3>Resultados:</h3>
                <p><strong>Números ingresados:</strong> <?= htmlspecialchars($numerosMostrados) ?></p>
                <p><strong>Promedio:</strong> <?= htmlspecialchars((string)$promedio) ?></p>
                <p><strong>Mediana:</strong> <?= htmlspecialchars((string)$mediana) ?></p>
                <p><strong>Moda:</strong> 
                    <?= !empty($moda) ? htmlspecialchars(implode(", ", $moda)) : "No hay moda" ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="back">
            <a class="btn" href="../index.php">← Volver al menú</a>
        </div>
    </div>
</body>
</html>