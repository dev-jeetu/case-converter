<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter;

/**
 * Main facade class for case conversion operations
 *
 * Provides a simple, fluent API for converting between different naming conventions.
 *
 * @author Jeetu
 */
class CaseConverter
{
    public static function toSnakeCase(string $string): string
    {
        return CaseFormat::SNAKE_CASE->convert($string);
    }

    public static function toScreamedSnakeCase(string $string): string
    {
        return CaseFormat::SCREAMED_SNAKE_CASE->convert($string);
    }

    public static function toCamelCase(string $string): string
    {
        return CaseFormat::CAMEL_CASE->convert($string);
    }

    public static function toPascalCase(string $string): string
    {
        return CaseFormat::PASCAL_CASE->convert($string);
    }

    public static function toKebabCase(string $string): string
    {
        return CaseFormat::KEBAB_CASE->convert($string);
    }

    public static function toTrainCase(string $string): string
    {
        return CaseFormat::TRAIN_CASE->convert($string);
    }

    public static function toDotCase(string $string): string
    {
        return CaseFormat::DOT_CASE->convert($string);
    }


    public static function toSpaceCase(string $string): string
    {
        return CaseFormat::SPACE_CASE->convert($string);
    }


    public static function toPathCase(string $string): string
    {
        return CaseFormat::PATH_CASE->convert($string);
    }


    public static function toTitleCase(string $string): string
    {
        return CaseFormat::TITLE_CASE->convert($string);
    }


    public static function toConstantCase(string $string): string
    {
        return CaseFormat::CONSTANT_CASE->convert($string);
    }

    public static function convert(string $string, CaseFormat|string $format): string
    {
        if ($format instanceof CaseFormat) {
            return $format->convert($string);
        }

        return CaseFormat::fromString($format)->convert($string);
    }


    /**
     * @return array<CaseFormat>
     */
    public static function getSupportedFormats(): array
    {
        return CaseFormat::cases();
    }

    /**
     * @return array<string>
     */
    public static function getSupportedFormatNames(): array
    {
        return array_map(fn (CaseFormat $format) => $format->value, CaseFormat::cases());
    }

    /**
     * @return array<string>
     */
    public static function getSupportedAliases(): array
    {
        $aliases = [];
        foreach (CaseFormat::cases() as $format) {
            $aliases = array_merge($aliases, $format->getAliases());
        }

        return array_unique($aliases);
    }

    public static function isFormatSupported(string $format): bool
    {
        try {
            CaseFormat::fromString($format);

            return true;
        } catch (\InvalidArgumentException) {
            return false;
        }
    }

    /**
     * @return array{name: string, description: string, example: string, aliases: array<string>, converter_class: string}
     */
    public static function getFormatInfo(CaseFormat|string $format): array
    {
        if (is_string($format)) {
            $format = CaseFormat::fromString($format);
        }

        return [
            'name' => $format->value,
            'description' => $format->getDescription(),
            'example' => $format->getExample(),
            'aliases' => $format->getAliases(),
            'converter_class' => $format->getConverterClass(),
        ];
    }

    public static function from(string $string): CaseConverterFluent
    {
        return new CaseConverterFluent($string);
    }
}
