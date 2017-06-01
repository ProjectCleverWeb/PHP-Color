<?php

namespace projectcleverweb\color\convert;

class hsb implements \projectcleverweb\color\interfaces\converter {
	use \projectcleverweb\color\traits\converter;
	
	protected static $valid_keys = array(
		'h',
		's',
		'b'
	);
	
	protected static $default_value = array(
		'h' => 0,
		's' => 0,
		'b' => 0
	);
	
	public static function to_rgb($input) :array {
		$hsb = static::_validate_array_input($input);
		if ($hsb['b'] == 0) {
			return ['r' => 0, 'g' => 0, 'b' => 0];
		}
		$hsb['h'] /= 60;
		$hsb['s'] /= 100;
		$hsb['b'] /= 100;
		$i         = floor($hsb['h']);
		$f         = $hsb['h'] - $i;
		$p         = $hsb['b'] * (1 - $hsb['s']);
		$q         = $hsb['b'] * (1 - ($hsb['s'] * $f));
		$t         = $hsb['b'] * (1 - ($hsb['s'] * (1 - $f)));
		$calc      = [[$hsb['b'], $t, $p],[$q, $hsb['b'], $p],[$p, $hsb['b'], $t],[$p, $q, $hsb['b']],[$t, $p, $hsb['b']],[$hsb['b'], $p, $q]];
		return ['r' => $calc[$i][0] * 255, 'g' => $calc[$i][1] * 255, 'b' => $calc[$i][2] * 255];
	}
	
	public static function to_hex($input) :string {
		return rgb::to_hex(static::to_rgb($input));
	}
	
	public static function to_cmyk($input) :array {
		return rgb::to_cmyk(static::to_rgb($input));
	}
	
	public static function to_hsl($input) :array {
		return rgb::to_hsl(static::to_rgb($input));
	}
	
	public static function to_hsb($input) :array {
		return static::_validate_array_input($input);
	}
}
