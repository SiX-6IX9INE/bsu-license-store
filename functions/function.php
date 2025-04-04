<?php

function generateSlug($text) {
    $text = trim($text);
    $text = mb_strtolower($text, 'UTF-8');
    $text = preg_replace('/[^\p{Thai}\p{L}\p{N}]+/u', '-', $text);
    $text = preg_replace('/-+/', '-', $text);
    $text = trim($text, '-');

    return $text;
}

function shortDescription($text, $width = 100, $maxLines = 2) {
    $wrapped = wordwrap($text, $width, "\n");
    $lines = explode("\n", $wrapped);
    
    if (count($lines) > $maxLines) {
        return implode("\n", array_slice($lines, 0, $maxLines)) . '...';
    }
    
    return $text;
}

?>