#!/usr/bin/env php
<?php

$bases = [
    'akurata' => 'akurata',
    'akurataj' => 'akurata',
    'akuratajn' => 'akurata',
    'akuratan' => 'akurata',
    'akurate' => 'akurate',
    'al' => 'al',
    'anstataŭ' => 'anstataŭ',
    'antaŭ' => 'antaŭ',
    'antaŭen' => 'antaŭen',
    'apud' => 'apud',
    'aŭ' => 'aŭ',
    'aŭtoritata' => 'aŭtoritata',
    'aŭtoritataj' => 'aŭtoritata',
    'aŭtoritatajn' => 'aŭtoritata',
    'aŭtoritatan' => 'aŭtoritata',
    'aŭtoritato' => 'aŭtoritato',
    'aŭtoritatoj' => 'aŭtoritato',
    'aŭtoritatojn' => 'aŭtoritato',
    'aŭtoritaton' => 'aŭtoritato',
    'boata' => 'boata',
    'boataj' => 'boata',
    'boatajn' => 'boata',
    'boatan' => 'boata',
    'boato' => 'boato',
    'boatoj' => 'boato',
    'boatojn' => 'boato',
    'boaton' => 'boato',
    'ĉar' => 'ĉar',
    'ĉe' => 'ĉe',
    'ĉia' => 'ĉia',
    'ĉiam' => 'ĉiam',
    'ĉi' => 'ĉi',
    'ĉiel' => 'ĉiel',
    'ĉio' => 'ĉio',
    'ĉion' => 'ĉio',
    'ĉiu' => 'ĉiu',
    'ĉiuj' => 'ĉiu',
    'ĉiujn' => 'ĉiu',
    'ĉiun' => 'ĉiu',
    'ĉu' => 'ĉu',
    'de' => 'de',
    'do' => 'do',
    'du' => 'du',
    'dum' => 'dum',
    'ekster' => 'ekster',
    'en' => 'en',
    'Esdras' => 'Esdras',
    'frata' => 'frata',
    'frataj' => 'frata',
    'fratajn' => 'frata',
    'fratan' => 'frata',
    'frato' => 'frato',
    'fratoj' => 'frato',
    'fratojn' => 'frato',
    'fraton' => 'frato',
    'ĝia' => 'ĝi',
    'ĝi' => 'ĝi',
    'ĝin' => 'ĝi',
    'ĝian' => 'ĝi',
    'ĝiaj' => 'ĝi',
    'ĝiajn' => 'ĝi',
    'ĝis' => 'ĝis',
    'honta' => 'honta',
    'hontaj' => 'honta',
    'hontajn' => 'honta',
    'hontan' => 'honta',
    'honte' => 'honte',
    'honti' => 'honti',
    'honto' => 'honta',
    'hontoj' => 'honta',
    'hontojn' => 'honta',
    'honton' => 'honta',
    'ia' => 'ia',
    'iam' => 'iam',
    'iel' => 'iel',
    'ilia' => 'ili',
    'iliaj' => 'ili',
    'iliajn' => 'ili',
    'ilian' => 'ili',
    'ili' => 'ili',
    'ilin' => 'ili',
    'inter' => 'inter',
    'io' => 'io',
    'ion' => 'io',
    'iu' => 'iu',
    'iun' => 'iu',
    'je' => 'je',
    'Jesuo' => 'Jesuo',
    'Johano' => 'Johano',
    'ĵus' => 'ĵus',
    'kaj' => 'kaj',
    'ke' => 'ke',
    'kial' => 'kial',
    'kiam' => 'kiam',
    'kie' => 'kie',
    'kiel' => 'kiel',
    'kio' => 'kio',
    'kion' => 'kio',
    'kioma' => 'kioma',
    'kiom' => 'kiom',
    'kiuj' => 'kiu',
    'kiujn' => 'kiu',
    'kiu' => 'kiu',
    'kiun' => 'kiu',
    'kompataj' => 'kompata',
    'kompatajn' => 'kompata',
    'kompata' => 'kompata',
    'kompatan' => 'kompata',
    'kompate' => 'kompate',
    'kompatoj' => 'kompato',
    'kompatojn' => 'kompato',
    'kompato' => 'kompato',
    'kompaton' => 'kompato',
    'konstanta' => 'konstanta',
    'kontraŭ' => 'kontraŭ',
    'krom' => 'krom',
    'kun' => 'kun',
    'kvankam' => 'kvankam',
    'kvazaŭ' => 'kvazaŭ',
    'la' => 'la',
    'laŭ' => 'laŭ',
    'lia' => 'li',
    'li' => 'li',
    'lin' => 'li',
    'lian' => 'li',
    'liaj' => 'li',
    'liajn' => 'li',
    'malgraŭ' => 'malgraŭ',
    'mia' => 'mi',
    'mi' => 'mi',
    'min' => 'mi',
    'mian' => 'mi',
    'miaj' => 'mi',
    'miajn' => 'mi',
    'nek' => 'nek',
    'ne' => 'ne',
    'neniam' => 'neniam',
    'nenia' => 'nenia',
    'nenie' => 'nenie',
    'nenio' => 'nenio',
    'nenion' => 'nenio',
    'neniuj' => 'neniu',
    'neniujn' => 'neniu',
    'neniu' => 'neniu',
    'neniun' => 'neniu',
    'nia' => 'ni',
    'ni' => 'ni',
    'nin' => 'ni',
    'nian' => 'ni',
    'niaj' => 'ni',
    'niajn' => 'ni',
    'notojn' => 'noto',
    'notoj' => 'noto',
    'noton' => 'noto',
    'noto' => 'noto',
    'ol' => 'ol',
    'oni' => 'oni',
    'onin' => 'oni',
    'onia' => 'oni',
    'onian' => 'oni',
    'oniaj' => 'oni',
    'oniajn' => 'oni',
    'per' => 'per',
    'piednotojn' => 'piednoto',
    'piednotoj' => 'piednoto',
    'piednoton' => 'piednoto',
    'piednoto' => 'piednoto',
    'pivota' => 'pivota',
    'pli' => 'pli',
    'plu' => 'plu',
    'por' => 'por',
    'post' => 'post',
    'pri' => 'pri',
    'pro' => 'pro',
    'rekte' => 'rekte',
    'sabatajn' => 'sabata',
    'sabataj' => 'sabata',
    'sabatan' => 'sabata',
    'sabata' => 'sabata',
    'sabatojn' => 'sabato',
    'sabatoj' => 'sabato',
    'sabaton' => 'sabato',
    'sabato' => 'sabato',
    'sed' => 'sed',
    'senprofita' => 'senprofita',
    'sen' => 'sen',
    'se' => 'se',
    'ŝia' => 'ŝi',
    'ŝian' => 'ŝi',
    'ŝiaj' => 'ŝi',
    'ŝiajn' => 'ŝi',
    'si' => 'si',
    'sin' => 'si',
    'sia' => 'si',
    'sian' => 'si',
    'siaj' => 'si',
    'siajn' => 'si',
    'ŝi' => 'ŝi',
    'ŝin' => 'ŝi',
    'spiritojn' => 'spirito',
    'spiritoj' => 'spirito',
    'spiriton' => 'spirito',
    'spirito' => 'spirito',
    'sub' => 'sub',
    'super' => 'super',
    'sur' => 'sur',
    'tamen' => 'tamen',
    'tial' => 'tial',
    'tiam' => 'tiam',
    'tia' => 'tia',
    'tiel' => 'tiel',
    'tie' => 'tie',
    'tio' => 'tio',
    'tion' => 'tio',
    'tiuj' => 'tiu',
    'tiujn' => 'tiu',
    'tiu' => 'tiu',
    'tiun' => 'tiu',
    'trans' => 'trans',
    'tra' => 'tra',
    'tri' => 'tri',
    'unu' => 'unu',
    'uzantojn' => 'uzanto',
    'uzantoj' => 'uzanto',
    'uzanton' => 'uzanto',
    'uzanto' => 'uzanto',
    'via' => 'vi',
    'vi' => 'vi',
    'vin' => 'vi',
    'vian' => 'vi',
    'viaj' => 'vi',
    'viajn' => 'vi',
];

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
        echo "* {$base}: {$forms}\n";
    }

    echo "\n";
}
