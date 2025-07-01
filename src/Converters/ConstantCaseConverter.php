<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseConverterInterface;

// Aliases for ScreamedSnakeCase naming conventions
class ConstantCaseConverter implements CaseConverterInterface
{
    public static function convert(string $string): string
    {
        return ScreamedSnakeCaseConverter::convert($string);
    }
}
