<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter;

class CaseConverterFluent
{
    public function __construct(private readonly string $string)
    {
    }

    public function toSnakeCase(): string
    {
        return CaseFormat::SNAKE_CASE->convert($this->string);
    }

    public function toScreamedSnakeCase(): string
    {
        return CaseFormat::SCREAMED_SNAKE_CASE->convert($this->string);
    }

    public function toCamelCase(): string
    {
        return CaseFormat::CAMEL_CASE->convert($this->string);
    }

    public function toPascalCase(): string
    {
        return CaseFormat::PASCAL_CASE->convert($this->string);
    }

    public function toKebabCase(): string
    {
        return CaseFormat::KEBAB_CASE->convert($this->string);
    }

    public function toTrainCase(): string
    {
        return CaseFormat::TRAIN_CASE->convert($this->string);
    }

    public function toDotCase(): string
    {
        return CaseFormat::DOT_CASE->convert($this->string);
    }

    public function toSpaceCase(): string
    {
        return CaseFormat::SPACE_CASE->convert($this->string);
    }

    public function toPathCase(): string
    {
        return CaseFormat::PATH_CASE->convert($this->string);
    }

    public function toTitleCase(): string
    {
        return CaseFormat::TITLE_CASE->convert($this->string);
    }

    public function toConstantCase(): string
    {
        return CaseFormat::CONSTANT_CASE->convert($this->string);
    }

    public function to(CaseFormat|string $format): string
    {
        return CaseConverter::convert($this->string, $format);
    }
}
