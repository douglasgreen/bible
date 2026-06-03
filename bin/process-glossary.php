<?php

$inputFile = __DIR__ . '/glossary.csv';

if (!file_exists($inputFile)) {
    echo "Error: Input file '$inputFile' not found.\n";
    exit(1);
}

$handle = fopen($inputFile, "r");
if ($handle === false) {
    echo "Error: Could not open input file.\n";
    exit(1);
}

$glossary = [];

while (($data = fgetcsv($handle)) !== false) {
    if (count($data) !== 3) {
        die("Bad record: " . var_export($data, true));
    }

    $category = trim($data[0]);
    $word = trim($data[1]);
    $definition = trim($data[2]);

    if (isset($glossary[$category][$word])) {
        die("Duplicate word: $category $word\n");
    }

    $glossary[$category][$word] = $definition;
}

fclose($handle);

