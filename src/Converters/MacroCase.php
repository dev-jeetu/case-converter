<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseType;
use DevJeetu\CaseConverter\Helpers\Str;

class MacroCase extends AbstractCase
{
    protected static function caseType(): CaseType
    {
        return CaseType::MACRO;
    }

    protected static function applySpecificCase(string $string): string
    {
        return static::delimited(Str::upper($string));
    }
}
