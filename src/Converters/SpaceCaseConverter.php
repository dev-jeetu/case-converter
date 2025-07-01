<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseConverterInterface;

class SpaceCaseConverter implements CaseConverterInterface
{
    public static function convert(string $string): string
    {
        return str_replace('_', ' ', SnakeCaseConverter::convert($string));
    }
}
