<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter;

use DevJeetu\CaseConverter\Converters\AdaCase;
use DevJeetu\CaseConverter\Converters\CamelCase;
use DevJeetu\CaseConverter\Converters\CobolCase;
use DevJeetu\CaseConverter\Converters\DotCase;
use DevJeetu\CaseConverter\Converters\KebabCase;
use DevJeetu\CaseConverter\Converters\LowerCase;
use DevJeetu\CaseConverter\Converters\MacroCase;
use DevJeetu\CaseConverter\Converters\PascalCase;
use DevJeetu\CaseConverter\Converters\PathCase;
use DevJeetu\CaseConverter\Converters\SentenceCase;
use DevJeetu\CaseConverter\Converters\SnakeCase;
use DevJeetu\CaseConverter\Converters\TitleCase;
use DevJeetu\CaseConverter\Converters\TrainCase;
use DevJeetu\CaseConverter\Converters\UpperCase;
use DevJeetu\CaseConverter\DTOs\CaseFormatInfo;
use InvalidArgumentException;
use RuntimeException;

/**
 * Enum representing different case formats with intuitive names and emojis
 */
enum CaseFormat: string
{
    case CAMEL = 'camel';
    case PASCAL = 'pascal';
    case SNAKE = 'snake';
    case KEBAB = 'kebab';
    case MACRO = 'macro';
    case TRAIN = 'train';
    case DOT = 'dot';
    case LOWER = 'lower';
    case UPPER = 'upper';
    case TITLE = 'title';
    case PATH = 'path';
    case ADA = 'ada';
    case COBOL = 'cobol';
    case SENTENCE = 'sentence';

    public function getDescription(): string
    {
        return match ($this) {
            self::CAMEL => 'First word lowercase, later words capitalized, no separators',
            self::PASCAL => 'All words capitalized, no separators',
            self::SNAKE => 'Lowercase words separated by underscores',
            self::KEBAB => 'Lowercase words separated by hyphens',
            self::MACRO => 'Uppercase words separated by underscores',
            self::TRAIN => 'Capitalized words separated by hyphens',
            self::DOT => 'Lowercase words separated by dots',
            self::LOWER => 'Lowercase words separated by spaces',
            self::UPPER => 'Uppercase words separated by spaces',
            self::TITLE => 'Capitalized words separated by spaces',
            self::PATH => 'Lowercase words separated by forward slashes',
            self::ADA => 'Capitalized words separated by underscores',
            self::COBOL => 'Uppercase words separated by hyphens',
            self::SENTENCE => 'First word capitalized, rest lowercase, separated by spaces',
        };
    }

    public function getExample(): string
    {
        return match ($this) {
            self::CAMEL => 'myNameIsBond',
            self::PASCAL => 'MyNameIsBond',
            self::SNAKE => 'my_name_is_bond',
            self::KEBAB => 'my-name-is-bond',
            self::MACRO => 'MY_NAME_IS_BOND',
            self::TRAIN => 'My-Name-Is-Bond',
            self::DOT => 'my.name.is.bond',
            self::LOWER => 'my name is bond',
            self::UPPER => 'MY NAME IS BOND',
            self::TITLE => 'My Name Is Bond',
            self::PATH => 'my/name/is/bond',
            self::ADA => 'My_Name_Is_Bond',
            self::COBOL => 'MY-NAME-IS-BOND',
            self::SENTENCE => 'My name is bond',
        };
    }

    public function getEmoji(): string
    {
        return match ($this) {
            self::CAMEL => '🐪',
            self::PASCAL => '👨🏫',
            self::SNAKE => '🐍',
            self::KEBAB => '🥙',
            self::MACRO => '🔧',
            self::TRAIN => '🚂',
            self::DOT => '⚙️',
            self::LOWER => '🔡',
            self::UPPER => '🔠',
            self::TITLE => '📰',
            self::PATH => '📁',
            self::ADA => '👩🏫',
            self::COBOL => '🏦',
            self::SENTENCE => '✍️',
        };
    }

