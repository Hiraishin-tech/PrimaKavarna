# PrimaKurzy.cz Shortcode Processor Helper Library

Library Is For Educational Purposes Only


## 1. Installation:

The easiest way to install the library is using [Composer](https://getcomposer.org/):

```sh
composer require primakurzy/shortcode
```

Or simply download the PHP package from the [src/](./src/) directory in this repository.


## 2. Loading:

If you're using Composer use the following include/require statement

```php
<?php
require "vendor/autoload.php";
// ...
```

otherwise:

```php
<?php
require "path/to/src/Processor.php";
// ...
```


## 3. A Simple Example:

```php
// call library function
echo primakurzy\Shortcode\Processor::process('folder/with/shortcodes', 'random number: [rand from=5 to=10]');
```
