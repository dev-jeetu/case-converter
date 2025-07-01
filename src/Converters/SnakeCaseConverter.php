<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\BaseCaseConverter;
use DevJeetu\CaseConverter\CaseConverterInterface;

class SnakeCaseConverter implements CaseConverterInterface
{
    public static function convert(string $string): string
    {
        return strtolower(BaseCaseConverter::convert($string, '_'));
    }
}
