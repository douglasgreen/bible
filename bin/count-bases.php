#!/usr/bin/env php
<?php

function getBase(string $word): string
{
    global $bases;

    $lowWord = mb_strtolower($word);
    $capWord = mb_strtoupper($word);

    if (strlen($word) > 1 && $word === $capWord) {
        $base = $capWord;
    } elseif (isset($bases[$word])) {
        $base = $bases[$word];
    } elseif (isset($bases[$lowWord])) {
        $base = $bases[$lowWord];
    } elseif (
        preg_match('/(.+)(ant|int|ont|at|it|ot)(a|aj|an|ajn|o|oj|on|ojn|e)$/', $lowWord, $match)
    ) {
        // Participle to verb base
        $base = $match[1] . 'i';
    } elseif (preg_match('/(.+)(o|oj|on|ojn)$/', $lowWord, $match)) {
        // Noun base
        $base = $match[1] . 'o';
    } elseif (preg_match('/(.+)(a|aj|an|ajn)$/', $lowWord, $match)) {
        // Adjective base
        $base = $match[1] . 'a';
    } elseif (preg_match('/(.+)(e)$/', $lowWord, $match)) {
        // Adverb base
        $base = $match[1] . 'e';
    } elseif (preg_match('/(.+)(i|as|is|os|us|u)$/', $lowWord, $match)) {
        // Verb base
        $base = $match[1] . 'i';
    } else {
        $base = $lowWord;
    }

    return $base;
}

if ($argc < 2) {
    fwrite(STDERR, "Usage: {$argv[0]} <filename>\n");
    exit(1);
}

$filename = $argv[1];
if (!file_exists($filename)) {
    fwrite(STDERR, "Error: File '{$filename}' not found.\n");
    exit(1);
}

$lines = file($filename);
if ($lines === false) {
    fwrite(STDERR, "Error: Could not read file '{$filename}'.\n");
    exit(1);
}

$defs = [];
$fh = fopen(__DIR__ . '/glossary.csv', 'r');
while ($fields = fgetcsv($fh)) {
    list($base, $def) = $fields;
    $defs[$base] = $def;
}
fclose($fh);

$newCounts = [];
foreach ($lines as $line) {
    if (!preg_match_all('/\p{L}+/u', $line, $matches)) {
        continue;
    }

    echo "$line\n";

    $baseCounts = [];
    $baseForms = [];
    foreach ($matches[0] as $word) {
        $base = getBase($word);
        $baseForms[$base][$word] = true;
    }

    foreach ($baseForms as $base => $forms) {
        $forms = implode(', ', array_keys($forms));
        echo "* {$base} ({$forms})";
        if (isset($defs[$base])) {
            echo ": " . $defs[$base];
        } else {
            $newCounts[$base] = isset($newCounts[$base]) ? $newCounts[$base] + 1 : 1;
        }
        echo "\n";
    }

    echo "\n";
}

arsort($newCounts);
if ($newCounts) {
    echo "Unknown words:\n";
    foreach ($newCounts as $base => $count) {
        echo "* $base\n";
    }
}
