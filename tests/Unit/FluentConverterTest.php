<?php

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseType;
use DevJeetu\CaseConverter\Converter;
use DevJeetu\CaseConverter\FluentConverter;
use PHPUnit\Framework\TestCase;

class FluentConverterTest extends TestCase
{
    public function testFluentInterface(): void
    {
        $input = 'userName';

        $fluent = Converter::from($input);
        $this->assertInstanceOf(FluentConverter::class, $fluent);

        $this->assertEquals('userName', $fluent->toCamel());
        $this->assertEquals('UserName', $fluent->toPascal());
        $this->assertEquals('user_name', $fluent->toSnake());
        $this->assertEquals('user-name', $fluent->toKebab());
        $this->assertEquals('USER_NAME', $fluent->toMacro());
        $this->assertEquals('User-Name', $fluent->toTrain());
        $this->assertEquals('user.name', $fluent->toDot());
        $this->assertEquals('user name', $fluent->toLower());
        $this->assertEquals('USER NAME', $fluent->toUpper());
        $this->assertEquals('User Name', $fluent->toTitle());
        $this->assertEquals('user/name', $fluent->toPath());
        $this->assertEquals('User_Name', $fluent->toAda());
        $this->assertEquals('USER-NAME', $fluent->toCobol());
        $this->assertEquals('User name', $fluent->toSentence());
    }

    public function testFluentTo(): void
    {
        $input = 'userName';
        $fluent = Converter::from($input);

        $this->assertEquals('user_name', $fluent->to('snake'));
        $this->assertEquals('user-name', $fluent->to('kebab'));
        $this->assertEquals('UserName', $fluent->to(CaseType::PASCAL));
    }
}
