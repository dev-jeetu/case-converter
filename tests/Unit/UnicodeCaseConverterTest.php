<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseConverter;
use DevJeetu\CaseConverter\CaseFormat;
use PHPUnit\Framework\TestCase;

class UnicodeCaseConverterTest extends TestCase
{
    /**
     * @dataProvider unicodeTestCases
     */
    public function testUnicodeSupport(string $input, string $expected, CaseFormat $format): void
    {
        $result = CaseConverter::convert($input, $format);
        $this->assertEquals($expected, $result);
    }

    public function unicodeTestCases(): array
    {
        return [
            // Greek characters
            ['πολύ-Καλό', 'πολύΚαλό', CaseFormat::CAMEL],
            ['πολύ-Καλό', 'ΠολύΚαλό', CaseFormat::PASCAL],
            ['πολύ-Καλό', 'πολύ_καλό', CaseFormat::SNAKE],
            ['πολύ-Καλό', 'πολύ-καλό', CaseFormat::KEBAB],
            ['πολύ-Καλό', 'ΠΟΛΎ_ΚΑΛΌ', CaseFormat::MACRO],
            ['πολύ-Καλό', 'Πολύ-Καλό', CaseFormat::TRAIN],
            ['πολύ-Καλό', 'πολύ.καλό', CaseFormat::DOT],
            ['πολύ-Καλό', 'πολύ καλό', CaseFormat::LOWER],
            ['πολύ-Καλό', 'ΠΟΛΎ ΚΑΛΌ', CaseFormat::UPPER],
            ['πολύ-Καλό', 'Πολύ Καλό', CaseFormat::TITLE],
            ['πολύ-Καλό', 'πολύ/καλό', CaseFormat::PATH],
            ['πολύ-Καλό', 'Πολύ_Καλό', CaseFormat::ADA],
            ['πολύ-Καλό', 'ΠΟΛΎ-ΚΑΛΌ', CaseFormat::COBOL],
            ['πολύ-Καλό', 'Πολύ καλό', CaseFormat::SENTENCE],

            // Russian characters
            ['ОЧЕНЬ_ПРИЯТНО', 'оченьПриятно', CaseFormat::CAMEL],
            ['ОЧЕНЬ_ПРИЯТНО', 'ОченьПриятно', CaseFormat::PASCAL],
            ['ОЧЕНЬ_ПРИЯТНО', 'очень_приятно', CaseFormat::SNAKE],
            ['ОЧЕНЬ_ПРИЯТНО', 'очень-приятно', CaseFormat::KEBAB],
            ['ОЧЕНЬ_ПРИЯТНО', 'ОЧЕНЬ_ПРИЯТНО', CaseFormat::MACRO],
            ['ОЧЕНЬ_ПРИЯТНО', 'Очень-Приятно', CaseFormat::TRAIN],
            ['ОЧЕНЬ_ПРИЯТНО', 'очень.приятно', CaseFormat::DOT],
            ['ОЧЕНЬ_ПРИЯТНО', 'очень приятно', CaseFormat::LOWER],
            ['ОЧЕНЬ_ПРИЯТНО', 'ОЧЕНЬ ПРИЯТНО', CaseFormat::UPPER],
            ['ОЧЕНЬ_ПРИЯТНО', 'Очень Приятно', CaseFormat::TITLE],
            ['ОЧЕНЬ_ПРИЯТНО', 'очень/приятно', CaseFormat::PATH],
            ['ОЧЕНЬ_ПРИЯТНО', 'Очень_Приятно', CaseFormat::ADA],
            ['ОЧЕНЬ_ПРИЯТНО', 'ОЧЕНЬ-ПРИЯТНО', CaseFormat::COBOL],
            ['ОЧЕНЬ_ПРИЯТНО', 'Очень приятно', CaseFormat::SENTENCE],

            // Arabic characters
            ['مرحبا-بالعالم', 'مرحبابالعالم', CaseFormat::CAMEL],
            ['مرحبا-بالعالم', 'مرحبابالعالم', CaseFormat::PASCAL],
            ['مرحبا-بالعالم', 'مرحبا_بالعالم', CaseFormat::SNAKE],
            ['مرحبا-بالعالم', 'مرحبا-بالعالم', CaseFormat::KEBAB],
            ['مرحبا-بالعالم', 'مرحبا_بالعالم', CaseFormat::MACRO],
            ['مرحبا-بالعالم', 'مرحبا-بالعالم', CaseFormat::TRAIN],
            ['مرحبا-بالعالم', 'مرحبا.بالعالم', CaseFormat::DOT],
            ['مرحبا-بالعالم', 'مرحبا بالعالم', CaseFormat::LOWER],
            ['مرحبا-بالعالم', 'مرحبا بالعالم', CaseFormat::UPPER],
            ['مرحبا-بالعالم', 'مرحبا بالعالم', CaseFormat::TITLE],
            ['مرحبا-بالعالم', 'مرحبا/بالعالم', CaseFormat::PATH],
            ['مرحبا-بالعالم', 'مرحبا_بالعالم', CaseFormat::ADA],
            ['مرحبا-بالعالم', 'مرحبا-بالعالم', CaseFormat::COBOL],
            ['مرحبا-بالعالم', 'مرحبا بالعالم', CaseFormat::SENTENCE],

            // Chinese characters
            ['你好-世界', '你好世界', CaseFormat::CAMEL],
            ['你好-世界', '你好世界', CaseFormat::PASCAL],
            ['你好-世界', '你好_世界', CaseFormat::SNAKE],
            ['你好-世界', '你好-世界', CaseFormat::KEBAB],
            ['你好-世界', '你好_世界', CaseFormat::MACRO],
            ['你好-世界', '你好-世界', CaseFormat::TRAIN],
            ['你好-世界', '你好.世界', CaseFormat::DOT],
            ['你好-世界', '你好 世界', CaseFormat::LOWER],
            ['你好-世界', '你好 世界', CaseFormat::UPPER],
            ['你好-世界', '你好 世界', CaseFormat::TITLE],
            ['你好-世界', '你好/世界', CaseFormat::PATH],
            ['你好-世界', '你好_世界', CaseFormat::ADA],
            ['你好-世界', '你好-世界', CaseFormat::COBOL],
            ['你好-世界', '你好 世界', CaseFormat::SENTENCE],

            // Japanese characters
            ['こんにちは-世界', 'こんにちは世界', CaseFormat::CAMEL],
            ['こんにちは-世界', 'こんにちは世界', CaseFormat::PASCAL],
            ['こんにちは-世界', 'こんにちは_世界', CaseFormat::SNAKE],
            ['こんにちは-世界', 'こんにちは-世界', CaseFormat::KEBAB],
            ['こんにちは-世界', 'こんにちは_世界', CaseFormat::MACRO],
            ['こんにちは-世界', 'こんにちは-世界', CaseFormat::TRAIN],
            ['こんにちは-世界', 'こんにちは.世界', CaseFormat::DOT],
            ['こんにちは-世界', 'こんにちは 世界', CaseFormat::LOWER],
            ['こんにちは-世界', 'こんにちは 世界', CaseFormat::UPPER],
            ['こんにちは-世界', 'こんにちは 世界', CaseFormat::TITLE],
            ['こんにちは-世界', 'こんにちは/世界', CaseFormat::PATH],
            ['こんにちは-世界', 'こんにちは_世界', CaseFormat::ADA],
            ['こんにちは-世界', 'こんにちは-世界', CaseFormat::COBOL],
            ['こんにちは-世界', 'こんにちは 世界', CaseFormat::SENTENCE],

            // Mixed Unicode with ASCII
            ['user-имя', 'userИмя', CaseFormat::CAMEL],
            ['user-имя', 'UserИмя', CaseFormat::PASCAL],
            ['user-имя', 'user_имя', CaseFormat::SNAKE],
            ['user-имя', 'user-имя', CaseFormat::KEBAB],
            ['user-имя', 'USER_ИМЯ', CaseFormat::MACRO],
            ['user-имя', 'User-Имя', CaseFormat::TRAIN],
            ['user-имя', 'user.имя', CaseFormat::DOT],
            ['user-имя', 'user имя', CaseFormat::LOWER],
            ['user-имя', 'USER ИМЯ', CaseFormat::UPPER],
            ['user-имя', 'User Имя', CaseFormat::TITLE],
            ['user-имя', 'user/имя', CaseFormat::PATH],
            ['user-имя', 'User_Имя', CaseFormat::ADA],
            ['user-имя', 'USER-ИМЯ', CaseFormat::COBOL],
            ['user-имя', 'User имя', CaseFormat::SENTENCE],
        ];
    }

    public function testUnicodeAcronymHandling(): void
    {
        // Test that Unicode characters don't interfere with acronym detection
        $this->assertEquals('xml_parser_русский', CaseConverter::toSnake('XMLParserРусский'));
        $this->assertEquals('xmlParserРусский', CaseConverter::toCamel('xml_parser_русский'));
        $this->assertEquals('XmlParserРусский', CaseConverter::toPascal('xml_parser_русский'));
    }

    public function testUnicodeEmptyString(): void
    {
        // Test empty string handling with Unicode context
        $this->assertEquals('', CaseConverter::toSnake(''));
        $this->assertEquals('', CaseConverter::toCamel(''));
        $this->assertEquals('', CaseConverter::toPascal(''));
    }

    public function testUnicodeWhitespaceOnly(): void
    {
        // Test whitespace-only strings with Unicode context
        $this->assertEquals('', CaseConverter::toSnake('   '));
        $this->assertEquals('', CaseConverter::toCamel('   '));
        $this->assertEquals('', CaseConverter::toPascal('   '));
    }
} 