    /**
     * Get all possible aliases for this case format
     *
     * @return array<string>
     */
    public function getAliases(): array
    {
        return match ($this) {
            self::CAMEL => ['camel', 'camelcase', 'camel_case', 'lower_camel', 'lowerCamel'],
            self::PASCAL => ['pascal', 'pascalcase', 'pascal_case', 'upper_camel', 'upperCamel', 'studly'],
            self::SNAKE => ['snake', 'snake_case', 'underscore', 'lower_snake'],
            self::KEBAB => ['kebab', 'kebab_case', 'kebab-case', 'dash', 'hyphen', 'lisp'],
            self::MACRO => ['macro', 'macro_case', 'screamed_snake', 'screaming_snake', 'upper_snake', 'constant'],
            self::TRAIN => ['train', 'train_case', 'train-case', 'pascal_kebab', 'pascal-kebab'],
            self::DOT => ['dot', 'dot_case', 'dot.case', 'period'],
            self::LOWER => ['lower', 'lower_case', 'space', 'space_case', 'lower_space'],
            self::UPPER => ['upper', 'upper_case', 'upper_space'],
            self::TITLE => ['title', 'title_case', 'start_case', 'header'],
            self::PATH => ['path', 'path_case', 'path/case', 'slash', 'directory'],
            self::ADA => ['ada', 'ada_case', 'pascal_snake', 'upper_snake_case'],
            self::COBOL => ['cobol', 'cobol_case', 'upper_kebab', 'screaming_kebab'],
            self::SENTENCE => ['sentence', 'sentence_case', 'first_upper'],
        };
    }

    public function getConverterClass(): string
    {
        return match ($this) {
            self::CAMEL => CamelCase::class,
            self::PASCAL => PascalCase::class,
            self::SNAKE => SnakeCase::class,
            self::KEBAB => KebabCase::class,
            self::MACRO => MacroCase::class,
            self::TRAIN => TrainCase::class,
            self::DOT => DotCase::class,
            self::LOWER => LowerCase::class,
            self::UPPER => UpperCase::class,
            self::TITLE => TitleCase::class,
            self::PATH => PathCase::class,
            self::ADA => AdaCase::class,
            self::COBOL => CobolCase::class,
            self::SENTENCE => SentenceCase::class,
        };
    }

    public function getDelimiter(): string
    {
        return match ($this) {
            self::CAMEL, self::PASCAL => '',
            self::SNAKE, self::MACRO, self::ADA => '_',
            self::KEBAB, self::TRAIN, self::COBOL => '-',
            self::DOT => '.',
            self::LOWER, self::UPPER, self::TITLE, self::SENTENCE => ' ',
            self::PATH => '/',
        };
    }

    public function isCapitalized(): bool
    {
        return match ($this) {
            self::PASCAL, self::TRAIN, self::TITLE, self::ADA, self::SENTENCE,
            self::UPPER, self::MACRO, self::COBOL => true,
            default => false,
        };
    }

    public function isUppercase(): bool
    {
        return match ($this) {
            self::UPPER, self::MACRO, self::COBOL => true,
            default => false,
        };
    }

    public function isLowercase(): bool
    {
        return match ($this) {
            self::CAMEL, self::SNAKE, self::KEBAB, self::DOT, self::LOWER, self::PATH => true,
            default => false,
        };
    }

    /**
     * Convert a string using this case format
     */
    public function convert(string $input): string
    {
        $converterClass = $this->getConverterClass();

        if (! class_exists($converterClass)) {
            throw new RuntimeException("Converter class not found: $converterClass");
        }

        return $converterClass::convert($input);
    }

    /**
     * Create a CaseFormat from a string (case-insensitive)
     */
    public static function fromString(string $format): self
    {
        $format = strtolower(trim($format));
        foreach (self::cases() as $case) {
            if ($case->value === $format) {
                return $case;
            }
        }

        foreach (self::cases() as $case) {
            if (in_array($format, array_map('strtolower', $case->getAliases()), true)) {
                return $case;
            }
        }

        throw new InvalidArgumentException("Unsupported format: $format");
    }

    /**
     * @return array<string>
     */
    public static function getSupportedNames(): array
    {
        return array_map(fn (self $case) => $case->value, self::cases());
    }

    /**
     * Get all supported aliases (flattened)
     *
     * @return array<string>
     */
    public static function getAllAliases(): array
    {
        $aliases = [];
        foreach (self::cases() as $case) {
            $aliases = array_merge($aliases, $case->getAliases());
        }

        return array_unique($aliases);
    }

    public static function isSupported(string $format): bool
    {
        try {
            self::fromString($format);

            return true;
        } catch (InvalidArgumentException) {
            return false;
        }
    }

    public function getInfo(): CaseFormatInfo
    {
        return new CaseFormatInfo(
            $this->value,
            $this->getEmoji(),
            $this->getDescription(),
            $this->getExample(),
            $this->getDelimiter(),
            $this->getAliases(),
            $this->getConverterClass(),
            $this->isCapitalized(),
            $this->isUppercase(),
            $this->isLowercase()
        );
    }

    public function getDisplayName(): string
    {
        return $this->getEmoji() . ' ' . ucfirst($this->value) . ' case';
    }
}
