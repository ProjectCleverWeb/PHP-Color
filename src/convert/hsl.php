<?php

namespace projectcleverweb\color\convert;

class hsl implements \projectcleverweb\color\interfaces\converter {
	use \projectcleverweb\color\traits\converter;
	
	protected static $valid_keys = array(
		'h',
		's',
		'l'
	);
	
	protected static $default_value = array(
		'h' => 0,
		's' => 0,
		'l' => 0
	);
	
	public static function to_rgb($input) :array {
		$hsl = static::_validate_array_input($input);
		$hsl['s'] /= 100;
		$hsl['l'] /= 100;
		$c  = (1 - abs((2 * $hsl['l']) - 1)) * $hsl['s'];
		$x  = $c * (1 - abs(fmod(($hsl['h'] / 60), 2) - 1));
		$m  = $hsl['l'] - ($c / 2);
		$r  = $c;
		$g  = 0;
		$b  = $x;
		
		if ($hsl['h'] < 180) {
			static::_hslrgb_low($r, $g, $b, $c, $x, $hsl['h']);
		} elseif ($hsl['h'] < 300) {
			static::_hslrgb_high($r, $g, $b, $c, $x, $hsl['h']);
		}
		
		return [
			'r' => (int) round(($r + $m) * 255),
			'g' => (int) round(($g + $m) * 255),
			'b' => (int) round(($b + $m) * 255)
		];
	}
	
	public static function to_hex($input) :string {
		return rgb::to_hex(static::to_rgb($input));
	}
	
	public static function to_cmyk($input) :array {
		return rgb::to_cmyk(static::to_rgb($input));
	}
	
	public static function to_hsl($input) :array {
		return static::_validate_array_input($input);
	}
	
	public static function to_hsb($input) :array {
		return rgb::to_hsb(static::to_rgb($input));
	}
}
