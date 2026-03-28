<?php

class Acronym {

    public function generate(string $phrase): string {
        
        $phrase = str_replace('-', ' ', $phrase);

        
        $phrase = preg_replace("/[^\p{L}\p{N}\s]/u", "", $phrase);

        
        $words = preg_split('/\s+/', trim($phrase));

        $acronym = "";

        foreach ($words as $word) {
            if (!empty($word)) {
                $acronym .= strtoupper($word[0]);
            }
        }

        return $acronym;
    }
}
?>