# DevJeetu/CaseConverter

[![Latest Stable Version](https://poser.pugx.org/dev-jeetu/case-converter/v/stable)](https://packagist.org/packages/dev-jeetu/case-converter)
[![Total Downloads](https://poser.pugx.org/dev-jeetu/case-converter/downloads)](https://packagist.org/packages/dev-jeetu/case-converter)
[![License](https://poser.pugx.org/dev-jeetu/case-converter/license)](https://packagist.org/packages/dev-jeetu/case-converter)
[![PHP Version Require](https://poser.pugx.org/dev-jeetu/case-converter/require/php)](https://packagist.org/packages/dev-jeetu/case-converter)
[![Tests](https://github.com/dev-jeetu/case-converter/actions/workflows/ci.yml/badge.svg)](https://github.com/dev-jeetu/case-converter/actions/workflows/ci.yml)

A comprehensive PHP library for converting between different naming conventions. Supports snake_case, camelCase, PascalCase, kebab-case, and many more with proper acronym handling and full Unicode support.

## ✨ Features

- 🔄 **14 different case formats** supported
- 🌍 **Full Unicode support** for international characters (Greek, Russian, Arabic, Chinese, Japanese)
- 🎯 **Smart acronym handling** (XML, HTTP, API, etc.) with ASCII-only detection
- 🔒 **Type-safe enum-based API** with full IDE support
- 🚀 **High performance** with optimized algorithms and benchmarking
- 🧪 **Comprehensive test coverage** (422 tests, 1856 assertions)
- 📝 **Fluent API** for easy chaining
- 🛡️ **Custom exception classes** for better error handling
- 🔧 **Zero dependencies** - pure PHP implementation
- 📦 **PSR-4 autoloading** compatible
- 🐘 **PHP 8.1+** support with strict types

## 📦 Installation

Install via Composer:

```bash
composer require dev-jeetu/case-converter
```

## 🚀 Quick Start

```php
use DevJeetu\CaseConverter\Converter;
use DevJeetu\CaseConverter\CaseType;

// Simple conversions
echo Converter::toSnake('firstName');        // first_name
echo Converter::toCamel('first_name');       // firstName
echo Converter::toPascal('user-profile');    // UserProfile
echo Converter::toKebab('UserName');         // user-name

// Type-safe enum usage
echo Converter::convert('userName', CaseType::SNAKE);   // user_name
echo Converter::convert('user_id', CaseType::PASCAL);   // UserId

// Proper acronym handling
echo Converter::toSnake('XMLHttpRequest');   // xml_http_request
echo Converter::toCamel('parse_HTML');       // parseHTML
echo Converter::toPascal('JSON web token');  // JSONWebToken

// Unicode support
echo Converter::toCamel('πολύ-Καλό');       // πολύΚαλό
echo Converter::toSnake('ОЧЕНЬ_ПРИЯТНО');   // очень_приятно
echo Converter::toPascal('مرحبا-بالعالم');  // مرحبابالعالم

// Fluent interface
echo Converter::from('user_name')->toPascal(); // UserName
echo Converter::from('XMLParser')->toKebab();  // xml-parser
```

## 📚 Supported Formats & Aliases

| Format        | Example     | Method         | Enum                   | Aliases                                                                               |
|---------------|-------------|----------------|------------------------|---------------------------------------------------------------------------------------|
| camelCase     | `userName`  | `toCamel()`    | `CaseType::CAMEL`      | `camel`, `camelcase`, `camel_case`, `lower_camel`, `lowerCamel`                       |
| PascalCase    | `UserName`  | `toPascal()`   | `CaseType::PASCAL`     | `pascal`, `pascalcase`, `pascal_case`, `upper_camel`, `upperCamel`, `studly`          |
| snake_case    | `user_name` | `toSnake()`    | `CaseType::SNAKE`      | `snake`, `snake_case`, `underscore`, `lower_snake`                                    |
| kebab-case    | `user-name` | `toKebab()`    | `CaseType::KEBAB`      | `kebab`, `kebab_case`, `kebab-case`, `dash`, `hyphen`, `lisp`                         |
| MACRO_CASE    | `USER_NAME` | `toMacro()`    | `CaseType::MACRO`      | `macro`, `macro_case`, `screamed_snake`, `screaming_snake`, `upper_snake`, `constant` |
| Train-Case    | `User-Name` | `toTrain()`    | `CaseType::TRAIN`      | `train`, `train_case`, `train-case`, `pascal_kebab`, `pascal-kebab`                   |
| dot.case      | `user.name` | `toDot()`      | `CaseType::DOT`        | `dot`, `dot_case`, `dot.case`, `period`                                               |
| lower case    | `username`  | `toLower()`    | `CaseType::LOWER`      | `lower`, `lower_case`, `space`, `space_case`, `lower_space`                           |
| UPPER CASE    | `USERNAME`  | `toUpper()`    | `CaseType::UPPER`      | `upper`, `upper_case`, `upper_space`                                                  |
| Title Case    | `User Name` | `toTitle()`    | `CaseType::TITLE`      | `title`, `title_case`, `start_case`, `header`                                         |
| path/case     | `user/name` | `toPath()`     | `CaseType::PATH`       | `path`, `path_case`, `path/case`, `slash`, `directory`                                |
| Ada_Case      | `User_Name` | `toAda()`      | `CaseType::ADA`        | `ada`, `ada_case`, `pascal_snake`, `upper_snake_case`                                 |
| COBOL-CASE    | `USER-NAME` | `toCobol()`    | `CaseType::COBOL`      | `cobol`, `cobol_case`, `upper_kebab`, `screaming_kebab`                               |
| Sentence case | `User name` | `toSentence()` | `CaseType::SENTENCE`   | `sentence`, `sentence_case`, `first_upper`                                            |

## 📝 Real-world Examples

### API Response Transformation

```php
// API response transformation
$apiData = ['user_name' => 'john_doe', 'email_address' => 'john@example.com'];
$frontendData = [];
foreach ($apiData as $key => $value) {
    $frontendData[Converter::toCamel($key)] = $value;
}
// Result: ['userName' => 'john_doe', 'emailAddress' => 'john@example.com']
```

### Database Column to PHP Property Mapping

```php
class User {
    public function fromDatabase(array $row): void {
        foreach ($row as $column => $value) {
            $property = Converter::toCamel($column);
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }
}
```

### Configuration Key Transformation

```php
$config = [
    'database-host' => 'localhost',
    'cache-driver' => 'redis',
    'mail-smtp-port' => 587
];

$phpConfig = [];
foreach ($config as $key => $value) {
    $phpConfig[Converter::toSnake($key)] = $value;
}
// Result: ['database_host' => 'localhost', 'cache_driver' => 'redis', 'mail_smtp_port' => 587]
```

### International Content Processing

```php
// Handle international content
$internationalData = [
    'user_name' => 'Иван_Петров',
    'email_address' => 'ivan@example.com',
    'country_code' => 'RU'
];

$processedData = [];
foreach ($internationalData as $key => $value) {
    $processedData[Converter::toCamel($key)] = $value;
}
// Result: ['userName' => 'Иван_Петров', 'emailAddress' => 'ivan@example.com', 'countryCode' => 'RU']
```

### Class Name Generation

```php
$tableName = 'user_profiles';
$className = Converter::toPascal($tableName); // UserProfiles

$apiEndpoint = 'user-profile-data';
$serviceClass = Converter::toPascal($apiEndpoint); // UserProfileData
```

### URL Slug Generation

```php
$title = 'My Blog Post Title';
$slug = Converter::toKebab($title); // my-blog-post-title

$internationalTitle = 'Мой Блог Пост Заголовок';
$internationalSlug = Converter::toKebab($internationalTitle); // мой-блог-пост-заголовок
```

## 🌍 Unicode Support

The library provides full Unicode support for international characters:

```php
// Greek characters
echo Converter::toCamel('πολύ-Καλό');           // πολύΚαλό
echo Converter::toSnake('πολύ-Καλό');           // πολύ_καλό
echo Converter::toPascal('πολύ-Καλό');          // ΠολύΚαλό

// Russian characters
echo Converter::toCamel('ОЧЕНЬ_ПРИЯТНО');       // оченьПриятно
echo Converter::toSnake('ОЧЕНЬ_ПРИЯТНО');       // очень_приятно
echo Converter::toPascal('ОЧЕНЬ_ПРИЯТНО');      // ОченьПриятно

// Arabic characters
echo Converter::toCamel('مرحبا-بالعالم');       // مرحبابالعالم
echo Converter::toSnake('مرحبا-بالعالم');       // مرحبا_بالعالم
echo Converter::toPascal('مرحبا-بالعالم');      // مرحبابالعالم

// Chinese characters
echo Converter::toCamel('你好-世界');            // 你好世界
echo Converter::toSnake('你好-世界');            // 你好_世界
echo Converter::toPascal('你好-世界');           // 你好世界

// Japanese characters
echo Converter::toCamel('こんにちは-世界');      // こんにちは世界
echo Converter::toSnake('こんにちは-世界');      // こんにちは_世界
echo Converter::toPascal('こんにちは-世界');     // こんにちは世界

// Mixed Unicode with ASCII
echo Converter::toCamel('user-имя');            // userИмя
echo Converter::toSnake('user-имя');            // user_имя
echo Converter::toPascal('user-имя');           // UserИмя
```

## 🧠 Smart Acronym Handling

The library intelligently handles acronyms and preserves them in appropriate contexts:

```php
// ASCII acronyms are preserved (XML, HTTP, API, etc.)
echo Converter::toCamel('XML parser');     // XMLParser (not xMLParser)
echo Converter::toPascal('HTML element');  // HTMLElement (not HtmlElement)
echo Converter::toCamel('parse HTML');     // parseHTML (not parseHtml)
echo Converter::toSnake('parseHTML');      // parse_html

// Complex acronym combinations
echo Converter::toSnake('XMLHttpRequest'); // xml_http_request
echo Converter::toCamel('Get_HTTPS_Url');  // getHTTPSUrl
echo Converter::toPascal('JSON_web_token'); // JSONWebToken

// Unicode words are treated as normal words (not acronyms)
echo Converter::toCamel('ОЧЕНЬ_ПРИЯТНО');  // оченьПриятно (not ОЧЕНЬПриятно)
echo Converter::toPascal('πολύ-Καλό');     // ΠολύΚαλό (not ΠΟΛΎΚαλό)

// Brand names with special casing
echo Converter::toSnake('iPhone');         // i_phone
echo Converter::toPascal('mac_OS');        // MacOS
```

## 🎯 Advanced Usage

### Type-Safe Enum API

```php
use DevJeetu\CaseConverter\CaseType;

// Type-safe conversions
$format = CaseType::SNAKE;
echo $format->convert('firstName');     // first_name

// Get format information
echo $format->getDescription();         // "Lowercase words separated by underscores"
echo $format->getExample();             // my_name_is_bond
print_r($format->getAliases());         // ['snake', 'snake_case', 'underscore', 'lower_snake']

// Find a format by string
$format = CaseType::fromString('kebab-case');
echo $format->convert('userName');      // user-name
```

### Generic Conversion with Aliases

```php
// All these work (case-insensitive)
echo Converter::convert('firstName', 'snake');        // first_name
echo Converter::convert('firstName', 'kebab-case');   // first-name
echo Converter::convert('firstName', 'dash');         // first-name
echo Converter::convert('firstName', 'hyphen');       // first-name

// String or enum - both work
echo Converter::convert('user_id', 'pascal');         // UserId
echo Converter::convert('user_id', CaseType::PASCAL); // UserId
```

### Format Introspection

```php
// Check if a format is supported
if (Converter::isFormatSupported('snake_case')) {
    // Convert safely
}

// Get all supported formats
$formats = Converter::getSupportedFormats();        // Array of CaseType enums
$names = Converter::getSupportedFormatNames();      // Array of format names
$aliases = Converter::getSupportedAliases();        // All possible aliases

// Get detailed format information
$info = Converter::getFormatInfo(CaseType::CAMEL);
/*
DevJeetu\CaseConverter\DTOs\CaseFormatInfo Object
(
    [name] => camel
    [emoji] => 🐪
    [description] => First word lowercase, later words capitalized, no separators
    [example] => myNameIsBond
    [delimiter] => 
    [aliases] => Array
        (
            [0] => camel
            [1] => camelcase
            [2] => camel_case
            [3] => lower_camel
            [4] => lowerCamel
        )
    [converterClass] => DevJeetu\CaseConverter\Converters\CamelCase
    [isCapitalized] => 
    [isUppercase] => 
    [isLowercase] => 1
)
*/
```

### Fluent Interface

```php
use DevJeetu\CaseConverter\Converter;

// Method chaining
$result = Converter::from('XMLHttpRequest')->toSnake();  // xml_http_request

// Convert to any format
$result = Converter::from('user_profile')->to('pascal');   // UserProfile

$result = Converter::from('firstName')->to(CaseType::KEBAB);  // first-name
```

### Individual Converters

```php
use DevJeetu\CaseConverter\Converters\SnakeCase;
use DevJeetu\CaseConverter\Converters\CamelCase;

echo SnakeCase::convert('firstName');  // first_name
echo CamelCase::convert('user_name');  // userName
```

## 🛡️ Error Handling

The library provides custom exceptions for better error handling:

```php
use DevJeetu\CaseConverter\Converter;
use DevJeetu\CaseConverter\Exceptions\UnsupportedFormatException;
use DevJeetu\CaseConverter\Exceptions\ConverterNotFoundException;

try {
    $result = Converter::convert('test', 'invalid_format');
} catch (UnsupportedFormatException $e) {
    echo $e->getMessage(); 
    // "Unsupported format: 'invalid_format'. Supported formats: camel, pascal, snake, kebab, macro, train, dot, lower, upper, title, path, ada, cobol, sentence"
}

// Safe checking
if (Converter::isFormatSupported('snake')) {
    $result = Converter::convert('test', 'snake');
} else {
    // Handle unsupported format
}

// Get all supported formats for validation
$supportedFormats = Converter::getSupportedFormatNames();
$supportedAliases = Converter::getSupportedAliases();
```

## 📈 Performance & Benchmarks

The library is optimized for high performance:

```php
// Performance benchmarks (1000 iterations each)
// - Basic conversions: ~0.1ms for 1000 iterations
// - Unicode conversions: ~0.2ms for 1000 iterations  
// - Complex acronym handling: ~0.1ms for 1000 iterations
// - Bulk operations: 1000 conversions in <0.1 seconds
// - Memory efficient with minimal allocations
// - Scales linearly with input string length
```

### Performance Test Results

- **CamelCase conversion**: ~0.1ms for 1000 iterations
- **SnakeCase conversion**: ~0.1ms for 1000 iterations
- **Unicode conversion**: ~0.2ms for 1000 iterations
- **Acronym handling**: ~0.1ms for 1000 iterations
- **Complex strings**: <0.002ms per conversion
- **Bulk operations**: 1000 conversions in <0.1 seconds

## 🧪 Testing

Run the comprehensive test suite:

```bash
# Run all tests (422 tests, 1856 assertions)
composer test

# Run performance benchmarks
vendor/bin/phpunit tests/Unit/PerformanceBenchmarkTest.php

# Run Unicode-specific tests
vendor/bin/phpunit tests/Unit/UnicodeCaseConverterTest.php

# Run quality checks (tests + static analysis + code style)
composer quality
```

## 🔧 Development

```bash
# Install dependencies
composer install

# Run tests
composer test

# Fix code style
composer cs-fix

# Run static analysis
composer phpstan

# Run all quality checks
composer quality
```

## 📋 Requirements

- PHP 8.1 or higher
- No external dependencies

## 🤝 Contributing

Contributions are welcome!

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Add tests for your changes
5. Ensure all tests pass (`composer quality`)
6. Commit your changes (`git commit -am 'Add amazing feature'`)
7. Push to the branch (`git push origin feature/amazing-feature`)
8. Open a Pull Request

## 🐛 Issues & Support

If you discover any issues or have questions:

1. Check existing [issues](https://github.com/dev-jeetu/case-converter/issues)
2. Open a [new issue](https://github.com/dev-jeetu/case-converter/issues/new) with a detailed description
3. For security issues, please email directly

## 📄 License

This project is licensed under the MIT License. Please see [LICENSE.md](LICENSE.md) for details.

## 🙏 Acknowledgments

- Inspired by various case conversion libraries across different languages
- Built with modern PHP best practices and type safety
- Comprehensive test coverage ensures reliability
- Community feedback and contributions

## 🔄 Changelog

### v0.0.1
- ✨ Initial release with full Unicode support for international characters
- 🧱 Support for 14 different case formats with a type-safe enum-based API
- 🧠 Comprehensive acronym handling (ASCII-based)
- 🧪 70+ test cases including Unicode scenarios, with 422 tests and 1856 assertions
- 🛡️ Custom exception classes for better error handling
- ⚙️ PHP 8.1+ support
- 🚀 Improved code organization and reduced duplication
- ⚡ Includes performance benchmarking tests

---

<div style="text-align: center;">

**Made with ❤️ by [Jeetu](https://github.com/dev-jeetu)**

[Report Bug](https://github.com/dev-jeetu/case-converter/issues) · [Request Feature](https://github.com/dev-jeetu/case-converter/issues) · [Documentation](https://github.com/dev-jeetu/case-converter/wiki)

</div>