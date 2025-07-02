<?php

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseType;
use DevJeetu\CaseConverter\Exceptions\UnsupportedFormatException;
use PHPUnit\Framework\TestCase;

class CaseTypeEnumTest extends TestCase
{
    public function testEnumValues(): void
    {
        $this->assertEquals('camel', CaseType::CAMEL->value);
        $this->assertEquals('pascal', CaseType::PASCAL->value);
        $this->assertEquals('snake', CaseType::SNAKE->value);
        $this->assertEquals('kebab', CaseType::KEBAB->value);
        $this->assertEquals('macro', CaseType::MACRO->value);
        $this->assertEquals('train', CaseType::TRAIN->value);
        $this->assertEquals('dot', CaseType::DOT->value);
        $this->assertEquals('lower', CaseType::LOWER->value);
        $this->assertEquals('upper', CaseType::UPPER->value);
        $this->assertEquals('title', CaseType::TITLE->value);
        $this->assertEquals('path', CaseType::PATH->value);
        $this->assertEquals('ada', CaseType::ADA->value);
        $this->assertEquals('cobol', CaseType::COBOL->value);
        $this->assertEquals('sentence', CaseType::SENTENCE->value);
    }

    public function testEnumConvert(): void
    {
        $input = 'userName';

        $this->assertEquals('userName', CaseType::CAMEL->convert($input));
        $this->assertEquals('UserName', CaseType::PASCAL->convert($input));
        $this->assertEquals('user_name', CaseType::SNAKE->convert($input));
        $this->assertEquals('user-name', CaseType::KEBAB->convert($input));
        $this->assertEquals('USER_NAME', CaseType::MACRO->convert($input));
        $this->assertEquals('User-Name', CaseType::TRAIN->convert($input));
        $this->assertEquals('user.name', CaseType::DOT->convert($input));
        $this->assertEquals('user name', CaseType::LOWER->convert($input));
        $this->assertEquals('USER NAME', CaseType::UPPER->convert($input));
        $this->assertEquals('User Name', CaseType::TITLE->convert($input));
        $this->assertEquals('user/name', CaseType::PATH->convert($input));
        $this->assertEquals('User_Name', CaseType::ADA->convert($input));
        $this->assertEquals('USER-NAME', CaseType::COBOL->convert($input));
        $this->assertEquals('User name', CaseType::SENTENCE->convert($input));
    }

    public function testEnumFromString(): void
    {
        foreach (CaseType::cases() as $case) {
            foreach ($case->getAliases() as $alias) {
                $this->assertEquals(
                    $case,
                    CaseType::fromString($alias),
                    "Failed asserting that alias '{$alias}' resolves to {$case->name}"
                );
            }
        }
    }


    public function testEnumFromStringThrowsException(): void
    {
        $this->expectException(UnsupportedFormatException::class);
        $this->expectExceptionMessage('Unsupported format: \'invalid_format\'. Supported formats: camel, pascal, snake, kebab, macro, train, dot, lower, upper, title, path, ada, cobol, sentence');

        CaseType::fromString('invalid_format');
    }

    public function testEnumGetAliases(): void
    {
        $aliases = CaseType::SNAKE->getAliases();
        $this->assertContains('snake', $aliases);
        $this->assertContains('snake_case', $aliases);
        $this->assertContains('underscore', $aliases);

        $kebabAliases = CaseType::KEBAB->getAliases();
        $this->assertContains('kebab', $kebabAliases);
        $this->assertContains('dash', $kebabAliases);
        $this->assertContains('hyphen', $kebabAliases);
    }

    public function testEnumGetExample(): void
    {
        $this->assertEquals('myNameIsBond', CaseType::CAMEL->getExample());
        $this->assertEquals('MyNameIsBond', CaseType::PASCAL->getExample());
        $this->assertEquals('my_name_is_bond', CaseType::SNAKE->getExample());
        $this->assertEquals('my-name-is-bond', CaseType::KEBAB->getExample());
        $this->assertEquals('MY_NAME_IS_BOND', CaseType::MACRO->getExample());
        $this->assertEquals('My-Name-Is-Bond', CaseType::TRAIN->getExample());
        $this->assertEquals('my.name.is.bond', CaseType::DOT->getExample());
        $this->assertEquals('my name is bond', CaseType::LOWER->getExample());
        $this->assertEquals('MY NAME IS BOND', CaseType::UPPER->getExample());
        $this->assertEquals('My Name Is Bond', CaseType::TITLE->getExample());
        $this->assertEquals('my/name/is/bond', CaseType::PATH->getExample());
        $this->assertEquals('My_Name_Is_Bond', CaseType::ADA->getExample());
        $this->assertEquals('MY-NAME-IS-BOND', CaseType::COBOL->getExample());
        $this->assertEquals('My name is bond', CaseType::SENTENCE->getExample());
    }

    public function testEnumGetDescription(): void
    {
        $this->assertStringContainsString('Lowercase', CaseType::SNAKE->getDescription());
        $this->assertStringContainsString('Uppercase', CaseType::MACRO->getDescription());
        $this->assertStringContainsString('capitalized', CaseType::PASCAL->getDescription());
    }

    public function testEnumGetConverterClass(): void
    {
        $this->assertEquals(
            'DevJeetu\CaseConverter\Converters\SnakeCase',
            CaseType::SNAKE->getConverterClass()
        );
        $this->assertEquals(
            'DevJeetu\CaseConverter\Converters\CamelCase',
            CaseType::CAMEL->getConverterClass()
        );
    }
}
