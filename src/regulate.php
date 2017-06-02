<?php
/**
 * I/O Regulator Class
 * ===================
 * Allows you to reasonably regulate method/function input and output for
 * various types of color values and color arrays.
 */

namespace projectcleverweb\color;

/**
 * I/O Regulator Class
 * ===================
 * Allows you to reasonably regulate method/function input and output for
 * various types of color values and color arrays.
 */
class regulate {
	
	/**
	 * Forces a float to be within the range of 0 and 100.
	 * 
	 * @param  float &$value The value to modify
	 * @return void
	 */
	public static function percent(float &$value) {
		$value = static::max(abs($value), 100);
	}
	
	/**
	 * Forces a float to be within the range of 0 and 255.
	 * 
	 * @param  float &$value The value to modify
	 * @return void
	 */
	public static function rgb(int &$value) {
		$value = static::max(abs($value), 255);
	}
	
	/**
	 * Forces and RGB array to have specific offsets, and max values.
	 * 
	 * @param  array &$rgb_array The RGB array to modify
	 * @return void
	 */
	public static function rgb_array(array &$rgb_array) {
		static::standardize_array($rgb_array, ['r', 'g', 'b']);
		static::rgb($rgb_array['r']);
		static::rgb($rgb_array['g']);
		static::rgb($rgb_array['b']);
	}
	
	/**
	 * Forces a float to be within the range of 0 and 100 or if the offset is
	 * 'h' 0 and 359.
	 * 
	 * @param  float &$value  The value to modify
	 * @param  string $offset The offset that is being modified
	 * @return void
	 */
	public static function hsl(float &$value, string $offset) {
		if (strtolower($offset) == 'h') {
			$value = static::max(abs($value), 359);
		} else {
			static::percent($value);
		}
	}
	
	/**
	 * Forces and HSL array to have specific offsets, and max values.
	 * 
	 * @param  array &$hsl_array The HSL array to modify
	 * @return void
	 */
	public static function hsl_array(array &$hsl_array) {
		static::standardize_array($hsl_array, ['h', 's', 'l']);
		static::hsl($hsl_array['h'], 'h');
		static::hsl($hsl_array['s'], 's');
		static::hsl($hsl_array['l'], 'l');
	}
	
	/**
	 * Forces and HSL array to have specific offsets, and max values.
	 * 
	 * @param  array &$hsl_array The HSL array to modify
	 * @return void
	 */
	public static function hsb_array(array &$hsl_array) {
		static::standardize_array($hsl_array, ['h', 's', 'b']);
		static::hsl($hsl_array['h'], 'h');
		static::hsl($hsl_array['s'], 's');
		static::hsl($hsl_array['b'], 'b');
	}
	
	/**
	 * Forces a float to be within the range of 0 and 100.
	 * 
	 * @param  float &$value The value to modify
	 * @return void
	 */
	public static function cmyk(float &$value) {
		static::percent($value);
	}
	
	
	/**
	 * Forces a float to be within the range of 0 and 100.
	 * 
	 * @param  float &$value The value to modify
	 * @return void
	 */
	public static function alpha(float &$value) {
		static::percent($value);
	}
	
	/**
	 * Forces and CMYK array to have specific offsets, and max values.
	 * 
	 * @param  array &$cmyk_array The CMYK array to modify
	 * @return void
	 */
	public static function cmyk_array(array &$cmyk_array) {
		static::standardize_array($cmyk_array, ['c', 'm', 'y', 'k']);
		static::cmyk($cmyk_array['c']);
		static::cmyk($cmyk_array['m']);
		static::cmyk($cmyk_array['y']);
		static::cmyk($cmyk_array['k']);
	}
	
	/**
	 * Forces hexadecimal strings to be valid, without a "#", and not to be
	 * shorthand.
	 * 
	 * @param  string &$color The color string to modify
	 * @return void
	 */
	public static function hex(string &$color) {
		static::_validate_hex_str($color);
		static::_strip_hash($color);
		static::_expand_shorthand($color);
	}
	
	/**
	 * Forces hexadecimal integers to be within the range of 0x0 and 0xFFFFFF.
	 * 
	 * @param  int  &$value The value to modify
	 * @return void
	 */
	public static function hex_int(int &$value) {
		$value = static::max(abs($value), 0xFFFFFF);
	}
	
	/**
	 * Strips the hash mark (#) off the beginning of a sting if it has one.
	 * 
	 * @param  string &$hex The hex string
	 * @return void
	 */
	public static function _strip_hash(string &$hex) {
		if (is_string($hex) && substr($hex, 0 ,1) == '#') {
			$hex = substr($hex, 1);
		}
	}
	
	/**
	 * Expand a hex strings in short notation (e.g. 000 => 000000)
	 * 
	 * @param  string &$hex_str The hex string to modify
	 * @return void
	 */
	public static function _expand_shorthand(string &$hex_str) {
		if (strlen($hex_str) === 3) {
			$r = $hex_str[0];
			$g = $hex_str[1];
			$b = $hex_str[2];
			$hex_str = $r.$r.$g.$g.$b.$b;
		}
	}
	
	/**
	 * Verify that the hex string is actually a hex string. If not force it to
	 * '000000'
	 * 
	 * @param  string &$hex_str The hex string to modify
	 * @return void
	 */
	public static function _validate_hex_str(string &$hex_str, bool $check_only = FALSE) :bool {
		if (preg_match('/\A#?(?:[0-9a-f]{3}|[0-9a-f]{6})\Z/i', $hex_str)) {
			return TRUE;
		}
		if (!$check_only) {
			error::trigger(error::INVALID_ARGUMENT, sprintf(
				'The input of %s::%s() was not a valid hex string, forcing value to 000000',
				__CLASS__,
				__FUNCTION__
			));
			$hex_str = '000000';
		}
		return FALSE;
	}
	
	/**
	 * Force an array to have specific lower-case keys. If the array is an indexed
	 * array and the keys are provided, convert it to an associative array.
	 * 
	 * @param  array &$array The array to be modified
	 * @return void
	 */
	public static function standardize_array(array &$array, array $keys = []) {
		if (!empty($keys) && array_keys($array) === range(0, count($array) - 1) && count($array) == count($keys)) {
			$array = array_combine($keys, $array);
		} else {
			$array = array_change_key_case($array) + array_fill_keys($keys, 0);
		}
	}
	
	/**
	 * Absolute and divide any number so it fits between 0 and $max
	 * 
	 * @param  float  $number The original number
	 * @param  float  $max    The maximum value $number should be
	 * @return float          The resulting number as a float
	 */
	public static function max(float $number, float $max) :float {
		$max = abs($max);
		if ($number > $max) {
			$number -= floor($number / ($max + 1)) * ($max + 1);
		}
		return $number;
	}
	
	/**
	 * Simple dividing method to handle division by 0
	 * 
	 * @param  float  $number  The number to divide
	 * @param  float  $divisor The number to divide by
	 * @return float           The result
	 */
	public static function div(float $number, float $divisor) :float {
		if ($divisor == 0) {
			return 0;
		}
		return $number / $divisor;
	}
}
