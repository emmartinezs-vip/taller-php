<?php

class StatisticsCalculator {

    public function parseNumbers(string $input): array {
        $input = str_replace(';', ',', $input);
        $numbers = array_map('trim', explode(',', $input));
        $numbers = array_filter($numbers, fn($n) => $n !== '');
        return array_map('floatval', $numbers);
    }

    public function average(array $numbers): float {
        return count($numbers) > 0 ? array_sum($numbers) / count($numbers) : 0;
    }

    public function median(array $numbers): float {
        sort($numbers);
        $count = count($numbers);
        $middle = floor($count / 2);

        if ($count === 0) return 0;

        if ($count % 2 === 0) {
            return ($numbers[$middle - 1] + $numbers[$middle]) / 2;
        }

        return $numbers[$middle];
    }

    public function mode(array $numbers): array {
        if (empty($numbers)) return [];

        $frequencies = array_count_values(array_map('strval', $numbers));
        $maxFreq = max($frequencies);

        if ($maxFreq <= 1) return [];

        $modes = [];
        foreach ($frequencies as $num => $freq) {
            if ($freq === $maxFreq) {
                $modes[] = $num;
            }
        }

        return $modes;
    }
}
?>