
# Chebur Search Bundle

[![PHP requirements](https://img.shields.io/packagist/php-v/chebur/search-bundle.svg)](https://packagist.org/packages/chebur/search-bundle "PHP requirements")
[![Latest version](https://img.shields.io/packagist/v/chebur/search-bundle.svg)](https://packagist.org/packages/chebur/search-bundle "Last version")
[![Total downloads](https://img.shields.io/packagist/dt/chebur/search-bundle.svg)](https://packagist.org/packages/chebur/search-bundle "Total downloads")
[![License](https://img.shields.io/packagist/l/chebur/search-bundle.svg)](https://packagist.org/packages/chebur/search-bundle "License")

## Installation

Require the bundle and its dependencies with composer:
```bash
composer require chebur/search-bundle
```
Enable bundle in your application's kernel:
```php
public function registerBundles()
{
    $bundles = array(
        // ...
        new \Chebur\SearchBundle\CheburSearchBundle(),
        // ...
    );
}
```

## License

See [LICENSE](LICENSE).
