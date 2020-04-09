# Sefaria Merger

You can use this tiny tool to merge Sefaria JSON versions into one file for use with [ScriptureKit](https://github.com/moehrenzahn/scripturekit-php).

## Author

Max Melzer ([moehrenzahn.de](https://www.moehrenzahn.de))

## Usage

1. Clone the [Sefaria Export](https://github.com/Sefaria/Sefaria-Export) repository into a directory.
2. Run `merge.php path/to/Sefaria-Export`

The Merger will create one file for each translation in the `_output` directory.

You can also specify a custom output directory with a `merge.php path/to/Sefaria-Export path/to/output`.

Currently, the list of generated versions is hard-coded:

```php
$versionNames = [
    'The Holy Scriptures A New Translation JPS 1917',
    'Bible du Rabbinat 1899 [fr]',
    'The Koren Jerusalem Bible',
];
```

If you want other versions, you need to modify that array in `merge.php`.

## License

This project is in the Public Domain.