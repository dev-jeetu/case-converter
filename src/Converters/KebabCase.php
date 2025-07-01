<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\Helpers\Str;

class KebabCase extends AbstractCase
{
    protected static function caseFormat(): CaseFormat
    {
        return CaseFormat::KEBAB;
    }

    protected static function applySpecificCase(string $string): string
    {
        return str_replace(Str::BASE_DELIMITER, static::getDelimiter(), strtolower($string));
    }
}
