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

## Installation &amp; Usage

See the [Official Wiki on Github](https://github.com/ProjectCleverWeb/PHP-Color/wiki) for all documentation.

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

The PHP-Color documentation &amp; source code (hereafter referred to as "Library") by Nicholas Summers (hereafter referred to as "Author") is licensed
under the Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License with the below "Additional Terms" superseding it.
To view a copy of the Creative Commons license, visit [creativecommons.org/licenses/by-nc-nd/4.0](https://creativecommons.org/licenses/by-nc-nd/4.0/). From now on "License" refers to this combination of licensing.

**Additional Terms:**

1. Any person or non-profit entity or may use this Library for personal or professional use as long as the Library as well as any of its parts are not sold in any fashion, and users are not forced to pay to use it in any way.
2. Anyone may use this Library for purely internal use as long as the Library as well as any of its parts are available without payment and are not publicly accessible.
3. Anyone seeking to sell this Library or use this Library in a commercial environment MUST first obtain a OEM license from the Author.
4. Anyone in direct violation of this License is liable for a minimum of $50,000 in damages, plus an additional $10 per user, and agrees to refund any charge or fees collected as a result of violating this License.
5. By downloading or using this Library you agree to all the License terms.
