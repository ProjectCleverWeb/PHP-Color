<?php


namespace projectcleverweb\color;

class data extends \stdClass {
	
	private $string;
	private $rgb;
	private $hsl;
	
	public function __construct($hex) {
		if (is_int($hex)) {
			// Convert from PHP hex integer (forcing valid color)
			$hex %= 16777216;
			$hex = base_convert(abs($hex), 10, 16);
		}
		static::_validate_hex_str($hex);
		static::_strip_hash($hex);
		static::_expand_shorthand($hex);
		$this->string = strtoupper($hex);
		$this->rgb = generate::hex_to_rgb($this->string);
		$this->hsl = new hsl($this->rgb);
	}
	
	protected static function _strip_hash(&$hex) {
		if (is_string($hex) && substr($hex, 0 ,1) == '#') {
			$hex = substr($hex, 1);
		}
	}
	
	protected static function _expand_shorthand(string &$hex_str) {
		$hex_str = generate::expand_shorthand($hex_str);
	}
	
	protected static function _validate_hex_str(&$hex_str) {
		if (is_string($hex_str) && preg_match('/\A#?(?:[0-9a-f]{3}|[0-9a-f]{6})\Z/i', $hex_str)) {
			return;
		}
		// Error - Force color and trigger notice
		$hex_str = '000000';
		// [todo] Trigger Error
	}
}

