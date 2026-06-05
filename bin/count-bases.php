#!/usr/bin/env php
<?php

function getBase(string $word, array $glossaryWords): string
{
    $lowWord = mb_strtolower($word);

    // Exact matches
    if (isset($glossaryWords[$lowWord])) {
        return $glossaryWords[$lowWord];
    }

    // Participles
    if (
        preg_match('/(.+)(ant|int|ont|at|it|ot)(a|aj|an|ajn|o|oj|on|ojn|e)$/', $lowWord, $match)
    ) {
        foreach (['i', 'e', 'o', 'a'] as $ending) {
            $candidate = $match[1] . $ending;
            if (isset($glossaryWords[$candidate])) {
                return $glossaryWords[$candidate];
            }
        }
    }

    // Nouns
    if (preg_match('/(.+)(o|oj|on|ojn)$/', $lowWord, $match)) {
        foreach (['o', 'a', 'i', 'e'] as $ending) {
            $candidate = $match[1] . $ending;
            if (isset($glossaryWords[$candidate])) {
                return $glossaryWords[$candidate];
            }
        }
    }

    // Adjectives
    if (preg_match('/(.+)(a|aj|an|ajn)$/', $lowWord, $match)) {
        foreach (['a', 'o', 'i', 'e'] as $ending) {
            $candidate = $match[1] . $ending;
            if (isset($glossaryWords[$candidate])) {
                return $glossaryWords[$candidate];
            }
        }
    }

    // Adverbs
    if (preg_match('/(.+)(e)$/', $lowWord, $match)) {
        foreach (['e', 'i', 'o', 'a'] as $ending) {
            $candidate = $match[1] . $ending;
            if (isset($glossaryWords[$candidate])) {
                return $glossaryWords[$candidate];
            }
        }
    }

    // Adverbs of direction
    if (preg_match('/(.+)(en)$/', $lowWord, $match)) {
        $candidate = $match[1] . 'e';
        if (isset($glossaryWords[$candidate])) {
            return $glossaryWords[$candidate];
        }
    }

    // Correlatives and the number "unu" ending in u
    if (preg_match('/(.+)(u|uj|un|ujn)$/', $lowWord, $match)) {
        $candidate = $match[1] . 'u';
        if (isset($glossaryWords[$candidate])) {
            return $glossaryWords[$candidate];
        }
    }

    // Verbs
    if (preg_match('/(.+)(i|as|is|os|us|u)$/', $lowWord, $match)) {
        foreach (['i', 'e', 'o', 'a'] as $ending) {
            $candidate = $match[1] . $ending;
            if (isset($glossaryWords[$candidate])) {
                return $glossaryWords[$candidate];
            }
        }
    }

    return $word;
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
        if ($fields) {
            echo "Bad field count: " . var_export($fields, true);
            exit(1);
        }
        continue;
    }
    list($category, $word, $definition) = $fields;
    if (!in_array($category, $allowedCategories, true)) {
        continue;
    }
    $defs[$word] = $definition;
    $glossaryWords[mb_strtolower($word)] = $word;
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
