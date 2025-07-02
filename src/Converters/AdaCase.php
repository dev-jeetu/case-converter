<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseType;
use DevJeetu\CaseConverter\Helpers\Str;

class AdaCase extends AbstractCase
{
    protected static function caseType(): CaseType
    {
        return CaseType::ADA;
    }

    protected static function applySpecificCase(string $string): string
    {
        $words = explode(Str::BASE_DELIMITER, $string);

        $formattedWords = array_map(function ($word) {
            return Str::isAcronym($word)
                ? $word
                : Str::ucfirst(Str::lower($word));
        }, $words);

        return implode(static::getDelimiter(), $formattedWords);
    }
}
