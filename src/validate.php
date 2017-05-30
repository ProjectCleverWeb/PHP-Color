<?php

namespace projectcleverweb\color;

class validate {
	
	public static function hex($input) {
		return (is_string($input) && preg_match('/\A\#?([0-9a-f]{6}|[0-9a-f]{3})\Z/i', $input));
	}
	
	public static function rgb($input) {
		if (
			is_array($input)
			&& static::has_keys($input, ['r', 'g', 'b'])
			&& static::in_range($input['r'], 0, 255)
			&& static::in_range($input['g'], 0, 255)
			&& static::in_range($input['b'], 0, 255)
		) {
			return TRUE;
		}
		return FALSE;
	}
	
	public static function hsl($input) {
		if (
			is_array($input)
			&& static::has_keys($input, ['h', 's', 'l'])
			&& static::in_range($input['h'], 0, 359)
			&& static::in_range($input['s'], 0, 100)
			&& static::in_range($input['l'], 0, 100)
		) {
			return TRUE;
		}
		return FALSE;
	}
	
	public static function hsb($input) {
		if (
			is_array($input)
			&& static::has_keys($input, ['h', 's', 'b'])
			&& static::in_range($input['h'], 0, 359)
			&& static::in_range($input['s'], 0, 100)
			&& static::in_range($input['b'], 0, 100)
		) {
			return TRUE;
		}
		return FALSE;
	}
	
	public static function cmyk($input) {
		if (
			is_array($input)
			&& static::has_keys($input, ['c', 'm', 'y', 'k'])
			&& static::in_range($input['c'], 0, 100)
			&& static::in_range($input['m'], 0, 100)
			&& static::in_range($input['y'], 0, 100)
			&& static::in_range($input['k'], 0, 100)
		) {
			return TRUE;
		}
		return FALSE;
	}
	
	public static function css($input) {
		return (is_string($input) && preg_match('/\A(?:(rgb|hsl)\((\d+|\d+\.(?:\d+)?|\.\d+),(\d+|\d+\.(?:\d+)?|\.\d+),(\d+|\d+\.(?:\d+)?|\.\d+)|(rgb|hsl)a\((\d+|\d+\.(?:\d+)?|\.\d+),(\d+|\d+\.(?:\d+)?|\.\d+),(\d+|\d+\.(?:\d+)?|\.\d+),((?:0|1)|(?:0|1)\.(?:\d+)?|\.\d+))\)\Z/i', $input));
	}
	
	public static function has_keys(array $array, array $keys) {
		$result = TRUE;
		foreach ($keys as $key) {
			if (!isset($array[$key]) || !is_numeric($array[$key])) {
				$result = FALSE;
				break;
			}
		}
		return $result;
	}
	
	public static function in_range(float $value, float $min, float $max) :bool {
		return ($value >= $min && $value <= $max);
	}
	
	public static function in_between(float $value, float $min, float $max) :bool {
		return ($value > $min && $value < $max);
	}
}
