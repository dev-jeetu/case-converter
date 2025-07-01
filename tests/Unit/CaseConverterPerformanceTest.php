<?php

namespace DevJeetu\CaseConverter\Tests\Unit;

use DevJeetu\CaseConverter\CaseConverter;
use PHPUnit\Framework\TestCase;

class CaseConverterPerformanceTest extends TestCase
{
    public function testBulkConversions(): void
    {
        $inputs = array_fill(0, 1000, 'someVariableName');

        $start = microtime(true);
        foreach ($inputs as $input) {
            CaseConverter::toSnake($input);
        }
        $end = microtime(true);

        // Should complete 1000 conversions in less than 0.1 seconds
        $this->assertLessThan(0.1, $end - $start, 'Bulk conversions should be fast');
    }

    public function testComplexStringConversion(): void
    {
        $complexString = 'XMLHttpRequestParserWithJSONWebTokenAndHTTPSConnection';

        $start = microtime(true);
        $result = CaseConverter::toSnake($complexString);
        $end = microtime(true);

        $this->assertLessThan(0.001, $end - $start, 'Complex string conversion should be fast');
        $this->assertEquals('xml_http_request_parser_with_json_web_token_and_https_connection', $result);
    }
}
