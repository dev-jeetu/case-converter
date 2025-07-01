<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\Contracts\StringCaseConverterInterface;
use DevJeetu\CaseConverter\Helpers\Str;

abstract class AbstractCase implements StringCaseConverterInterface
{
    /**
     * Forces each concrete converter to declare which CaseFormat enum member it represents.
     * This method must be implemented by all subclasses.
     */
    abstract protected static function caseFormat(): CaseFormat;

    /**
     * Applies the final, specific casing logic to the string.
     * This method is implemented by concrete subclasses (e.g., to lowerCamelCase, snake_case).
     */
    abstract protected static function applySpecificCase(string $string): string;

    /**
     * Provides the delimiter for the current converter based on its associated CaseFormat.
     * Concrete converters no longer need to implement this.
     */
    final protected static function getDelimiter(): string
    {
        return static::caseFormat()->getDelimiter();
    }

    /**
     * The final implementation of the conversion pipeline.
     * This method orchestrates the common steps and delegates the final formatting.
     * Making it final ensures the core conversion process is consistent across all converters.
     */
    final public static function convert(string $input): string
    {
        $baseInput = Str::convert($input);

        if ($baseInput === '') {
            return '';
        }

        return static::applySpecificCase($baseInput);
    }
}
