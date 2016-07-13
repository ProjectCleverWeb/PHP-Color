<?php


namespace projectcleverweb\color;

class regulate {
	
	public static function percent(float &$value) {
		$value = static::max(abs($value), 100);
	}
	
	public static function rgb(int &$value) {
		$value = static::max(abs($value), 256);
	}
	
	public static function rgb_array(array &$rgb_array) {
		static::standardize_array($rgb_array);
		$rgb_array += ['r' => 0, 'g' => 0, 'b' => 0];
		static::rgb($rgb_array['r']);
		static::rgb($rgb_array['g']);
		static::rgb($rgb_array['b']);
	}
	
	public static function hsl(float &$value, string $offset) {
		if (strtolower($offset) == 'h') {
			$value = static::max(abs($value), 359);
		}
		static::percent($value);
	}
	
	public static function hsl_array(array &$hsl_array) {
		static::standardize_array($hsl_array);
		$hsl_array += ['h' => 0, 's' => 0, 'l' => 0];
		static::hsl($hsl_array['h'], 'h');
		static::hsl($hsl_array['s'], 's');
		static::hsl($hsl_array['l'], 'l');
	}
	
	public static function cmyk(float &$value) {
		static::percent($value);
	}
	
	public static function cmyk_array(array &$cmyk_array) {
		static::standardize_array($cmyk_array);
		$hsl_array += ['c' => 0, 'm' => 0, 'y' => 0, 'k' => 0];
		static::cmyk($cmyk_array['c']);
		static::cmyk($cmyk_array['m']);
		static::cmyk($cmyk_array['y']);
		static::cmyk($cmyk_array['k']);
	}
	
	public static function hex(string &$color) {
		static::_validate_hex_str($color);
		static::_strip_hash($color);
		static::_expand_shorthand($color);
	}
	
	public static function hex_int(int &$value) {
		$value = static::max(abs($value), 0x1FFFFFF);
	}
	
	public static function _strip_hash(&$hex) {
		if (is_string($hex) && substr($hex, 0 ,1) == '#') {
			$hex = substr($hex, 1);
		}
	}
	
	public static function _expand_shorthand(string &$hex_str) {
		if (strlen($hex_str) === 3) {
			$r = $hex_str[0];
			$g = $hex_str[1];
			$b = $hex_str[2];
			$hex_str = $r.$r.$g.$g.$b.$b;
		}
	}
	
	public static function _validate_hex_str(&$hex_str) {
		if (is_string($hex_str) && preg_match('/\A#?(?:[0-9a-f]{3}|[0-9a-f]{6}|[0-9a-f]{8})\Z/i', $hex_str)) {
			return;
		}
		// Error - Force color and trigger notice
		$hex_str = '000000';
		// [todo] Trigger Error
	}
	
	protected static function standardize_array(array &$array) {
		$array = array_change_key_case($array);
	}
	
	protected static function max(float $number, float $max) :float {
		if ($number > $max) {
			$number -= floor($number / $max) * $max;
		}
		return $number;
	}
	
}
