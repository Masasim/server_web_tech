<?php

namespace Max26\servLab1;

class sorter
{
    // Sort memes by name
    function memesSort(array $memes): array {
        usort($memes, fn($a, $b) => $a->name <=> $b->name);
        return $memes;
    }

    // Reverse sorting by name (optional if you need it)
    function memesReverseSort(array $memes): array {
        usort($memes, fn($a, $b) => $b->name <=> $a->name);
        return $memes;
    }
}
