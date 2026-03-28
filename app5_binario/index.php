<?php
require_once '../classes/BinaryConverter.php';

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numero = intval($_POST["numero"] ?? 0);
    $converter = new BinaryConverter();
    $resultado = $converter->convert($numero);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversión a Binario</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>5. Conversión de Entero a Binario</h1>
        <p>Ingrese un número entero y obtenga su representación binaria.</p>

        <form method="POST">
            <label for="numero">Número entero:</label>
            <input type="number" name="numero" id="numero" required>
            <button type="submit" class="btn">Convertir</button>
        </form>

        <?php if ($resultado !== ""): ?>
            <div class="result">
                <h3>Resultado:</h3>
                <p><strong>Binario:</strong> <?= htmlspecialchars($resultado) ?></p>
            </div>
        <?php endif; ?>

        <div class="back">
            <a class="btn" href="../index.php">← Volver al menú</a>
        </div>
    </div>
</body>
</html>