<?php


namespace projectcleverweb\color;

class regulate {
	
	public static function percent(float &$value) {
		$value = abs($value) % 101;
	}
	
	public static function rgb(int &$value) {
		$value = abs($value) % 256;
	}
	
	public static function rgb_array(array &$rgb_array) {
		static::rgb($rgb_array['r']);
		static::rgb($rgb_array['g']);
		static::rgb($rgb_array['b']);
	}
	
	public static function hsl(float &$value, string $offset) {
		if (strtolower($offset) == 'h') {
			$value = abs($value) % 360;
		}
		static::percent($value);
	}
	
	public static function hsl_array(array &$hsl_array) {
		static::hsl($hsl_array['h'], 'h');
		static::hsl($hsl_array['s'], 's');
		static::hsl($hsl_array['l'], 'l');
	}
	
	public static function cmyk(float &$value) {
		static::percent($value);
	}
	
	public static function cmyk_array(array &$cmyk_array) {
		static::cmyk($cmyk_array['c']);
		static::cmyk($cmyk_array['m']);
		static::cmyk($cmyk_array['y']);
		static::cmyk($cmyk_array['k']);
	}
	
	public static function hex(string &$str) {
		static::_validate_hex_str($color);
		static::_strip_hash($color);
		static::_expand_shorthand($color);
	}
	
	public static function hex_int(int &$value) {
		$value = abs($value) % 0x1FFFFFF;
	}
	
	
	protected static function _strip_hash(&$hex) {
		if (is_string($hex) && substr($hex, 0 ,1) == '#') {
			$hex = substr($hex, 1);
		}
	}
	
	protected static function _expand_shorthand(string &$hex_str) {
		if (strlen($hex) === 3) {
			$r = $hex[0];
			$g = $hex[1];
			$b = $hex[2];
			$hex_str = $r.$r.$g.$g.$b.$b;
		}
	}
	
	protected static function _validate_hex_str(&$hex_str) {
		if (is_string($hex_str) && preg_match('/\A#?(?:[0-9a-f]{3}|[0-9a-f]{6}|[0-9a-f]{8})\Z/i', $hex_str)) {
			return;
		}
		// Error - Force color and trigger notice
		$hex_str = '000000';
		// [todo] Trigger Error
	}
	
}
