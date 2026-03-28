<?php

class SetOperations {

    public function parseSet(string $input): array {
        $input = str_replace(';', ',', $input);
        $elements = array_map('trim', explode(',', $input));
        $elements = array_filter($elements, fn($e) => $e !== '');
        $elements = array_map('intval', $elements);
        return array_values(array_unique($elements));
    }

    public function union(array $A, array $B): array {
        return array_values(array_unique(array_merge($A, $B)));
    }

    public function intersection(array $A, array $B): array {
        return array_values(array_intersect($A, $B));
    }

    public function difference(array $A, array $B): array {
        return array_values(array_diff($A, $B));
    }
}
?>