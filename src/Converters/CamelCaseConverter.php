<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\BaseCaseConverter;
use DevJeetu\CaseConverter\CaseConverterHelper;
use DevJeetu\CaseConverter\CaseConverterInterface;

class CamelCaseConverter implements CaseConverterInterface
{
    public static function convert(string $string): string
    {
        $result = BaseCaseConverter::convert($string, '_');

        if (empty($result)) {
            return '';
        }

        $words = explode('_', $result);
        $first = array_shift($words);

        // Check if the first word is an acronym (all uppercase)
        $firstWord = CaseConverterHelper::isAcronym($first) ? $first : strtolower($first);

        return $firstWord . implode('', array_map('ucfirst', $words));
    }
}
