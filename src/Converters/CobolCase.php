<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\Helpers\Str;

class CobolCase extends AbstractCase
{
    protected static function caseFormat(): CaseFormat
    {
        return CaseFormat::COBOL;
    }

    protected static function applySpecificCase(string $string): string
    {
        return static::delimited(Str::upper($string));
    }
}
