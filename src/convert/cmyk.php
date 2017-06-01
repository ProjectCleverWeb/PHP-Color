<?php

namespace projectcleverweb\color\convert;

class cmyk implements \projectcleverweb\color\interfaces\converter {
	use \projectcleverweb\color\traits\converter;
	
	protected static $valid_keys = array(
		'c',
		'm',
		'y',
		'k'
	);
	
	protected static $default_value = array(
		'c' => 0,
		'm' => 0,
		'y' => 0,
		'k' => 0
	);
	
	public static function to_rgb($input) :array {
		$cmyk       = static::_validate_array_input($input);
		$cmyk['c'] /= 100;
		$cmyk['m'] /= 100;
		$cmyk['y'] /= 100;
		$cmyk['k'] /= 100;
		$r  = 1 - min(1, $cmyk['c'] * (1 - $cmyk['k']) + $cmyk['k']);
		$g  = 1 - min(1, $cmyk['m'] * (1 - $cmyk['k']) + $cmyk['k']);
		$b  = 1 - min(1, $cmyk['y'] * (1 - $cmyk['k']) + $cmyk['k']);
		return [
			'r' => round($r * 255),
			'g' => round($g * 255),
			'b' => round($b * 255)
		];
	}
	
	public static function to_hex($input) :string {
		return rgb::to_hex(static::to_rgb($input));
	}
	
	public static function to_cmyk($input) :array {
		return static::_validate_array_input($input);
	}
	
	public static function to_hsl($input) :array {
		return rgb::to_hsl(static::to_rgb($input));
	}
	
	public static function to_hsb($input) :array {
		return rgb::to_hsb(static::to_rgb($input));
	}
}
