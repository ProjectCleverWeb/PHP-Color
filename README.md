# PHP Color &nbsp; [![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://njordon.mit-license.org/@2016) [![Travis Build Status](https://img.shields.io/travis/ProjectCleverWeb/PHP-Color.svg?maxAge=2592000&style=flat-square)](https://travis-ci.org/ProjectCleverWeb/PHP-Color) [![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/ProjectCleverWeb/PHP-Color.svg?maxAge=2592000&style=flat-square)](https://scrutinizer-ci.com/g/ProjectCleverWeb/PHP-Color/) [![Scrutinizer Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ProjectCleverWeb/PHP-Color.svg?maxAge=2592000&style=flat-square)](https://scrutinizer-ci.com/g/ProjectCleverWeb/PHP-Color/) [![Code Climate Code GPA](https://img.shields.io/codeclimate/github/kabisaict/flow.svg?maxAge=2592000&style=flat-square)](https://codeclimate.com/github/ProjectCleverWeb/PHP-Color)

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

First pull in the autoloader and the color class. (It is recommend that you take advantage of PHP's <code>use &hellip; as</code> syntax)

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

// Import as a hexadecimal integer
$color = new color(0xff0000);

// Import as a RGB array with Alpha channel (Alpha is only support with array inputs and must use the 'a' offset)
$color = new color(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 50]);
```

### Conversions

You can convert any input color between the Hexadecimal, RGB, HSL, CMYK, and CSS values.

```php
$color = new color('#FF0000');

// ['r' => 255, 'g' => 0, 'b' => 0]
$rgb = $color->rgb();

// ['h' => 0, 's' => 100, 'l' => 50]
$hsl = $color->hsl();

// ['c' => 0, 'm' => 100, 'y' => 100, 'k' => 0]
$cmyk = $color->cmyk();

// FF0000
$hex = $color->hex();

// #FF0000 or rgb(255,255,255,1)
$css = $color->css();
```

### Modify A Color
Modification methods have 3 arguments used to control how the modification is applied. Like so:

```php
method_name(float $adjustment, bool $as_percentage = FALSE, bool $set_absolute = TRUE)
```

* `$adjustment` is a integer/float that dictates the amount of change.
* `$as_percentage` is a boolean value that dictates whether or not to treat `$adjustment` as a percentage.
* `$set_absolute` is a boolean value that dictates whether to set `$adjustment` as the actual value or to treat it as a relative value.

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
You can also blend 2 colors using the `blend()` method.

```php
// Blending 2 colors evenly
$color1 = new color('ff0000');
$color2 = new color('00ff00');
$color3 = $color1->blend($color2);
echo $color3->hex(); // 7F7F00

// Blending 2 colors where you want 75% of color 1 and 25% of color 2
$color1 = new color('ffffff');
$color2 = new color('000000');
$color3 = $color1->blend($color2, 25);
echo $color3->hex(); // C0C0C0
```

### Creating Color Schemes
You create 10 different color schemes for every single color. That gives you up to 167,772,160 possible color schemes!

Although the below only shows you how to use `hex_scheme()`, you can also use `rgb_scheme()`, `hsl_scheme()`, and `cmyk_scheme()`.

```php
$color = new color('ff0000');

// $scheme = ['FF0000', '990000', 'CC0000', 'FF2929', 'FF5252']
$scheme = $color->hex_scheme('shades');

// $scheme = ['FF0000', 'D60000', 'FF2929', 'B30000', '800000']
$scheme = $color->hex_scheme('monochromatic');

// $scheme = ['FF0000', 'FF0099', 'F82565', 'F86525', 'FF9900']
$scheme = $color->hex_scheme('analogous');

// $scheme = ['FF0000', 'FF6666', 'FF3333', '00EAFF', '33EEFF']
$scheme = $color->hex_scheme('complementary');

// $scheme = ['FF0000', '00FF00', 'FF5C5C', '0000FF', '5C5CFF']
$scheme = $color->hex_scheme('triad');

// $scheme = ['FF0000', 'AAFF00', 'FF5C5C', 'AA00FF', 'C95CFF']
$scheme = $color->hex_scheme('weighted_triad');

// $scheme = ['FF0000', '00FFFF', '00FF00', 'FF5C5C', '0000FF']
$scheme = $color->hex_scheme('tetrad');

// $scheme = ['FF0000', '00FFAA', 'AAFF00', 'FF5C5C', 'AA00FF']
$scheme = $color->hex_scheme('weighted_tetrad');

// $scheme = ['FF0000', 'F7D082', 'F5C25C', '5CF582', '82F7D0']
$scheme = $color->hex_scheme('compound');

// $scheme = ['FF0000', '0066FF', '00FFFF', 'FF5C5C', 'FF9900']
$scheme = $color->hex_scheme('rectangular');
```

### Generate Random Colors
You can also generate random colors using the `rgb_rand()` and `hsl_rand()` methods **OR** using the `generate` class.

```php
use projectcleverweb\color\generate as color_gen;

$color1 = new color('000000');
$color2 = $color1->rgb_rand(); // Generate any random color
echo $color2->hex(); // Example: 05FBA2

// OR

$color = new color(color_gen::rgb_rand(128, 255, 0, 0, 0, 0)); // Generate a random bright red
echo $color->hex(); // Example: AB0000
```

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
To view a copy of this license, visit [creativecommons.org/licenses/by-sa/4.0](http://creativecommons.org/licenses/by-sa/4.0/)

The PHP-Color source code by Nicholas Jordon is licensed under
the MIT License. To view a copy of this license, visit [njordon.mit-license.org](https://njordon.mit-license.org/@2016)
