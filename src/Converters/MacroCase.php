<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\Helpers\Str;

class MacroCase extends AbstractCase
{
    protected static function caseFormat(): CaseFormat
    {
        return CaseFormat::MACRO;
    }

    protected static function applySpecificCase(string $string): string
    {
        return str_replace(Str::BASE_DELIMITER, static::getDelimiter(), strtoupper($string));
    }
}
