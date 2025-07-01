<?php

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseFormat;
use PHPUnit\Framework\TestCase;

class CaseFormatEnumTest extends TestCase
{
    public function testEnumValues(): void
    {
        $this->assertEquals('snake_case', CaseFormat::SNAKE_CASE->value);
        $this->assertEquals('SCREAMED_SNAKE_CASE', CaseFormat::SCREAMED_SNAKE_CASE->value);
        $this->assertEquals('camelCase', CaseFormat::CAMEL_CASE->value);
        $this->assertEquals('PascalCase', CaseFormat::PASCAL_CASE->value);
        $this->assertEquals('kebab-case', CaseFormat::KEBAB_CASE->value);
    }

    public function testEnumConvert(): void
    {
        $input = 'userName';

        $this->assertEquals('user_name', CaseFormat::SNAKE_CASE->convert($input));
        $this->assertEquals('USER_NAME', CaseFormat::SCREAMED_SNAKE_CASE->convert($input));
        $this->assertEquals('userName', CaseFormat::CAMEL_CASE->convert($input));
        $this->assertEquals('UserName', CaseFormat::PASCAL_CASE->convert($input));
        $this->assertEquals('user-name', CaseFormat::KEBAB_CASE->convert($input));
    }

    public function testEnumFromString(): void
    {
        $this->assertEquals(CaseFormat::SNAKE_CASE, CaseFormat::fromString('snake'));
        $this->assertEquals(CaseFormat::SNAKE_CASE, CaseFormat::fromString('snake_case'));
        $this->assertEquals(CaseFormat::SNAKE_CASE, CaseFormat::fromString('underscore'));

        $this->assertEquals(CaseFormat::KEBAB_CASE, CaseFormat::fromString('kebab'));
        $this->assertEquals(CaseFormat::KEBAB_CASE, CaseFormat::fromString('kebab-case'));
        $this->assertEquals(CaseFormat::KEBAB_CASE, CaseFormat::fromString('dash'));
        $this->assertEquals(CaseFormat::KEBAB_CASE, CaseFormat::fromString('hyphen'));
    }

    public function testEnumFromStringThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported format: invalid_format');

        CaseFormat::fromString('invalid_format');
    }

    public function testEnumGetAliases(): void
    {
        $aliases = CaseFormat::SNAKE_CASE->getAliases();
        $this->assertContains('snake', $aliases);
        $this->assertContains('snake_case', $aliases);
        $this->assertContains('underscore', $aliases);

        $kebabAliases = CaseFormat::KEBAB_CASE->getAliases();
        $this->assertContains('kebab', $kebabAliases);
        $this->assertContains('dash', $kebabAliases);
        $this->assertContains('hyphen', $kebabAliases);
    }

    public function testEnumGetExample(): void
    {
        $this->assertEquals('user_name', CaseFormat::SNAKE_CASE->getExample());
        $this->assertEquals('USER_NAME', CaseFormat::SCREAMED_SNAKE_CASE->getExample());
        $this->assertEquals('userName', CaseFormat::CAMEL_CASE->getExample());
        $this->assertEquals('UserName', CaseFormat::PASCAL_CASE->getExample());
    }

    public function testEnumGetDescription(): void
    {
        $this->assertStringContainsString('Lowercase', CaseFormat::SNAKE_CASE->getDescription());
        $this->assertStringContainsString('Uppercase', CaseFormat::SCREAMED_SNAKE_CASE->getDescription());
        $this->assertStringContainsString('capitalized', CaseFormat::PASCAL_CASE->getDescription());
    }

    public function testEnumGetConverterClass(): void
    {
        $this->assertEquals(
            'DevJeetu\CaseConverter\Converters\SnakeCaseConverter',
            CaseFormat::SNAKE_CASE->getConverterClass()
        );
        $this->assertEquals(
            'DevJeetu\CaseConverter\Converters\CamelCaseConverter',
            CaseFormat::CAMEL_CASE->getConverterClass()
        );
    }
}
