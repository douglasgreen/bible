#!/usr/bin/env php
<?php

function getBase(string $word, array $glossaryWords): ?string
{
    $lowWord = mb_strtolower($word);
    $capWord = mb_strtoupper($word);

    if (strlen($word) > 1 && $word === $capWord) {
        if (isset($glossaryWords[$capWord])) {
            return $capWord;
        }
        return null;
    }

    if (isset($glossaryWords[$word])) {
        return $word;
    }
    if (isset($glossaryWords[$lowWord])) {
        return $lowWord;
    }

    if (
        preg_match('/(.+)(ant|int|ont|at|it|ot)(a|aj|an|ajn|o|oj|on|ojn|e)$/', $lowWord, $match)
    ) {
        $candidate = $match[1] . 'i';
        if (isset($glossaryWords[$candidate])) {
            return $candidate;
        }
    }

    if (preg_match('/(.+)(o|oj|on|ojn)$/', $lowWord, $match)) {
        $candidate = $match[1] . 'o';
        if (isset($glossaryWords[$candidate])) {
            return $candidate;
        }
    }

    if (preg_match('/(.+)(a|aj|an|ajn)$/', $lowWord, $match)) {
        $candidate = $match[1] . 'a';
        if (isset($glossaryWords[$candidate])) {
            return $candidate;
        }
    }

    if (preg_match('/(.+)(e)$/', $lowWord, $match)) {
        $candidate = $match[1] . 'e';
        if (isset($glossaryWords[$candidate])) {
            return $candidate;
        }
    }

    if (preg_match('/(.+)(i|as|is|os|us|u)$/', $lowWord, $match)) {
        $candidate = $match[1] . 'i';
        if (isset($glossaryWords[$candidate])) {
            return $candidate;
        }
    }

    return null;
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
$glossaryWords = [];
$allowedCategories = ['correlative', 'other', 'pronoun', 'root'];
$fh = fopen(__DIR__ . '/glossary.csv', 'r');
while ($fields = fgetcsv($fh)) {
    if (count($fields) !== 3) {
        continue;
    }
    list($category, $word, $definition) = $fields;
    if (!in_array($category, $allowedCategories, true)) {
        continue;
    }
    $defs[$word] = $definition;
    $glossaryWords[$word] = true;
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
        $base = getBase($word, $glossaryWords);
        if ($base === null) {
            continue;
        }
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
