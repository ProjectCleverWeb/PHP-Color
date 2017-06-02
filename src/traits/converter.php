<?php
/**
 * Conversion Class
 * ================
 * Responsible for all the conversion method between Hex, RGB, HSL, HSB, and CMYK
 */

namespace projectcleverweb\color\traits;

/**
 * Conversion Class
 * ================
 * Responsible for all the conversion method between Hex, RGB, HSL, HSB, and CMYK
 */
trait converter {
	
	protected static function error($message) {
		return \projectcleverweb\color\error::trigger(0, $message);
	}
	
	protected static function _validate_array_input($input) {
		if (!is_array($input)) {
			static::error(sprintf(
				'%s input must be of type "array", input was of type "%s"',
				strtoupper(implode('', static::$valid_keys)),
				gettype($input)
			));
			$input = static::$default_value;
		}
		$input = array_change_key_case($input);
		$array = static::$default_value;
		foreach (static::$valid_keys as $key) {
			if (!isset($input[$key])) {
				static::error(sprintf(
					'Key "%s" missing from %s array',
					$key,
					strtoupper(implode('', static::$valid_keys))
				));
				$input[$key] = $array[$key];
			}
			$array[$key] = (float) filter_var($input[$key], FILTER_VALIDATE_FLOAT);
		}
		return $array;
	}
	
	public static function _validate_hex_input($input) {
		if (is_int($input)) {
			return str_pad(dechex($input % 16777216), 6, '0', STR_PAD_LEFT);
		} elseif (is_string($input)) {
			return static::_validate_hex_input_str($input);
		}
		static::error(sprintf(
			'hex input must be of type "string" or "integer", input was of type "%s"',
			gettype($input)
		));
		return static::$default_value;
	}
	
	protected static function _validate_hex_input_str(string $input) :string {
		$input = strtolower($input);
		if ($input[0] == '#') {
			$input = substr($input, 1);
		}
		if (!preg_match('([0-9a-f]{6}|[0-9a-f]{3})', $input)) {
			static::error('invalid hex string input');
			return static::$default_value;
		}
		return static::_expand_hex_str($input);
	}
	
	protected static function _expand_hex_str(string $input) : string {
		if (strlen($input) == 3) {
			$input = $input[0].$input[0].$input[1].$input[1].$input[2].$input[2];
		}
		return $input;
	}
	
	/**
	 * Color delta algorithm
	 * 
	 * @param  float $rgb   The R, G, or B value
	 * @param  float $max   The max RGB value
	 * @param  float $delta The delta value ($max - $min)
	 * @return float        The color delta
	 */
	protected static function _rgbhsl_delta_rgb(float $rgb, float $max, float $delta) {
		return ((($max - $rgb) / 6) + ($delta / 2)) / $delta;
	}
	
	/**
	 * Calculate the hue as a percentage from RGB
	 * 
	 * @param  float &$h    The variable to modify as hue
	 * @param  float $r     The red value as a percentage
	 * @param  float $g     The green value as a percentage
	 * @param  float $b     The blue value as a percentage
	 * @param  float $max   The max RGB value
	 * @param  float $delta The delta value ($max - $min)
	 * @return void
	 */
	protected static function _rgbhsl_hue(float &$h, float $r, float $g, float $b, float $max, float $delta) {
		$delta_r = static::_rgbhsl_delta_rgb($r, $max, $delta);
		$delta_g = static::_rgbhsl_delta_rgb($g, $max, $delta);
		$delta_b = static::_rgbhsl_delta_rgb($b, $max, $delta);
		
		$h = (2 / 3) + $delta_g - $delta_r;
		if ($r == $max) {
			$h = $delta_b - $delta_g;
		} elseif ($g == $max) {
			$h = (1 / 3) + $delta_r - $delta_b;
		}
		if ($h < 0) {
			$h++;
		}
	}
	
	/**
	 * Handle low hue values
	 * 
	 * @param  float  &$r The red value to modify
	 * @param  float  &$g The green value to modify
	 * @param  float  &$b The blue value to modify
	 * @param  float  $c  Potential R, G, or B value
	 * @param  float  $x  Potential R, G, or B value
	 * @param  float  $h  The hue
	 * @return void
	 */
	protected static function _hslrgb_low(float &$r, float &$g, float &$b, float $c, float $x, float $h) {
		if ($h < 60) {
			$r = $c;
			$g = $x;
			$b = 0;
		} elseif ($h < 120) {
			$r = $x;
			$g = $c;
			$b = 0;
		} else {
			$r = 0;
			$g = $c;
			$b = $x;
		}
	}
	
	/**
	 * Handle high hue values
	 * 
	 * @param  float  &$r The red value to modify
	 * @param  float  &$g The green value to modify
	 * @param  float  &$b The blue value to modify
	 * @param  float  $c  Potential R, G, or B value
	 * @param  float  $x  Potential R, G, or B value
	 * @param  float  $h  The hue
	 * @return void
	 */
	protected static function _hslrgb_high(float &$r, float &$g, float &$b, float $c, float $x, float $h) {
		if ($h < 240) {
			$r = 0;
			$g = $x;
			$b = $c;
		} else {
			$r = $x;
			$g = 0;
			$b = $c;
		}
	}
}
