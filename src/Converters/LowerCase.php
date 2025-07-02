<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseType;
use DevJeetu\CaseConverter\Helpers\Str;

class LowerCase extends AbstractCase
{
    protected static function caseType(): CaseType
    {
        return CaseType::LOWER;
    }

    protected static function applySpecificCase(string $string): string
    {
        return Str::lower($string);
    }
}
