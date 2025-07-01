<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\Helpers\Str;

class PascalCase extends AbstractCase
{
    protected static function caseFormat(): CaseFormat
    {
        return CaseFormat::PASCAL;
    }

    protected static function applySpecificCase(string $string): string
    {
        $words = explode(Str::BASE_DELIMITER, $string);

        $formattedWords = array_map(function ($word) {
            return Str::isAcronym($word) ? $word : ucfirst(strtolower($word));
        }, $words);

        return implode(static::getDelimiter(), $formattedWords);
    }
}
