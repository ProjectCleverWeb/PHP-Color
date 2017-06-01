<?php

namespace projectcleverweb\color\convert;

class hex implements \projectcleverweb\color\interfaces\converter {
	use \projectcleverweb\color\traits\converter;
	
	protected static $default_value = '000000';
	
	public static function to_rgb($input) :array {
		$hex = static::_validate_hex_input($input);
		return [
			'r' => hexdec(substr($hex, 0, 2)),
			'g' => hexdec(substr($hex, 2, 2)),
			'b' => hexdec(substr($hex, 4, 2))
		];
	}
	
	public static function to_hex($input) :string {
		return static::_validate_hex_input($input);
	}
	
	public static function to_cmyk($input) :array {
		return rgb::to_cmyk(static::to_rgb($input));
	}
	
	public static function to_hsl($input) :array {
		return rgb::to_hsl(static::to_rgb($input));
	}
	
	public static function to_hsb($input) :array {
		return rgb::to_hsb(static::to_rgb($input));
	}
}
