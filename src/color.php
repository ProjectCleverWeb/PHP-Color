<?php


namespace projectcleverweb\color;

/**
 * Color Data Class
 * ================
 * Stores data about a particular color in multiple formats.
 */
class color implements \Serializable {
	
	/**
	 * The current color as a hexadecimal string
	 * @var string
	 */
	public $hex;
	
	/**
	 * The current color as a RGB array
	 * @var array
	 */
	public $rgb;
	
	/**
	 * The current color as an instance of hsl (which implements ArrayAccess)
	 * @var hsl
	 */
	public $hsl;
	
	/**
	 * Takes an input color and imports it as its respective type.
	 * 
	 * @param mixed  $color An RGB (array), HSL (array), Hex (string), Integer (hex), or CMYK (array) representation of a color.
	 * @param string $type  (optional) The type to try to import it as
	 */
	public function __construct($color, string $type = '') {
		if (is_object($color) && is_a($color, __CLASS__)) {
			$type = 'color';
		} elseif (empty($type) || !is_callable([__CLASS__, 'import_'.$type])) {
			$type = static::get_color_type($color);
		}
		call_user_func([__CLASS__, 'import_'.$type], $color);
	}
	
	/**
	 * Serializes this object into JSON.
	 * 
	 * @return string The serialized object
	 */
	public function serialize() :string {
		return json_encode($this->rgb);
	}
	
	/**
	 * Unserializes this object from JSON.
	 * 
	 * @param  string $serialized The object as a serialized string
	 * @return void
	 */
	public function unserialize($serialized) {
		$unserialized = (array) json_decode((string) $serialized);
		regulate::rgb_array($unserialized);
		$this->import_rgb($unserialized);
	}
	
	/**
	 * Determine the type of color being used.
	 * 
	 * @param  mized  $color The color in question
	 * @return string        The color type as a string, returns 'error' if $color is invalid
	 */
	public static function get_color_type($color) :string {
		if (is_array($color)) {
			return static::_get_array_type($color);
		} elseif (is_string($color)) {
			return 'hex';
		} elseif (is_int($color)) {
			return 'int';
		}
		return 'error';
	}
	
	/**
	 * Determine the type of color being used if it is an array.
	 * 
	 * @param  mized  $color The color in question
	 * @return string        The color type as a string, returns 'error' if $color is invalid
	 */
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
	
	/**
	 * Handles general errors when importing, and forces the input to be valid.
	 * 
	 * @return void
	 */
	protected function import_error() {
		error::call(sprintf(
			'The color supplied to %s\'s constructor was not valid',
			__CLASS__
		));
		$this->import_rgb([0, 0, 0]);
	}
	
	/**
	 * Handles importing of another instance of color
	 * 
	 * @return void
	 */
	protected function import_color(color $color) {
		$this->rgb = $color->rgb;
		$this->hex = $color->hex;
		$this->hsl = clone $color->hsl;
	}
	
	/**
	 * Imports a RGB array.
	 * 
	 * @param  array $color Array with offsets 'r', 'g', 'b'
	 * @return void
	 */
	public function import_rgb(array $color) {
		regulate::rgb_array($color);
		$this->rgb = $color;
		$this->hex = generate::rgb_to_hex($this->rgb['r'], $this->rgb['g'], $this->rgb['b']);
		$this->hsl = new hsl($this->rgb);
	}
	
	/**
	 * Imports a hsl array.
	 * 
	 * @param  array $color Array with offsets 'h', 's', 'l'
	 * @return void
	 */
	public function import_hsl(array $color) {
		regulate::hsl_array($color);
		$this->rgb = generate::hsl_to_rgb($color['h'], $color['s'], $color['l']);
		$this->hsl = new hsl($this->rgb);
		$this->hex = generate::rgb_to_hex($this->rgb['r'], $this->rgb['g'], $this->rgb['b']);
	}
	
	/**
	 * Converts a hexadecimal string into an RGB array and imports it.
	 * 
	 * @param  string $color Hexadecimal string
	 * @return void
	 */
	public function import_hex(string $color) {
		regulate::hex($color);
		$this->import_rgb(generate::hex_to_rgb($color));
	}
	
	/**
	 * Converts an integer to a hexadecimal string and imports it.
	 * 
	 * @param  int $color An integer
	 * @return void
	 */
	public function import_int(int $color) {
		regulate::hex_int($color);
		$this->import_hex(str_pad(base_convert($color, 10, 16), 6, '0', STR_PAD_LEFT));
	}
	
	/**
	 * Imports a CMYK array
	 * 
	 * @param  array $color Array with offsets 'c', 'm', 'y', 'k'
	 * @return void
	 */
	public function import_cmyk(array $color) {
		regulate::cmyk_array($color);
		$this->import_rgb(generate::cmyk_to_rgb($color['c'], $color['m'], $color['y'], $color['k']));
	}
}

