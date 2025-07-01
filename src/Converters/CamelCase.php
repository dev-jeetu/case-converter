<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\Helpers\Str;

class CamelCase extends AbstractCase
{
    protected static function caseFormat(): CaseFormat
    {
        return CaseFormat::CAMEL;
    }

    protected static function applySpecificCase(string $string): string
    {
        $words = explode(Str::BASE_DELIMITER, $string);

        $first = array_shift($words);
        $firstWord = Str::isAcronym($first) ? $first : Str::lower($first);

        $formattedWords = array_map(function ($word) {
            return Str::isAcronym($word)
                ? $word
                : Str::ucfirst(Str::lower($word));
        }, $words);

        return $firstWord.implode(static::getDelimiter(), $formattedWords);
    }
}
