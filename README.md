# PHP Color &nbsp; [![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://njordon.mit-license.org/@2016) [![Travis Build Status](https://img.shields.io/travis/ProjectCleverWeb/PHP-Color.svg?maxAge=2592000&style=flat-square)](https://travis-ci.org/ProjectCleverWeb/PHP-Color) [![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/ProjectCleverWeb/PHP-Color.svg?maxAge=2592000&style=flat-square)](https://scrutinizer-ci.com/g/ProjectCleverWeb/PHP-Color/) [![Scrutinizer Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ProjectCleverWeb/PHP-Color.svg?maxAge=2592000&style=flat-square)](https://scrutinizer-ci.com/g/ProjectCleverWeb/PHP-Color/) [![Code Climate Code GPA](https://img.shields.io/codeclimate/github/kabisaict/flow.svg?maxAge=2592000&style=flat-square)](https://codeclimate.com/github/ProjectCleverWeb/PHP-Color)

This is a PHP 7 library for working with RGB, HSL, and Hexadecimal colors. Create schemes, modify specific color properties, export CMYK, and make color suggestions quickly and easily with this stand-alone library.

Demo: [jsfiddle.net/t3LL4q14](http://jsfiddle.net/t3LL4q14/embedded/result/)

### Download:

[![GitHub release](https://img.shields.io/github/release/ProjectCleverWeb/PHP-Color.svg?maxAge=2592000&style=flat-square)](https://github.com/ProjectCleverWeb/PHP-Color/releases)

Copyright &copy; 2016 Nicholas Jordon &mdash; All Rights Reserved

## Features

* Convert any color between the RGB, HSL, HSB, Hexadecimal, and CMYK color spectrums.
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

### Simple Example
Lets say you want to take an input color (in this case red) and convert it to hsl. You also want to know if you should use black or white text on top of this color, and want to suggest some similar colors. You could achieve all that with the code below:

```php
$input      = 'f00';
$color      = new color($input);
$hex        = $color->hex();
$hsl        = strtr('h, s%, l%', $color->hsl());
$text_color = ($color->is_dark() ? 'FFFFFF' : '000000');
$similar    = implode(', ', array_slice($color->scheme('analogous'), 1));

$template = "Hex: %s
HSL: %s
Text Color: %s
Similar: %s";

printf($template, $hex, $hsl, $text_color, $similar);
```

#### Output:

```
Hex: FF0000
HSL: 0, 100%, 50%
Text Color: FFFFFF
Similar: FF0099, F82565, F86525, FF9900
```

### Importing your color
Colors can be imported several ways. The below all create the exact same object:

```php
// Import as a hexadecimal string (the '#' is optional)
$color = new color('#FF0000');

// Import as a RGB array
$color = new color(['r' => 255, 'g' => 0, 'b' => 0]);

// Import as a HSL array
$color = new color(['h' => 0, 's' => 100, 'l' => 50]);

// Import as a HSB array
$color = new color(['h' => 0, 's' => 100, 'b' => 100]);

// Import as a CMYK array
$color = new color(['c' => 0, 'm' => 100, 'y' => 100, 'k' => 0]);

// Import as a hexadecimal integer
$color = new color(0xff0000);

// Import as a RGB array with Alpha channel (Alpha is only support with array inputs and must use the 'a' offset)
$color = new color(['r' => 255, 'g' => 0, 'b' => 0, 'a' => 50]);
```

### Conversions

You can convert any input color between the Hexadecimal, RGB, HSL, HSB, CMYK, and CSS values.

```php
$color = new color('#FF0000');

// ['r' => 255, 'g' => 0, 'b' => 0]
$rgb = $color->rgb();

// ['h' => 0, 's' => 100, 'l' => 50]
$hsl = $color->hsl();

// ['h' => 0, 's' => 100, 'b' => 100]
$hsb = $color->hsb();

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
echo $color3->hex(); // 808000

// Blending 2 colors where you want 75% of color 1 and 25% of color 2
$color1 = new color('ffffff');
$color2 = new color('000000');
$color3 = $color1->blend($color2, 25);
echo $color3->hex(); // BFBFBF
```

### Creating Color Schemes
You create 10 different color schemes for every single color. That gives you up to 167,772,160 possible color schemes!

```php
$color = new color('ff0000');

// $scheme = ['FF0000', '990000', 'CC0000', 'FF2929', 'FF5252']
$scheme = $color->scheme('shades');

// $scheme = ['FF0000', 'D60000', 'FF2929', 'B30000', '800000']
$scheme = $color->scheme('monochromatic');

// $scheme = ['FF0000', 'FF0099', 'F82565', 'F86525', 'FF9900']
$scheme = $color->scheme('analogous');

// $scheme = ['FF0000', 'FF6666', 'FF3333', '00EAFF', '33EEFF']
$scheme = $color->scheme('complementary');

// $scheme = ['FF0000', '00FF00', 'FF5C5C', '0000FF', '5C5CFF']
$scheme = $color->scheme('triad');

// $scheme = ['FF0000', 'AAFF00', 'FF5C5C', 'AA00FF', 'C95CFF']
$scheme = $color->scheme('weighted_triad');

// $scheme = ['FF0000', '00FFFF', '00FF00', 'FF5C5C', '0000FF']
$scheme = $color->scheme('tetrad');

// $scheme = ['FF0000', '00FFAA', 'AAFF00', 'FF5C5C', 'AA00FF']
$scheme = $color->scheme('weighted_tetrad');

// $scheme = ['FF0000', 'F7D082', 'F5C25C', '5CF582', '82F7D0']
$scheme = $color->scheme('compound');

// $scheme = ['FF0000', '0066FF', '00FFFF', 'FF5C5C', 'FF9900']
$scheme = $color->scheme('rectangular');
```

The `scheme()` method supports returning different color spaces through the second argument. The second argument can be either `hex`, `rgb`, `hsl`, `hsb`, or `cmyk`.

```php
$color = new color('ff0000');

// Hexadecimal (default)
echo 'hex: '.json_encode($color->scheme('shades', 'hex')).PHP_EOL;

// RGB
echo 'rgb: '.json_encode($color->scheme('shades', 'rgb')).PHP_EOL;

// HSL
echo 'hsl: '.json_encode($color->scheme('shades', 'hsl')).PHP_EOL;

// HSB
echo 'hsb: '.json_encode($color->scheme('shades', 'hsb')).PHP_EOL;

// CMYK
echo 'cmyk: '.json_encode($color->scheme('shades', 'cmyk'));
```

#### Output:

```
hex: ["FF0000","990000","CC0000","FF2929","FF5252"]
rgb: [{"r":255,"g":0,"b":0},{"r":153,"g":0,"b":0},{"r":204,"g":0,"b":0},{"r":255,"g":41,"b":41},{"r":255,"g":82,"b":82}]
hsl: [{"h":0,"s":100,"l":50},{"h":0,"s":100,"l":30},{"h":0,"s":100,"l":40},{"h":0,"s":100,"l":58},{"h":0,"s":100,"l":66}]
hsb: [{"h":0,"s":100,"b":100},{"h":0,"s":100,"b":60},{"h":0,"s":100,"b":80},{"h":0,"s":83.922,"b":100},{"h":0,"s":67.843,"b":100}]
cmyk: [{"c":0,"m":100,"y":100,"k":0},{"c":0,"m":60,"y":60,"k":40},{"c":0,"m":80,"y":80,"k":20},{"c":0,"m":84,"y":84,"k":0},{"c":0,"m":68,"y":68,"k":0}]
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
