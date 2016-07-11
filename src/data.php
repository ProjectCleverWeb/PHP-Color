<?php


namespace projectcleverweb\color;

class data extends \stdClass {
	
	private $string;
	private $rgb;
	private $hsl;
	
	public function __construct($color, string $type = '') {
		if (!empty($type)) {
			$type = static::get_color_type($color);
		}
		call_user_func([__CLASS__, 'import_'.$type], $color);
	}
	
	public static function get_color_type($color) :string {
		if (is_array($color)) {
			return static::_get_array_type($color);
		} elseif (is_string($color) && static::_validate_hex_str($color)) {
			return 'hex';
		} elseif (is_int($color)) {
			return 'int';
		}
		return 'error';
	}
	
	protected static function _get_array_type(array $color) :string {
		if (empty(array_diff(['r', 'g', 'b'], array_keys($color)))) {
			return 'rgb';
		} elseif (empty(array_diff(['h', 's', 'l'], array_keys($color)))) {
			return 'hsl';
		} elseif (empty(array_diff(['c', 'm', 'y', 'k'], array_keys($color)))) {
			return 'cmyk';
		}
		return 'error';
	}
	
	protected static function import_error($color) {
		echo 'The value was not a color';
		exit;
	}
	
	public function import_rgb(array $color) {
		$this->rgb = $color;
		$this->hex = generate::rgb_to_hex($this->rgb);
		$this->hsl = new hsl($this->rgb);
	}
	
	public function import_hsl(array $color) {
		$this->hsl = new hsl($color);
		$this->rgb = generate::hsl_to_rgb($color['h'], $color['s'], $color['l']);
		$this->hex = generate::rgb_to_hex($this->rgb);
	}
	
	public function import_hex(string $color) {
		static::_validate_hex_str($color);
		static::_strip_hash($color);
		static::_expand_shorthand($color);
		static::import_rgb(generate::hex_to_rgb($color));
	}
	
	public function import_int(int $color) {
		static::import_hex(str_pad(base_convert($color % 0x1000000, 10, 16), 6, '0', STR_PAD_LEFT));
	}
	
	public function import_cmyk(array $color) {
		static::import_rgb(generate::cmyk_to_rgb($color['c'], $color['m'], $color['y'], $color['k']));
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

