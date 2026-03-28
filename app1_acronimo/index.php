<?php
require_once '../classes/Acronym.php';

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $frase = $_POST["frase"] ?? "";
    $acronym = new Acronym();
    $resultado = $acronym->generate($frase);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acrónimo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>1. Generador de Acrónimos</h1>
        <p>Convierte una frase larga en su acrónimo.</p>

        <form method="POST">
            <label for="frase">Ingrese una frase:</label>
            <input type="text" name="frase" id="frase" placeholder="Ej: Portable Network Graphics" required>
            <button type="submit" class="btn">Generar Acrónimo</button>
        </form>

        <?php if ($resultado !== ""): ?>
            <div class="result">
                <h3>Resultado:</h3>
                <p><strong>Acrónimo:</strong> <?= htmlspecialchars($resultado) ?></p>
            </div>
        <?php endif; ?>

        <div class="back">
            <a class="btn" href="../index.php">← Volver al menú</a>
        </div>
    </div>
</body>
</html>