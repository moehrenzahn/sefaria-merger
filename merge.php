#!/usr/bin/env php
<?php

$path = $argv[1];
$outputPath = $argv[2] ?? realpath('./_output');

if (!$path) {
    println("Usage: merge [sefaria-export-repository] [output-path]");
    exit(1);
}
if (!file_exists($path)) {
    println("Error: Path '$path' does not exist!");
    println("Usage: merge [sefaria-export-repository] [output-path]");
    exit(1);
}

mkdir($outputPath);

$bookDirs = [
    'Prophets' => [
        "Amos",
        "Ezekiel",
        "Habakkuk",
        "Haggai",
        "Hosea",
        "I Kings",
        "I Samuel",
        "II Kings",
        "II Samuel",
        "Isaiah",
        "Jeremiah",
        "Joel",
        "Jonah",
        "Joshua",
        "Judges",
        "Malachi",
        "Micah",
        "Nahum",
        "Obadiah",
        "Zechariah",
        "Zephaniah",
    ],
    'Torah' => [
        "Deuteronomy",
        "Exodus",
        "Genesis",
        "Leviticus",
        "Numbers",
    ],
    'Writings' => [
        "Daniel",
        "Ecclesiastes",
        "Esther",
        "Ezra",
        "I Chronicles",
        "II Chronicles",
        "Job",
        "Lamentations",
        "Nehemiah",
        "Proverbs",
        "Psalms",
        "Ruth",
        "Song of Songs",
    ]
];
$languagePath = 'English';
$versionNames = [
    'The Holy Scriptures A New Translation JPS 1917',
    'Bible du Rabbinat 1899 [fr]',
    'The Koren Jerusalem Bible',
];
$fileExtension = 'json';

$versionData = [
    "status",
    "versionTitle",
    "sectionNames",
    "license",
    "language",
    "versionSource",
    "categories"
];
$bookData = [
    'title',
    'heTitle',
    'text'
];


$jsonPath = realpath($path) . "/json/Tanakh";

foreach ($versionNames as $versionName) {
    $data = [];
    $keyFile = "$jsonPath/Torah/Genesis/$languagePath/$versionName.$fileExtension";
    $keyFileJson = json_decode(file_get_contents($keyFile), true);
    foreach ($versionData as $key) {
        $data[$key] = $keyFileJson[$key];
    }
    foreach ($bookDirs as $collection => $books) {
        foreach ($books as $book) {
            $fileName = "$jsonPath/$collection/$book/$languagePath/$versionName.$fileExtension";
            $json = json_decode(file_get_contents($fileName), true);
            $data[$json['title']] = [];
            foreach ($bookData as $key) {
                $data[$json['title']][$key] = $json[$key];
            }
        }
    }
    file_put_contents(
        "$outputPath/$versionName.$fileExtension",
        json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}




exit(0);

function println($text) {
    echo $text . PHP_EOL;
}
