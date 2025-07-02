<?php

declare(strict_types=1);

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseType;
use DevJeetu\CaseConverter\Converter;
use PHPUnit\Framework\TestCase;

class UnicodeCaseConverterTest extends TestCase
{
    /**
     * @dataProvider unicodeTestCases
     */
    public function testUnicodeSupport(string $input, string $expected, CaseType $format): void
    {
        $result = Converter::convert($input, $format);
        $this->assertEquals($expected, $result);
    }

    /**
     * @return list<array{string, string, CaseType}>
     */
    public static function unicodeTestCases(): array
    {
        return [
            // Greek characters
            ['πολύ-Καλό', 'πολύΚαλό', CaseType::CAMEL],
            ['πολύ-Καλό', 'ΠολύΚαλό', CaseType::PASCAL],
            ['πολύ-Καλό', 'πολύ_καλό', CaseType::SNAKE],
            ['πολύ-Καλό', 'πολύ-καλό', CaseType::KEBAB],
            ['πολύ-Καλό', 'ΠΟΛΎ_ΚΑΛΌ', CaseType::MACRO],
            ['πολύ-Καλό', 'Πολύ-Καλό', CaseType::TRAIN],
            ['πολύ-Καλό', 'πολύ.καλό', CaseType::DOT],
            ['πολύ-Καλό', 'πολύ καλό', CaseType::LOWER],
            ['πολύ-Καλό', 'ΠΟΛΎ ΚΑΛΌ', CaseType::UPPER],
            ['πολύ-Καλό', 'Πολύ Καλό', CaseType::TITLE],
            ['πολύ-Καλό', 'πολύ/καλό', CaseType::PATH],
            ['πολύ-Καλό', 'Πολύ_Καλό', CaseType::ADA],
            ['πολύ-Καλό', 'ΠΟΛΎ-ΚΑΛΌ', CaseType::COBOL],
            ['πολύ-Καλό', 'Πολύ καλό', CaseType::SENTENCE],

            // Russian characters
            ['ОЧЕНЬ_ПРИЯТНО', 'оченьПриятно', CaseType::CAMEL],
            ['ОЧЕНЬ_ПРИЯТНО', 'ОченьПриятно', CaseType::PASCAL],
            ['ОЧЕНЬ_ПРИЯТНО', 'очень_приятно', CaseType::SNAKE],
            ['ОЧЕНЬ_ПРИЯТНО', 'очень-приятно', CaseType::KEBAB],
            ['ОЧЕНЬ_ПРИЯТНО', 'ОЧЕНЬ_ПРИЯТНО', CaseType::MACRO],
            ['ОЧЕНЬ_ПРИЯТНО', 'Очень-Приятно', CaseType::TRAIN],
            ['ОЧЕНЬ_ПРИЯТНО', 'очень.приятно', CaseType::DOT],
            ['ОЧЕНЬ_ПРИЯТНО', 'очень приятно', CaseType::LOWER],
            ['ОЧЕНЬ_ПРИЯТНО', 'ОЧЕНЬ ПРИЯТНО', CaseType::UPPER],
            ['ОЧЕНЬ_ПРИЯТНО', 'Очень Приятно', CaseType::TITLE],
            ['ОЧЕНЬ_ПРИЯТНО', 'очень/приятно', CaseType::PATH],
            ['ОЧЕНЬ_ПРИЯТНО', 'Очень_Приятно', CaseType::ADA],
            ['ОЧЕНЬ_ПРИЯТНО', 'ОЧЕНЬ-ПРИЯТНО', CaseType::COBOL],
            ['ОЧЕНЬ_ПРИЯТНО', 'Очень приятно', CaseType::SENTENCE],

            // Arabic characters
            ['مرحبا-بالعالم', 'مرحبابالعالم', CaseType::CAMEL],
            ['مرحبا-بالعالم', 'مرحبابالعالم', CaseType::PASCAL],
            ['مرحبا-بالعالم', 'مرحبا_بالعالم', CaseType::SNAKE],
            ['مرحبا-بالعالم', 'مرحبا-بالعالم', CaseType::KEBAB],
            ['مرحبا-بالعالم', 'مرحبا_بالعالم', CaseType::MACRO],
            ['مرحبا-بالعالم', 'مرحبا-بالعالم', CaseType::TRAIN],
            ['مرحبا-بالعالم', 'مرحبا.بالعالم', CaseType::DOT],
            ['مرحبا-بالعالم', 'مرحبا بالعالم', CaseType::LOWER],
            ['مرحبا-بالعالم', 'مرحبا بالعالم', CaseType::UPPER],
            ['مرحبا-بالعالم', 'مرحبا بالعالم', CaseType::TITLE],
            ['مرحبا-بالعالم', 'مرحبا/بالعالم', CaseType::PATH],
            ['مرحبا-بالعالم', 'مرحبا_بالعالم', CaseType::ADA],
            ['مرحبا-بالعالم', 'مرحبا-بالعالم', CaseType::COBOL],
            ['مرحبا-بالعالم', 'مرحبا بالعالم', CaseType::SENTENCE],

            // Chinese characters
            ['你好-世界', '你好世界', CaseType::CAMEL],
            ['你好-世界', '你好世界', CaseType::PASCAL],
            ['你好-世界', '你好_世界', CaseType::SNAKE],
            ['你好-世界', '你好-世界', CaseType::KEBAB],
            ['你好-世界', '你好_世界', CaseType::MACRO],
            ['你好-世界', '你好-世界', CaseType::TRAIN],
            ['你好-世界', '你好.世界', CaseType::DOT],
            ['你好-世界', '你好 世界', CaseType::LOWER],
            ['你好-世界', '你好 世界', CaseType::UPPER],
            ['你好-世界', '你好 世界', CaseType::TITLE],
            ['你好-世界', '你好/世界', CaseType::PATH],
            ['你好-世界', '你好_世界', CaseType::ADA],
            ['你好-世界', '你好-世界', CaseType::COBOL],
            ['你好-世界', '你好 世界', CaseType::SENTENCE],

            // Japanese characters
            ['こんにちは-世界', 'こんにちは世界', CaseType::CAMEL],
            ['こんにちは-世界', 'こんにちは世界', CaseType::PASCAL],
            ['こんにちは-世界', 'こんにちは_世界', CaseType::SNAKE],
            ['こんにちは-世界', 'こんにちは-世界', CaseType::KEBAB],
            ['こんにちは-世界', 'こんにちは_世界', CaseType::MACRO],
            ['こんにちは-世界', 'こんにちは-世界', CaseType::TRAIN],
            ['こんにちは-世界', 'こんにちは.世界', CaseType::DOT],
            ['こんにちは-世界', 'こんにちは 世界', CaseType::LOWER],
            ['こんにちは-世界', 'こんにちは 世界', CaseType::UPPER],
            ['こんにちは-世界', 'こんにちは 世界', CaseType::TITLE],
            ['こんにちは-世界', 'こんにちは/世界', CaseType::PATH],
            ['こんにちは-世界', 'こんにちは_世界', CaseType::ADA],
            ['こんにちは-世界', 'こんにちは-世界', CaseType::COBOL],
            ['こんにちは-世界', 'こんにちは 世界', CaseType::SENTENCE],

            // Mixed Unicode with ASCII
            ['user-имя', 'userИмя', CaseType::CAMEL],
            ['user-имя', 'UserИмя', CaseType::PASCAL],
            ['user-имя', 'user_имя', CaseType::SNAKE],
            ['user-имя', 'user-имя', CaseType::KEBAB],
            ['user-имя', 'USER_ИМЯ', CaseType::MACRO],
            ['user-имя', 'User-Имя', CaseType::TRAIN],
            ['user-имя', 'user.имя', CaseType::DOT],
            ['user-имя', 'user имя', CaseType::LOWER],
            ['user-имя', 'USER ИМЯ', CaseType::UPPER],
            ['user-имя', 'User Имя', CaseType::TITLE],
            ['user-имя', 'user/имя', CaseType::PATH],
            ['user-имя', 'User_Имя', CaseType::ADA],
            ['user-имя', 'USER-ИМЯ', CaseType::COBOL],
            ['user-имя', 'User имя', CaseType::SENTENCE],
        ];
    }

    public function testUnicodeAcronymHandling(): void
    {
        // Test that Unicode characters don't interfere with acronym detection
        $this->assertEquals('xml_parser_русский', Converter::toSnake('XMLParserРусский'));
        $this->assertEquals('xmlParserРусский', Converter::toCamel('xml_parser_русский'));
        $this->assertEquals('XmlParserРусский', Converter::toPascal('xml_parser_русский'));
    }

    public function testUnicodeEmptyString(): void
    {
        // Test empty string handling with Unicode context
        $this->assertEquals('', Converter::toSnake(''));
        $this->assertEquals('', Converter::toCamel(''));
        $this->assertEquals('', Converter::toPascal(''));
    }

    public function testUnicodeWhitespaceOnly(): void
    {
        // Test whitespace-only strings with Unicode context
        $this->assertEquals('', Converter::toSnake('   '));
        $this->assertEquals('', Converter::toCamel('   '));
        $this->assertEquals('', Converter::toPascal('   '));
    }
}
