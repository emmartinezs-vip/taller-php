<?php

class Calculator {

    public function calculate(float $a, float $b, string $operation) {
        switch ($operation) {
            case 'suma':
                return $a + $b;

            case 'resta':
                return $a - $b;

            case 'multiplicacion':
                return $a * $b;

            case 'division':
                return $b != 0 ? $a / $b : "Error: división por cero";

            case 'porcentaje':
                return ($a * $b) / 100;

            default:
                return "Operación no válida";
        }
    }

    public function getSymbol(string $operation): string {
        return match($operation) {
            'suma' => '+',
            'resta' => '-',
            'multiplicacion' => '×',
            'division' => '÷',
            'porcentaje' => '% de',
            default => '?'
        };
    }
}
?>