<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseFormat;

class UpperCase extends AbstractCase
{
    protected static function caseFormat(): CaseFormat
    {
        return CaseFormat::UPPER;
    }

    protected static function applySpecificCase(string $string): string
    {
        return strtoupper($string);
    }
}
