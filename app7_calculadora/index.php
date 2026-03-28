<?php
session_start();
require_once '../classes/Calculator.php';

$resultado = "";
$error = "";

if (!isset($_SESSION['historial'])) {
    $_SESSION['historial'] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $calc = new Calculator();

    if (isset($_POST["borrar_historial"])) {
        $_SESSION['historial'] = [];
    } else {
        $a = floatval($_POST["numero1"] ?? 0);
        $b = floatval($_POST["numero2"] ?? 0);
        $operacion = $_POST["operacion"] ?? "";

        $resultado = $calc->calculate($a, $b, $operacion);
        $simbolo = $calc->getSymbol($operacion);

        if (!is_string($resultado) || strpos($resultado, "Error") === false) {
            $expresion = ($operacion === "porcentaje")
                ? "$a % de $b = $resultado"
                : "$a $simbolo $b = $resultado";

            $_SESSION['historial'][] = $expresion;
        } else {
            $error = $resultado;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>7. Calculadora con Historial</h1>
        <p>Realice operaciones básicas y guarde el historial.</p>

        <form method="POST">
            <label for="numero1">Primer número:</label>
            <input type="number" step="any" name="numero1" id="numero1" required>

            <label for="numero2">Segundo número:</label>
            <input type="number" step="any" name="numero2" id="numero2" required>

            <label for="operacion">Operación:</label>
            <select name="operacion" id="operacion" required>
                <option value="">Seleccione...</option>
                <option value="suma">Suma</option>
                <option value="resta">Resta</option>
                <option value="multiplicacion">Multiplicación</option>
                <option value="division">División</option>
                <option value="porcentaje">Porcentaje</option>
            </select>

            <button type="submit" class="btn">Calcular</button>
        </form>

        <form method="POST" style="margin-top: 15px;">
            <button type="submit" name="borrar_historial" class="btn">Borrar historial</button>
        </form>

        <?php if ($resultado !== "" && $error === ""): ?>
            <div class="result">
                <h3>Resultado:</h3>
                <p><strong>Resultado:</strong> <?= htmlspecialchars((string)$resultado) ?></p>
            </div>
        <?php endif; ?>

        <?php if ($error !== ""): ?>
            <div class="error">
                <strong>Error:</strong> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <div class="result">
            <h3>Historial de operaciones:</h3>
            <?php if (!empty($_SESSION['historial'])): ?>
                <ul>
                    <?php foreach (array_reverse($_SESSION['historial']) as $item): ?>
                        <li><?= htmlspecialchars($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No hay operaciones registradas.</p>
            <?php endif; ?>
        </div>

        <div class="back">
            <a class="btn" href="../index.php">← Volver al menú</a>
        </div>
    </div>
</body>
</html>