<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseType;
use DevJeetu\CaseConverter\Helpers\Str;

class UpperCase extends AbstractCase
{
    protected static function caseType(): CaseType
    {
        return CaseType::UPPER;
    }

    protected static function applySpecificCase(string $string): string
    {
        return Str::upper($string);
    }
}
