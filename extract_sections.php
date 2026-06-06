<?php
/**
 * Extract sections from markdown files based on heading count.
 *
 * Usage: php extract_sections.php <number> file1.md file2.md ...
 *
 * <number>   : the ordinal heading to start extraction from (1-based).
 * file*.md   : one or more markdown files.
 *
 * The script prints the text from each file starting at the specified heading
 * and continuing until the next heading or end of file.  Files are processed
 * in the order given on the command line.
 */

if ($argc < 3) {
    fwrite(STDERR, "Usage: php extract_sections.php <number> file1.md [file2.md ...]\n");
    exit(1);
}

$number = intval($argv[1]);

for ($i = 2; $i < $argc; $i++) {
    $file = $argv[$i];
    if (!is_readable($file)) {
        fwrite(STDERR, "Cannot read file: $file\n");
        continue;
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES);
    $headingCount = 0;
    $extracting = false;
    $buffer = [];

    foreach ($lines as $line) {
        if (preg_match('/^#{1,6}\s/', $line)) {
            $headingCount++;
            if ($extracting) {
                // Reached the next heading after the target section
                break;
            }
            if ($headingCount == $number) {
                $extracting = true;
            }
        }
        if ($extracting) {
            $buffer[] = $line;
        }
    }

    if (!empty($buffer)) {
        echo implode("\n", $buffer) . "\n";
    }
}
