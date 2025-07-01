<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\Helpers\Str;

class PathCase extends AbstractCase
{
    protected static function caseFormat(): CaseFormat
    {
        return CaseFormat::PATH;
    }

    protected static function applySpecificCase(string $string): string
    {
        return str_replace(Str::BASE_DELIMITER, static::getDelimiter(), strtolower($string));
    }
}
