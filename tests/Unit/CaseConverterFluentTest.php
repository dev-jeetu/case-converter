<?php

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseConverter;
use DevJeetu\CaseConverter\CaseConverterFluent;
use DevJeetu\CaseConverter\CaseFormat;
use PHPUnit\Framework\TestCase;

class CaseConverterFluentTest extends TestCase
{
    public function testFluentInterface(): void
    {
        $input = 'userName';

        $fluent = CaseConverter::from($input);
        $this->assertInstanceOf(CaseConverterFluent::class, $fluent);

        $this->assertEquals('user_name', $fluent->toSnakeCase());
        $this->assertEquals('USER_NAME', $fluent->toScreamedSnakeCase());
        $this->assertEquals('userName', $fluent->toCamelCase());
        $this->assertEquals('UserName', $fluent->toPascalCase());
        $this->assertEquals('user-name', $fluent->toKebabCase());
    }

    public function testFluentTo(): void
    {
        $input = 'userName';
        $fluent = CaseConverter::from($input);

        $this->assertEquals('user_name', $fluent->to('snake'));
        $this->assertEquals('user-name', $fluent->to('kebab'));
        $this->assertEquals('UserName', $fluent->to(CaseFormat::PASCAL_CASE));
    }
}
