<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\Helpers\Str;

class LowerCase extends AbstractCase
{
    protected static function caseFormat(): CaseFormat
    {
        return CaseFormat::LOWER;
    }

    protected static function applySpecificCase(string $string): string
    {
        return Str::lower($string);
    }
}
