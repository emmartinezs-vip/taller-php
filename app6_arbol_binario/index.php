<?php
require_once '../classes/BinaryTree.php';

$arbolTexto = "";
$preorderOut = "";
$inorderOut = "";
$postorderOut = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pre = trim($_POST["preorden"] ?? "");
    $in = trim($_POST["inorden"] ?? "");
    $post = trim($_POST["postorden"] ?? "");

    $tree = new BinaryTree();
    $root = null;

    if ($pre !== "" && $in !== "") {
        $preorder = $tree->parseInput($pre);
        $inorder = $tree->parseInput($in);
        $root = $tree->buildFromPreIn($preorder, $inorder);
    } elseif ($post !== "" && $in !== "") {
        $postorder = $tree->parseInput($post);
        $inorder = $tree->parseInput($in);
        $root = $tree->buildFromPostIn($postorder, $inorder);
    } else {
        $error = "Debe ingresar al menos Preorden + Inorden o Postorden + Inorden.";
    }

    if ($root !== null) {
        $arbolTexto = $tree->printTree($root);

        $preResult = [];
        $inResult = [];
        $postResult = [];

        $preorderOut = implode(" → ", $tree->getPreorder($root, $preResult));
        $inorderOut = implode(" → ", $tree->getInorder($root, $inResult));
        $postorderOut = implode(" → ", $tree->getPostorder($root, $postResult));
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Árbol Binario</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>6. Construcción de Árbol Binario</h1>
        <p>Ingrese al menos dos recorridos del árbol binario.</p>

        <form method="POST">
            <label for="preorden">Preorden:</label>
            <input type="text" name="preorden" id="preorden" placeholder="Ej: A,B,D,E,C">

            <label for="inorden">Inorden:</label>
            <input type="text" name="inorden" id="inorden" placeholder="Ej: D,B,E,A,C">

            <label for="postorden">Postorden:</label>
            <input type="text" name="postorden" id="postorden" placeholder="Ej: D,E,B,C,A">

            <button type="submit" class="btn">Construir Árbol</button>
        </form>

        <?php if ($error !== ""): ?>
            <div class="error">
                <strong>Error:</strong> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($arbolTexto !== ""): ?>
            <div class="result">
                <h3>Árbol reconstruido:</h3>
                <div class="code-block"><?= $arbolTexto ?></div>

                <h3>Recorridos generados:</h3>
                <p><strong>Preorden:</strong> <?= htmlspecialchars($preorderOut) ?></p>
                <p><strong>Inorden:</strong> <?= htmlspecialchars($inorderOut) ?></p>
                <p><strong>Postorden:</strong> <?= htmlspecialchars($postorderOut) ?></p>
            </div>
        <?php endif; ?>

        <div class="back">
            <a class="btn" href="../index.php">← Volver al menú</a>
        </div>
    </div>
</body>
</html>