<?php

namespace DevJeetu\CaseConverter\Converters;

use DevJeetu\CaseConverter\CaseType;
use DevJeetu\CaseConverter\Contracts\StringCaseConverterInterface;
use DevJeetu\CaseConverter\Helpers\Str;

abstract class AbstractCase implements StringCaseConverterInterface
{
    /**
     * Forces each concrete converter to declare which CaseType enum member it represents.
     * This method must be implemented by all subclasses.
     */
    abstract protected static function caseType(): CaseType;

    /**
     * Applies the final, specific casing logic to the string.
     * This method is implemented by concrete subclasses (e.g., to lowerCamelCase, snake_case).
     */
    abstract protected static function applySpecificCase(string $string): string;

    /**
     * Provides the delimiter for the current converter based on its associated CaseType.
     * Concrete converters no longer need to implement this.
     */
    final protected static function getDelimiter(): string
    {
        return static::caseType()->getDelimiter();
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

    protected static function delimited(string $string): string
    {
        return str_replace(
            Str::BASE_DELIMITER,
            static::getDelimiter(),
            $string
        );
    }
}
