<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\BaseCaseConverter;
use DevJeetu\CaseConverter\CaseConverterInterface;

class TrainCaseConverter implements CaseConverterInterface
{
    public static function convert(string $string): string
    {
        $result = BaseCaseConverter::convert($string, '-');
        $words = explode('-', $result);

        return implode('-', array_map('ucfirst', $words));
    }
}
