<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseConverterInterface;

class ScreamedSnakeCaseConverter implements CaseConverterInterface
{
    public static function convert(string $string): string
    {
        return strtoupper(SnakeCaseConverter::convert($string));
    }
}
