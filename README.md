# DevJeetu/CaseConverter

[![Latest Stable Version](https://poser.pugx.org/dev-jeetu/case-converter/v/stable)](https://packagist.org/packages/dev-jeetu/case-converter)
[![Total Downloads](https://poser.pugx.org/dev-jeetu/case-converter/downloads)](https://packagist.org/packages/dev-jeetu/case-converter)
[![License](https://poser.pugx.org/dev-jeetu/case-converter/license)](https://packagist.org/packages/dev-jeetu/case-converter)
[![PHP Version Require](https://poser.pugx.org/dev-jeetu/case-converter/require/php)](https://packagist.org/packages/dev-jeetu/case-converter)
[![Tests](https://github.com/dev-jeetu/case-converter/actions/workflows/ci.yml/badge.svg)](https://github.com/dev-jeetu/case-converter/actions/workflows/ci.yml)

A comprehensive PHP library for converting between different naming conventions. Supports snake_case, camelCase, PascalCase, kebab-case, and many more with proper acronym handling.

## ✨ Features

- 🔄 **14 different case formats** supported
- 🎯 **Proper acronym handling** (XML, HTTP, API, etc.)
- 🔒 **Type-safe enum-based API** with full IDE support
- 🚀 **High performance** with optimized algorithms
- 🧪 **100% test coverage** with a comprehensive test suite
- 📝 **Fluent API** for easy chaining
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
use DevJeetu\CaseConverter\CaseConverter;
use DevJeetu\CaseConverter\CaseFormat;

// Simple conversions
echo CaseConverter::toSnake('firstName');        // first_name
echo CaseConverter::toCamel('first_name');       // firstName
echo CaseConverter::toPascal('user-profile');    // UserProfile
echo CaseConverter::toKebab('UserName');         // user-name

// Type-safe enum usage
echo CaseConverter::convert('userName', CaseFormat::SNAKE);   // user_name
echo CaseConverter::convert('user_id', CaseFormat::PASCAL);   // UserId

// Proper acronym handling
echo CaseConverter::toSnake('XMLHttpRequest');   // xml_http_request
echo CaseConverter::toCamel('parse_HTML');       // parseHTML
echo CaseConverter::toPascal('JSON web token');  // JSONWebToken

// Fluent interface
echo CaseConverter::from('user_name')->toPascal(); // UserName
echo CaseConverter::from('XMLParser')->toKebab();  // xml-parser
```

## 📚 Supported Formats

| Format        | Example     | Method         | Enum                   |
|---------------|-------------|----------------|------------------------|
| camelCase     | `userName`  | `toCamel()`    | `CaseFormat::CAMEL`    |
| PascalCase    | `UserName`  | `toPascal()`   | `CaseFormat::PASCAL`   |
| snake_case    | `user_name` | `toSnake()`    | `CaseFormat::SNAKE`    |
| kebab-case    | `user-name` | `toKebab()`    | `CaseFormat::KEBAB`    |
| MACRO_CASE    | `USER_NAME` | `toMacro()`    | `CaseFormat::MACRO`    |
| Train-Case    | `User-Name` | `toTrain()`    | `CaseFormat::TRAIN`    |
| dot.case      | `user.name` | `toDot()`      | `CaseFormat::DOT`      |
| lower case    | `username`  | `toLower()`    | `CaseFormat::LOWER`    |
| UPPER CASE    | `USERNAME`  | `toUpper()`    | `CaseFormat::UPPER`    |
| Title Case    | `User Name` | `toTitle()`    | `CaseFormat::TITLE`    |
| path/case     | `user/name` | `toPath()`     | `CaseFormat::PATH`     |
| Ada_Case      | `User_Name` | `toAda()`      | `CaseFormat::ADA`      |
| COBOL-CASE    | `USER-NAME` | `toCobol()`    | `CaseFormat::COBOL`    |
| Sentence case | `User name` | `toSentence()` | `CaseFormat::SENTENCE` |

## 🎯 Advanced Usage

### Type-Safe Enum API

```php
use DevJeetu\CaseConverter\CaseFormat;

// Type-safe conversions
$format = CaseFormat::SNAKE;
echo $format->convert('firstName');     // first_name

// Get format information
echo $format->getDescription();         // "Lowercase words separated by underscores"
echo $format->getExample();             // my_name_is_bond
print_r($format->getAliases());         // ['snake', 'snake_case', 'underscore', 'lower_snake']

// Find a format by string
$format = CaseFormat::fromString('kebab-case');
echo $format->convert('userName');      // user-name
```

### Generic Conversion with Aliases

```php
// All these works (case-insensitive)
echo CaseConverter::convert('firstName', 'snake');        // first_name
echo CaseConverter::convert('firstName', 'kebab-case');   // first-name
echo CaseConverter::convert('firstName', 'dash');         // first-name
echo CaseConverter::convert('firstName', 'hyphen');       // first-name

// String or enum - both work
echo CaseConverter::convert('user_id', 'pascal');         // UserId
echo CaseConverter::convert('user_id', CaseFormat::PASCAL); // UserId
```

### Format Introspection

```php
// Check if a format is supported
if (CaseConverter::isFormatSupported('snake_case')) {
    // Convert safely
}

// Get all supported formats
$formats = CaseConverter::getSupportedFormats();        // Array of CaseFormat enums
$names = CaseConverter::getSupportedFormatNames();      // Array of format names
$aliases = CaseConverter::getSupportedAliases();        // All possible aliases

// Get detailed format information
$info = CaseConverter::getFormatInfo(CaseFormat::CAMEL);
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
use DevJeetu\CaseConverter\CaseConverter;

// Method chaining
$result = CaseConverter::from('XMLHttpRequest')->toSnake();  // xml_http_request

// Convert to any format
$result = CaseConverter::from('user_profile')->to('pascal');   // UserProfile

$result = CaseConverter::from('firstName')->to(CaseFormat::KEBAB);  // first-name
```

### Individual Converters

```php
use DevJeetu\CaseConverter\Converters\SnakeCase;
use DevJeetu\CaseConverter\Converters\CamelCase;

echo SnakeCase::convert('firstName');  // first_name
echo CamelCase::convert('user_name');  // userName
```

## 🧠 Acronym Handling

The library intelligently handles acronyms and preserves them in appropriate contexts:

```php
// Leading acronyms are preserved in cases where capitalization is supported like camelCase and PascalCase
echo CaseConverter::toCamel('XML parser');     // XMLParser (not xMLParser)
echo CaseConverter::toPascal('HTML element');  // HTMLElement (not HtmlElement)

// Trailing acronyms are preserved in cases where capitalization is supported
echo CaseConverter::toCamel('parse HTML');     // parseHTML (not parseHtml)
echo CaseConverter::toSnake('parseHTML');      // parse_html

// Complex acronym combinations
echo CaseConverter::toSnake('XMLHttpRequest'); // xml_http_request
echo CaseConverter::toCamel('Get_HTTPS_Url');  // getHTTPSUrl
echo CaseConverter::toPascal('JSON_web_token'); // JSONWebToken

// Brand names with special casing
echo CaseConverter::toSnake('iPhone');         // i_phone
echo CaseConverter::toPascal('mac_OS');        // MacOS
```

## 🔧 Supported Aliases

Each format supports multiple aliases for convenience:

| Format        | Aliases                                                                               |
|---------------|---------------------------------------------------------------------------------------|
| camelCase     | `camel`, `camelcase`, `camel_case`, `lower_camel`, `lowerCamel`                       |
| PascalCase    | `pascal`, `pascalcase`, `pascal_case`, `upper_camel`, `upperCamel`, `studly`          |
| snake_case    | `snake`, `snake_case`, `underscore`, `lower_snake`                                    |
| kebab-case    | `kebab`, `kebab_case`, `kebab-case`, `dash`, `hyphen`, `lisp`                         |
| MACRO_CASE    | `macro`, `macro_case`, `screamed_snake`, `screaming_snake`, `upper_snake`, `constant` |
| Train-Case    | `train`, `train_case`, `train-case`, `pascal_kebab`, `pascal-kebab`                   |
| dot.case      | `dot`, `dot_case`, `dot.case`, `period`                                               |
| space case    | `lower`, `lower_case`, `space`, `space_case`, `lower_space`                           |
| UPPER CASE    | `upper`, `upper_case`, `upper_space`                                                  |
| Title Case    | `title`, `title_case`, `start_case`, `header`                                         |
| path/case     | `path`, `path_case`, `path/case`, `slash`, `directory`                                |
| Ada_Case      | `ada`, `ada_case`, `pascal_snake`, `upper_snake_case`                                 |
| COBOL-CASE    | `cobol`, `cobol_case`, `upper_kebab`, `screaming_kebab`                               |
| Sentence case | `sentence`, `sentence_case`, `first_upper`                                            |


## 🧪 Testing

Run the test suite:

```bash
# Run all tests
composer test

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

## 📝 Examples

### Real-world Usage Examples

```php
// API response transformation
$apiData = ['user_name' => 'john_doe', 'email_address' => 'john@example.com'];
$frontendData = [];
foreach ($apiData as $key => $value) {
    $frontendData[CaseConverter::toCamel($key)] = $value;
}
// Result: ['userName' => 'john_doe', 'emailAddress' => 'john@example.com']

// Database column to PHP property mapping
class User {
    public function fromDatabase(array $row): void {
        foreach ($row as $column => $value) {
            $property = CaseConverter::toCamel($column);
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }
}

// Configuration key transformation
$config = [
    'database-host' => 'localhost',
    'cache-driver' => 'redis',
    'mail-smtp-port' => 587
];

$phpConfig = [];
foreach ($config as $key => $value) {
    $phpConfig[CaseConverter::toSnake($key)] = $value;
}
// Result: ['database_host' => 'localhost', 'cache_driver' => 'redis', 'mail_smtp_port' => 587]

// Class name generation
$tableName = 'user_profiles';
$className = CaseConverter::toPascal($tableName); // UserProfiles

// URL slug generation
$title = 'My Blog Post Title';
$slug = CaseConverter::toKebab($title); // my-blog-post-title
```

### Error Handling

```php
use DevJeetu\CaseConverter\CaseConverter;

try {
    $result = CaseConverter::convert('test', 'invalid_format');
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage(); // "Unsupported format: invalid_format"
}

// Safe checking
if (CaseConverter::isFormatSupported('snake')) {
    $result = CaseConverter::convert('test', 'snake');
} else {
    // Handle unsupported format
}
```

## 📈 Performance

Benchmarks on typical string conversions:

- **~0.001 ms** per conversion on average
- **Memory efficient** with minimal allocations
- **Scales linearly** with input string length
- **No external dependencies** - pure PHP implementation

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
- Initial release
- Support for 14 different case formats
- Type-safe enum-based API
- Comprehensive acronym handling
- Full test coverage
- PHP 8.1+ support

---

<div style="text-align: center;">

**Made with ❤️ by [Jeetu](https://github.com/dev-jeetu)**

[Report Bug](https://github.com/dev-jeetu/case-converter/issues) · [Request Feature](https://github.com/dev-jeetu/case-converter/issues) · [Documentation](https://github.com/dev-jeetu/case-converter/wiki)

</div>