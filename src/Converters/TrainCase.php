<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\Helpers\Str;

class TrainCase extends AbstractCase
{
    protected static function caseFormat(): CaseFormat
    {
        return CaseFormat::TRAIN;
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
