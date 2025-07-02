<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseType;
use DevJeetu\CaseConverter\Helpers\Str;

class DotCase extends AbstractCase
{
    protected static function caseType(): CaseType
    {
        return CaseType::DOT;
    }

    protected static function applySpecificCase(string $string): string
    {
        return static::delimited(Str::lower($string));
    }
}
