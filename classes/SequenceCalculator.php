<?php

class SequenceCalculator {

    public function fibonacci(int $n): array {
        if ($n <= 0) return [];
        if ($n === 1) return [0];

        $serie = [0, 1];

        for ($i = 2; $i < $n; $i++) {
            $serie[] = $serie[$i - 1] + $serie[$i - 2];
        }

        return $serie;
    }

    public function factorial(int $n): array {
        if ($n < 0) {
            return [
                "proceso" => [],
                "resultado" => "No definido para negativos"
            ];
        }

        if ($n === 0 || $n === 1) {
            return [
                "proceso" => [$n],
                "resultado" => 1
            ];
        }

        $resultado = 1;
        $proceso = [];

        for ($i = 1; $i <= $n; $i++) {
            $resultado *= $i;
            $proceso[] = $i;
        }

        return [
            "proceso" => $proceso,
            "resultado" => $resultado
        ];
    }
}
?>