<?php

namespace projectcleverweb\color\convert;

class rgb implements \projectcleverweb\color\interfaces\converter {
	use \projectcleverweb\color\traits\converter;
	
	protected static $valid_keys = array(
		'r',
		'g',
		'b'
	);
	
	protected static $default_value = array(
		'r' => 0,
		'g' => 0,
		'b' => 0
	);
	
	public static function to_rgb($input) :array {
		return static::_validate_array_input($input);
	}
	
	public static function to_hex($input) :string {
		$rgb = static::_validate_array_input($input);
		return strtoupper(
			str_pad(dechex($rgb['r']), 2, '0', STR_PAD_LEFT)
			.str_pad(dechex($rgb['g']), 2, '0', STR_PAD_LEFT)
			.str_pad(dechex($rgb['b']), 2, '0', STR_PAD_LEFT)
		);
	}
	
	public static function to_cmyk($input) :array {
		$rgb = static::_validate_array_input($input);
		$rgbp = array(
			'r' => $rgb['r'] / 255 * 100,
			'g' => $rgb['g'] / 255 * 100,
			'b' => $rgb['b'] / 255 * 100
		);
		$k  = 100 - max($rgbp);
		return [
			'c' => ((100 - $rgbp['r'] - $k) / (100 - $k)) * 100,
			'm' => ((100 - $rgbp['g'] - $k) / (100 - $k)) * 100,
			'y' => ((100 - $rgbp['b'] - $k) / (100 - $k)) * 100,
			'k' => $k
		];
	}
	
	public static function to_hsl($input) :array {
		$rgb = static::_validate_array_input($input);
		$r     = $rgb['r'] / 255;
		$g     = $rgb['g'] / 255;
		$b     = $rgb['b'] / 255;
		$min   = min($r, $g, $b);
		$max   = max($r, $g, $b);
		$delta = $max - $min;
		$h     = 0;
		$s     = 0;
		$l     = ($max + $min) / 2;
		
		if ($max != $min) {
			$s = $delta / ($max + $min);
			if ($l >= 0.5) {
				$s = $delta / (2 - $max - $min);
			}
			static::_rgbhsl_hue($h, $r, $g, $b, $max, $delta);
		}
		
		return [
			'h' => $h * 360,
			's' => $s * 100,
			'l' => $l * 100
		];
	}
	
	public static function to_hsb($input) :array {
		$rgb = static::_validate_array_input($input);
		$r   = $rgb['r'] / 255;
		$g   = $rgb['g'] / 255;
		$b   = $rgb['b'] / 255;
		
		$max = max($r, $g, $b);
		$min = min($r, $g, $b);
		$v   = $max;
		$d   = $max - $min;
		$s   = \projectcleverweb\color\regulate::div($d, $max);
		$h   = 0; // achromatic
		if ($max != $min) {
			static::_rgbhsl_hue($h, $r, $g, $b, $max, $d);
		}
		
		$h = $h * 360;
		$s = $s * 100;
		$v = $v * 100;
		
		return ['h' => $h, 's' => $s, 'b' => $v];
	}
}
