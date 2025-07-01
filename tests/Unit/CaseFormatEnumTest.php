<?php

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseFormat;
use DevJeetu\CaseConverter\Exceptions\UnsupportedFormatException;
use PHPUnit\Framework\TestCase;

class CaseFormatEnumTest extends TestCase
{
    public function testEnumValues(): void
    {
        $this->assertEquals('camel', CaseFormat::CAMEL->value);
        $this->assertEquals('pascal', CaseFormat::PASCAL->value);
        $this->assertEquals('snake', CaseFormat::SNAKE->value);
        $this->assertEquals('kebab', CaseFormat::KEBAB->value);
        $this->assertEquals('macro', CaseFormat::MACRO->value);
        $this->assertEquals('train', CaseFormat::TRAIN->value);
        $this->assertEquals('dot', CaseFormat::DOT->value);
        $this->assertEquals('lower', CaseFormat::LOWER->value);
        $this->assertEquals('upper', CaseFormat::UPPER->value);
        $this->assertEquals('title', CaseFormat::TITLE->value);
        $this->assertEquals('path', CaseFormat::PATH->value);
        $this->assertEquals('ada', CaseFormat::ADA->value);
        $this->assertEquals('cobol', CaseFormat::COBOL->value);
        $this->assertEquals('sentence', CaseFormat::SENTENCE->value);
    }

    public function testEnumConvert(): void
    {
        $input = 'userName';

        $this->assertEquals('userName', CaseFormat::CAMEL->convert($input));
        $this->assertEquals('UserName', CaseFormat::PASCAL->convert($input));
        $this->assertEquals('user_name', CaseFormat::SNAKE->convert($input));
        $this->assertEquals('user-name', CaseFormat::KEBAB->convert($input));
        $this->assertEquals('USER_NAME', CaseFormat::MACRO->convert($input));
        $this->assertEquals('User-Name', CaseFormat::TRAIN->convert($input));
        $this->assertEquals('user.name', CaseFormat::DOT->convert($input));
        $this->assertEquals('user name', CaseFormat::LOWER->convert($input));
        $this->assertEquals('USER NAME', CaseFormat::UPPER->convert($input));
        $this->assertEquals('User Name', CaseFormat::TITLE->convert($input));
        $this->assertEquals('user/name', CaseFormat::PATH->convert($input));
        $this->assertEquals('User_Name', CaseFormat::ADA->convert($input));
        $this->assertEquals('USER-NAME', CaseFormat::COBOL->convert($input));
        $this->assertEquals('User name', CaseFormat::SENTENCE->convert($input));
    }

    public function testEnumFromString(): void
    {
        foreach (CaseFormat::cases() as $case) {
            foreach ($case->getAliases() as $alias) {
                $this->assertEquals(
                    $case,
                    CaseFormat::fromString($alias),
                    "Failed asserting that alias '{$alias}' resolves to {$case->name}"
                );
            }
        }
    }


    public function testEnumFromStringThrowsException(): void
    {
        $this->expectException(UnsupportedFormatException::class);
        $this->expectExceptionMessage('Unsupported format: \'invalid_format\'. Supported formats: camel, pascal, snake, kebab, macro, train, dot, lower, upper, title, path, ada, cobol, sentence');

        CaseFormat::fromString('invalid_format');
    }

    public function testEnumGetAliases(): void
    {
        $aliases = CaseFormat::SNAKE->getAliases();
        $this->assertContains('snake', $aliases);
        $this->assertContains('snake_case', $aliases);
        $this->assertContains('underscore', $aliases);

        $kebabAliases = CaseFormat::KEBAB->getAliases();
        $this->assertContains('kebab', $kebabAliases);
        $this->assertContains('dash', $kebabAliases);
        $this->assertContains('hyphen', $kebabAliases);
    }

    public function testEnumGetExample(): void
    {
        $this->assertEquals('myNameIsBond', CaseFormat::CAMEL->getExample());
        $this->assertEquals('MyNameIsBond', CaseFormat::PASCAL->getExample());
        $this->assertEquals('my_name_is_bond', CaseFormat::SNAKE->getExample());
        $this->assertEquals('my-name-is-bond', CaseFormat::KEBAB->getExample());
        $this->assertEquals('MY_NAME_IS_BOND', CaseFormat::MACRO->getExample());
        $this->assertEquals('My-Name-Is-Bond', CaseFormat::TRAIN->getExample());
        $this->assertEquals('my.name.is.bond', CaseFormat::DOT->getExample());
        $this->assertEquals('my name is bond', CaseFormat::LOWER->getExample());
        $this->assertEquals('MY NAME IS BOND', CaseFormat::UPPER->getExample());
        $this->assertEquals('My Name Is Bond', CaseFormat::TITLE->getExample());
        $this->assertEquals('my/name/is/bond', CaseFormat::PATH->getExample());
        $this->assertEquals('My_Name_Is_Bond', CaseFormat::ADA->getExample());
        $this->assertEquals('MY-NAME-IS-BOND', CaseFormat::COBOL->getExample());
        $this->assertEquals('My name is bond', CaseFormat::SENTENCE->getExample());
    }

    public function testEnumGetDescription(): void
    {
        $this->assertStringContainsString('Lowercase', CaseFormat::SNAKE->getDescription());
        $this->assertStringContainsString('Uppercase', CaseFormat::MACRO->getDescription());
        $this->assertStringContainsString('capitalized', CaseFormat::PASCAL->getDescription());
    }

    public function testEnumGetConverterClass(): void
    {
        $this->assertEquals(
            'DevJeetu\CaseConverter\Converters\SnakeCase',
            CaseFormat::SNAKE->getConverterClass()
        );
        $this->assertEquals(
            'DevJeetu\CaseConverter\Converters\CamelCase',
            CaseFormat::CAMEL->getConverterClass()
        );
    }
}
