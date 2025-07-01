<?php

namespace DevJeetu\CaseConverter;

class BaseCaseConverter
{
    public static function convert(string $string, string $delimiter = '_'): string
    {
        if (CaseConverterHelper::isEmpty($string)) {
            return '';
        }

        $result = CaseConverterHelper::replaceAllSeparatorsWithDelimiter($string, $delimiter);
        $result = CaseConverterHelper::normalizeAcronyms($result, $delimiter);
        $result = CaseConverterHelper::insertDelimiterBeforeCapitalLetters($result, $delimiter);

        return CaseConverterHelper::normalizeDelimiters($result, $delimiter);
    }
}
