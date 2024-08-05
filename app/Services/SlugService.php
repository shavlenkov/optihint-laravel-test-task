<?php

namespace App\Services;

class SlugService {
    public static function decodeSlug(string $title) {
        return str_replace(' ', '-', preg_replace('/\s+/', ' ', $title));
    }
}
