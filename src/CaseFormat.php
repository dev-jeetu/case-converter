<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter;

use DevJeetu\CaseConverter\Converters\CamelCaseConverter;
use DevJeetu\CaseConverter\Converters\ConstantCaseConverter;
use DevJeetu\CaseConverter\Converters\DotCaseConverter;
use DevJeetu\CaseConverter\Converters\KebabCaseConverter;
use DevJeetu\CaseConverter\Converters\PascalCaseConverter;
use DevJeetu\CaseConverter\Converters\PathCaseConverter;
use DevJeetu\CaseConverter\Converters\ScreamedSnakeCaseConverter;
use DevJeetu\CaseConverter\Converters\SnakeCaseConverter;
use DevJeetu\CaseConverter\Converters\SpaceCaseConverter;
use DevJeetu\CaseConverter\Converters\TitleCaseConverter;
use DevJeetu\CaseConverter\Converters\TrainCaseConverter;

/**
 * Enum representing all supported case formats
 */
enum CaseFormat: string
{
    case SNAKE_CASE = 'snake_case';
    case SCREAMED_SNAKE_CASE = 'SCREAMED_SNAKE_CASE';
    case CAMEL_CASE = 'camelCase';
    case PASCAL_CASE = 'PascalCase';
    case KEBAB_CASE = 'kebab-case';
    case TRAIN_CASE = 'Train-Case';
    case DOT_CASE = 'dot.case';
    case SPACE_CASE = 'space case';
    case PATH_CASE = 'path/case';
    case TITLE_CASE = 'Title Case';
    case CONSTANT_CASE = 'CONSTANT_CASE';

    /**
     * Get the converter class for this format
     */
    public function getConverterClass(): string
    {
        return match ($this) {
            self::SNAKE_CASE => SnakeCaseConverter::class,
            self::SCREAMED_SNAKE_CASE => ScreamedSnakeCaseConverter::class,
            self::CAMEL_CASE => CamelCaseConverter::class,
            self::PASCAL_CASE => PascalCaseConverter::class,
            self::KEBAB_CASE => KebabCaseConverter::class,
            self::TRAIN_CASE => TrainCaseConverter::class,
            self::DOT_CASE => DotCaseConverter::class,
            self::SPACE_CASE => SpaceCaseConverter::class,
            self::PATH_CASE => PathCaseConverter::class,
            self::TITLE_CASE => TitleCaseConverter::class,
            self::CONSTANT_CASE => ConstantCaseConverter::class,
        };
    }

    /**
     * Convert string using this format
     */
    public function convert(string $string): string
    {
        $converterClass = $this->getConverterClass();

        return $converterClass::convert($string);
    }

    /**
     * Get all possible aliases for this format
     *
     * @return array<string>
     */
    public function getAliases(): array
    {
        return match ($this) {
            self::SNAKE_CASE => ['snake', 'snake_case', 'underscore'],
            self::SCREAMED_SNAKE_CASE => ['screamed', 'screamed_snake', 'screaming_snake', 'upper_snake', 'macro'],
            self::CAMEL_CASE => ['camel', 'camelcase', 'lower_camel'],
            self::PASCAL_CASE => ['pascal', 'pascalcase', 'upper_camel', 'studly'],
            self::KEBAB_CASE => ['kebab', 'kebab-case', 'dash', 'hyphen', 'lisp'],
            self::TRAIN_CASE => ['train', 'train-case', 'pascal-kebab'],
            self::DOT_CASE => ['dot', 'dot.case', 'period'],
            self::SPACE_CASE => ['space', 'space case', 'lower space'],
            self::PATH_CASE => ['path', 'path/case', 'slash', 'directory'],
            self::TITLE_CASE => ['title', 'title case', 'start case'],
            self::CONSTANT_CASE => ['constant', 'upper', 'macro', 'screaming'],
        };
    }

    /**
     * Find a format by string (case-insensitive with alias support)
     */
    public static function fromString(string $format): self
    {
        $format = strtolower(trim($format));
        foreach (self::cases() as $case) {
            if (strtolower($case->value) === $format) {
                return $case;
            }
        }

        foreach (self::cases() as $case) {
            if (in_array($format, array_map('strtolower', $case->getAliases()), true)) {
                return $case;
            }
        }

        throw new \InvalidArgumentException("Unsupported format: $format");
    }

    /**
     * Get example output for this format
     */
    public function getExample(): string
    {
        return $this->convert('userName');
    }

    /**
     * Get a description of this format
     */
    public function getDescription(): string
    {
        return match ($this) {
            self::SNAKE_CASE => 'Lowercase words separated by underscores',
            self::SCREAMED_SNAKE_CASE => 'Uppercase words separated by underscores',
            self::CAMEL_CASE => 'First word lowercase, subsequent words capitalized, no separators',
            self::PASCAL_CASE => 'All words capitalized, no separators',
            self::KEBAB_CASE => 'Lowercase words separated by hyphens',
            self::TRAIN_CASE => 'Capitalized words separated by hyphens',
            self::DOT_CASE => 'Lowercase words separated by dots',
            self::SPACE_CASE => 'Lowercase words separated by spaces',
            self::PATH_CASE => 'Lowercase words separated by forward slashes',
            self::TITLE_CASE => 'Capitalized words separated by spaces',
            self::CONSTANT_CASE => 'Uppercase words separated by underscores (alias for SCREAMED_SNAKE_CASE)',
        };
    }
}
