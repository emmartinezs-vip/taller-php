<?php
require_once '../classes/SetOperations.php';

$A = $B = [];
$union = $interseccion = $diferenciaAB = $diferenciaBA = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $entradaA = $_POST["conjuntoA"] ?? "";
    $entradaB = $_POST["conjuntoB"] ?? "";

    $setOps = new SetOperations();

    $A = $setOps->parseSet($entradaA);
    $B = $setOps->parseSet($entradaB);

    $union = $setOps->union($A, $B);
    $interseccion = $setOps->intersection($A, $B);
    $diferenciaAB = $setOps->difference($A, $B);
    $diferenciaBA = $setOps->difference($B, $A);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conjuntos</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>4. Operaciones con Conjuntos</h1>
        <p>Ingrese dos conjuntos de números enteros separados por comas.</p>

        <form method="POST">
            <label for="conjuntoA">Conjunto A:</label>
            <input type="text" name="conjuntoA" id="conjuntoA" placeholder="Ej: 1,2,3,4" required>

            <label for="conjuntoB">Conjunto B:</label>
            <input type="text" name="conjuntoB" id="conjuntoB" placeholder="Ej: 3,4,5,6" required>

            <button type="submit" class="btn">Calcular</button>
        </form>

        <?php if (!empty($A) || !empty($B)): ?>
            <div class="result">
                <h3>Resultados:</h3>
                <p><strong>A:</strong> <?= htmlspecialchars(implode(", ", $A)) ?></p>
                <p><strong>B:</strong> <?= htmlspecialchars(implode(", ", $B)) ?></p>
                <p><strong>Unión (A ∪ B):</strong> <?= htmlspecialchars(implode(", ", $union)) ?></p>
                <p><strong>Intersección (A ∩ B):</strong> <?= htmlspecialchars(implode(", ", $interseccion)) ?></p>
                <p><strong>Diferencia (A - B):</strong> <?= htmlspecialchars(implode(", ", $diferenciaAB)) ?></p>
                <p><strong>Diferencia (B - A):</strong> <?= htmlspecialchars(implode(", ", $diferenciaBA)) ?></p>
            </div>
        <?php endif; ?>

        <div class="back">
            <a class="btn" href="../index.php">← Volver al menú</a>
        </div>
    </div>
</body>
</html>