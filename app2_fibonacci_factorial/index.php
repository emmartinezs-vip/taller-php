<?php
require_once '../classes/SequenceCalculator.php';

$resultado = "";
$detalle = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = intval($_POST["numero"] ?? 0);
    $operacion = $_POST["operacion"] ?? "";

    $calculator = new SequenceCalculator();

    if ($operacion === "fibonacci") {
        $serie = $calculator->fibonacci($numero);
        $resultado = implode(", ", $serie);
        $detalle = "Serie Fibonacci de $numero términos.";
    } elseif ($operacion === "factorial") {
        $factorial = $calculator->factorial($numero);
        $resultado = $factorial["resultado"];
        $detalle = implode(" × ", $factorial["proceso"]);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fibonacci / Factorial</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>2. Fibonacci o Factorial</h1>
        <p>Ingrese un número y seleccione la operación.</p>

        <form method="POST">
            <label for="numero">Número:</label>
            <input type="number" name="numero" id="numero" min="0" required>

            <label for="operacion">Operación:</label>
            <select name="operacion" id="operacion" required>
                <option value="">Seleccione...</option>
                <option value="fibonacci">Fibonacci</option>
                <option value="factorial">Factorial</option>
            </select>

            <button type="submit" class="btn">Calcular</button>
        </form>

        <?php if ($resultado !== ""): ?>
            <div class="result">
                <h3>Resultado:</h3>
                <p><strong>Detalle:</strong> <?= htmlspecialchars($detalle) ?></p>
                <p><strong>Resultado:</strong> <?= htmlspecialchars((string)$resultado) ?></p>
            </div>
        <?php endif; ?>

        <div class="back">
            <a class="btn" href="../index.php">← Volver al menú</a>
        </div>
    </div>
</body>
</html>