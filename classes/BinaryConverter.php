<?php

class BinaryConverter {

    public function convert(int $number): string {
        return decbin($number);
    }
}
?>