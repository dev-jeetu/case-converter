<?php

namespace DevJeetu\CaseConverter;

class CaseConverterHelper
{
    public const SEPARATORS = ['.', '-', ' ', '/', '_'];
    public const CAPITAL_LETTER_PATTERN = '/(?<=[a-z0-9])([A-Z])/';

    public static function isEmpty(string $string): bool
    {
        return trim($string) === '';
    }

    /**
     * Replace all common separators with specified delimiter
     * Handles: .(dot), -(dash), _(underscore), space, /(path separator)
     */
    public static function replaceAllSeparatorsWithDelimiter(string $string, string $delimiter): string
    {
        return str_replace(self::SEPARATORS, $delimiter, $string);
    }

    /**
     * Handle acronyms like XML, HTTP, API properly
     *
     * @param string $string The input string
     */
    public static function normalizeAcronyms(string $string, string $delimiter = '_'): string
    {
        $result = preg_replace('/([a-z])([A-Z]{2,})$/', '$1' . $delimiter . '$2', $string) ?? $string;

        return preg_replace('/([A-Z]{2,})([A-Z][a-z])/', '$1' . $delimiter . '$2', $result) ?? $result;
    }

    /**
     * Insert delimiters before capital letters (generic version)
     * Useful for other case converters
     */
    public static function insertDelimiterBeforeCapitalLetters(string $string, string $delimiter): string
    {
        return preg_replace(self::CAPITAL_LETTER_PATTERN, $delimiter . '$1', $string) ?? $string;
    }

    /**
     * Replace multiple consecutive delimiters with a single delimiter
     * Generic version for other converters
     */
    public static function normalizeDelimiters(string $string, string $delimiter): string
    {
        $pattern = '/' . preg_quote($delimiter, '/') . '+/';
        $result = preg_replace($pattern, $delimiter, $string) ?? $string;

        return trim($result, $delimiter);
    }

    public static function isAcronym(string $word): bool
    {
        return strlen($word) >= 2 && ctype_upper($word);
    }
}
