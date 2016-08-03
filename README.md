# PHP Color &nbsp; [![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/ProjectCleverWeb/PHP-Color/blob/master/README.md) [![Travis Build Status](https://img.shields.io/travis/ProjectCleverWeb/PHP-Color.svg?maxAge=2592000&style=flat-square)](https://travis-ci.org/ProjectCleverWeb/PHP-Color) [![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/ProjectCleverWeb/PHP-Color.svg?maxAge=2592000&style=flat-square)](https://scrutinizer-ci.com/g/ProjectCleverWeb/PHP-Color/) [![Scrutinizer Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ProjectCleverWeb/PHP-Color.svg?maxAge=2592000&style=flat-square)](https://scrutinizer-ci.com/g/ProjectCleverWeb/PHP-Color/) [![Code Climate Code GPA](https://img.shields.io/codeclimate/github/kabisaict/flow.svg?maxAge=2592000&style=flat-square)](https://codeclimate.com/github/ProjectCleverWeb/PHP-Color)

This is a PHP 7 library for working with RGB, HSL, and Hexadecimal colors. Create schemes, modify specific color properties, export CMYK, and make color suggestions quickly and easily with this stand-alone library.

Demo: [jsfiddle.net/t3LL4q14](http://jsfiddle.net/t3LL4q14/embedded/result/)

### Download:

[![GitHub release](https://img.shields.io/github/release/ProjectCleverWeb/PHP-Color.svg?maxAge=2592000&style=flat-square)](https://github.com/ProjectCleverWeb/PHP-Color/releases)

Copyright &copy; 2016 Nicholas Jordon &mdash; All Rights Reserved

## Features

* Convert any color between the RGB, HSL, Hexadecimal, and CMYK color spectrums.
* Dynamically generate 10 different color scheme algorithims for any color. (That's over 165,000,000 possible schemes)
* Check whether a color appears visually dark or light. (uses [YIQ](https://en.wikipedia.org/wiki/YIQ) weights for better accuraccy)
* Easily modify a color's hue, saturation, light, red, green, blue, and alpha (transparcency) values.
* Generate CSS values on the fly
* Find the contrast between 2 colors.
* Dynamically generate random colors, including for specific color ranges.
* All errors are recoverable, and errors can be triggered as exceptions (default), using `trigger_error()`, or can be turned off for all instances.

## Usage

First pull in the autoloader and the color class. (It is recommend that you take advantage of PHP's `use &hellip; as` syntax)

```php
require_once __DIR__.'/projectcleverweb/php-color/autoload.php';

use projectcleverweb\color\main as color;
```

### Import your color
Colors can be imported several ways. The below all create the exact same object:

```php
// Import as a hexadecimal string (the '#' is optional)
$color = new color('#FF0000');

// Import as a RGB array
$color = new color(['r' => 255, 'g' => 0, 'b' => 0]);

// Import as a HSL array
$color = new color(['h' => 0, 's' => 100, 'l' => 50]);

// Import as a CMYK array
$color = new color(['c' => 0, 'm' => 100, 'y' => 100, 'k' => 0]);

// Import as a hex integer
$color = new color(0xff0000);

// Import as a RGB array with Alpha channel (Alpha is only support with array inputs and must use the 'a' offset)
$color = new color(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 50]);
```

### Conversions

You can convert any input color between Hexadecimal, RGB, HSL, CMYK, or CSS value.

```php
$color = new color('#FF0000');

// ['r' => 255, 'g' => 0, 'b' => 0]
$rgb  = $color->rgb();

// ['h' => 0, 's' => 100, 'l' => 50]
$hsl  = $color->hsl();

// ['c' => 0, 'm' => 100, 'y' => 100, 'k' => 0]
$cmyk = $color->cmyk();

// FF0000
$hex  = $color->hex();

// #FF0000
$css  = $color->css();
```

### Modify A Color
Modification methods have 3 arguments used to control how the modification is applied. Like So:

`method_name(float $adjustment, bool $as_percentage = FALSE, bool $set_absolute = TRUE)`

* `$adjustment` is a integer/float that dictates the amount of change.
* `$as_percentage` is a boolean value that dictates whether or not to treat `adjustment` as a percentage.
* `$set_absolute` is a boolean value that dictates whether set `$adjustment` as the actual value or to treat it as a relative value.

```php
$color = new color('#FF0000');

// Set hue to 120 degrees (green)
$color->hue(120);
echo $color->hex().PHP_EOL; // 00FF00

// Make 20.5% less saturated
$color->saturation(-20.5, TRUE, FALSE);
echo $color->hex().PHP_EOL; // 1AE51A

// Make 20% lighter
$color->light(20, TRUE, FALSE);
echo $color->hex().PHP_EOL; // 76EF76

// Add 25% more red
$color->red(25, TRUE, FALSE);
echo $color->hex().PHP_EOL; // B5EF76

// Make 30% less green
$color->green(-30, TRUE, FALSE);
echo $color->hex().PHP_EOL; // B5A276

// Set blue to 65%
$color->blue(65, TRUE);
echo $color->hex().PHP_EOL; // B5A2A5
```

### Blend 2 Colors

**More Coming Soon&hellip;**

## Installation

**Coming Soon&hellip;**

### Requirements

* PHP **7.0** or **HHVM**

### Install Guide

**Coming Soon&hellip;**

## Contributing

**Contributing *via* Suggestions:** <br>
The best way to submit a suggestion is to open an issue on Github and prefix the
title with `[Suggestion]`. Alternatively, you can email your suggestions to
projectcleverweb(at)gmail(dot)com.

**Contributing *via* Reporting Problems:** <br>
All problems must be reported via Github's
[issue tracker](https://github.com/ProjectCleverWeb/PHP-Color/issues).

**Contributing *via* Code:**

1. Fork the repo on Github: [github.com/ProjectCleverWeb/PHP-Color](https://github.com/ProjectCleverWeb/PHP-Color)
2. Make your changes.
3. Send a pull request to have your changes reviewed.

## License

The PHP-Color documentation by Nicholas Jordon is licensed
under the Creative Commons Attribution-ShareAlike 4.0 International License.
To view a copy of this license, visit http://creativecommons.org/licenses/by-sa/4.0/

The PHP-Color source code by Nicholas Jordon is licensed under
the MIT License. To view a copy of this license, visit http://opensource.org/licenses/MIT
