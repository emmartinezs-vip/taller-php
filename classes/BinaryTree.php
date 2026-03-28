<?php

class Node {
    public $value;
    public $left;
    public $right;

    public function __construct($value) {
        $this->value = $value;
        $this->left = null;
        $this->right = null;
    }
}

class BinaryTree {

    public function parseInput(string $input): array {
        $input = str_replace(['→', '-', '>'], ',', $input);
        $items = array_map('trim', explode(',', $input));
        $items = array_filter($items, fn($item) => $item !== '');
        return array_values($items);
    }

    public function buildFromPreIn(array $preorder, array $inorder) {
        if (empty($preorder) || empty($inorder)) return null;

        $rootValue = array_shift($preorder);
        $root = new Node($rootValue);

        $rootIndex = array_search($rootValue, $inorder);

        $leftInorder = array_slice($inorder, 0, $rootIndex);
        $rightInorder = array_slice($inorder, $rootIndex + 1);

        $leftPreorder = array_slice($preorder, 0, count($leftInorder));
        $rightPreorder = array_slice($preorder, count($leftInorder));

        $root->left = $this->buildFromPreIn($leftPreorder, $leftInorder);
        $root->right = $this->buildFromPreIn($rightPreorder, $rightInorder);

        return $root;
    }

    public function buildFromPostIn(array $postorder, array $inorder) {
        if (empty($postorder) || empty($inorder)) return null;

        $rootValue = array_pop($postorder);
        $root = new Node($rootValue);

        $rootIndex = array_search($rootValue, $inorder);

        $leftInorder = array_slice($inorder, 0, $rootIndex);
        $rightInorder = array_slice($inorder, $rootIndex + 1);

        $leftPostorder = array_slice($postorder, 0, count($leftInorder));
        $rightPostorder = array_slice($postorder, count($leftInorder));

        $root->left = $this->buildFromPostIn($leftPostorder, $leftInorder);
        $root->right = $this->buildFromPostIn($rightPostorder, $rightInorder);

        return $root;
    }

    public function printTree($node, $level = 0): string {
        if ($node === null) return "";

        $output = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level) . "└── " . htmlspecialchars($node->value) . "<br>";
        $output .= $this->printTree($node->left, $level + 1);
        $output .= $this->printTree($node->right, $level + 1);

        return $output;
    }

    public function getPreorder($node, &$result = []) {
        if ($node === null) return $result;
        $result[] = $node->value;
        $this->getPreorder($node->left, $result);
        $this->getPreorder($node->right, $result);
        return $result;
    }

    public function getInorder($node, &$result = []) {
        if ($node === null) return $result;
        $this->getInorder($node->left, $result);
        $result[] = $node->value;
        $this->getInorder($node->right, $result);
        return $result;
    }

    public function getPostorder($node, &$result = []) {
        if ($node === null) return $result;
        $this->getPostorder($node->left, $result);
        $this->getPostorder($node->right, $result);
        $result[] = $node->value;
        return $result;
    }
}
?>