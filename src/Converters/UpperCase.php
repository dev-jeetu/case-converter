<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\Helpers\Str;

class UpperCase extends AbstractCase
{
    protected static function caseFormat(): CaseFormat
    {
        return CaseFormat::UPPER;
    }

    protected static function applySpecificCase(string $string): string
    {
        return Str::upper($string);
    }
}
