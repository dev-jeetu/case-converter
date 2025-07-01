<?php

namespace DevJeetu\CaseConverter\Contracts;

interface StringCaseConverterInterface
{
    /**
     * Converts a given string to a specific case format.
     */
    public static function convert(string $input): string;
}
