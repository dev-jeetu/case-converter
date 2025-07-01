<?php

namespace DevJeetu\CaseConverter\Helpers;

class Str
{
    public const BASE_DELIMITER = ' ';
    public const SEPARATORS = ['.', '-', '/', '_'];
    public const CAPITAL_LETTER_PATTERN = '/(?<=[\p{Ll}0-9])(\p{Lu})/u';

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
    public static function normalizeAcronyms(string $string, string $delimiter): string
    {
        $result = preg_replace('/(\p{Ll})(\p{Lu}{2,})$/u', '$1' . $delimiter . '$2', $string) ?? $string;

        return preg_replace('/(\p{Lu}{2,})(\p{Lu}\p{Ll})/u', '$1' . $delimiter . '$2', $result) ?? $result;
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
        // Only detect ASCII acronyms (like XML, HTTP, API)
        // Non-ASCII uppercase words should be treated as normal words
        return mb_strlen($word, 'UTF-8') >= 2 
            && $word === mb_strtoupper($word, 'UTF-8')
            && preg_match('/^[A-Z]+$/', $word);
    }

    /**
     * @return string - space separate string without any case modification.
     */
    public static function convert(string $string): string
    {
        if (trim($string) === '') {
            return '';
        }

        $result = self::replaceAllSeparatorsWithDelimiter($string, self::BASE_DELIMITER);
        $result = self::normalizeAcronyms($result, self::BASE_DELIMITER);
        $result = self::insertDelimiterBeforeCapitalLetters($result, self::BASE_DELIMITER);

        return self::normalizeDelimiters($result, self::BASE_DELIMITER);
    }

    /**
     * Unicode-safe lowercase
     */
    public static function lower(string $string): string
    {
        return mb_strtolower($string, 'UTF-8');
    }

    /**
     * Unicode-safe uppercase
     */
    public static function upper(string $string): string
    {
        return mb_strtoupper($string, 'UTF-8');
    }

    /**
     * Unicode-safe ucfirst
     */
    public static function ucfirst(string $string): string
    {
        $firstChar = mb_substr($string, 0, 1, 'UTF-8');
        $rest = mb_substr($string, 1, null, 'UTF-8');

        return mb_strtoupper($firstChar, 'UTF-8') . mb_strtolower($rest, 'UTF-8');
    }
}
