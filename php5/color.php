<?php
/**
 * Color Data Class
 * ================
 * Stores data about a particular color in multiple formats.
 */

namespace projectcleverweb\color;

/**
 * Color Data Class
 * ================
 * Stores data about a particular color in multiple formats.
 */
class color implements \Serializable, \JsonSerializable {
	
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
	 * $the current colors alpha channel (Opacity)
	 * @var float
	 */
	protected $alpha = 100.0;
	
	/**
	 * Takes an input color and imports it as its respective type.
	 * 
	 * @param mixed  $color An RGB (array), HSL (array), Hex (string), Integer (hex), or CMYK (array) representation of a color.
	 * @param string $type  (optional) The type to try to import it as
	 */
	public function __construct($color, $type = '') {
		if (is_a($color, __CLASS__)) {
			$type = 'color';
		} elseif (empty($type) || !is_callable(array(__CLASS__, 'import_'.$type))) {
			$type = static::get_type($color);
		}
		call_user_func(array(__CLASS__, 'import_'.$type), $color);
	}
	
	/**
	 * Shortcut for invoking into an HSL array
	 * 
	 * @return array The HSL array
	 */
	public function hsl() {
		$temp = $this->hsl;
		return $temp();
	}
	
	/**
	 * Serializes this object.
	 * 
	 * @return string The serialized object
	 */
	public function serialize() {
		return json_encode($this->rgb + array('a' => $this->alpha));
	}
	
	/**
	 * Unserializes this object.
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
	 * Serializes this object into JSON.
	 * 
	 * @return string The serialized object
	 */
	public function jsonSerialize() {
		return $this->rgb + array('a' => $this->alpha);
	}
	
	/**
	 * Determine the type of color being used.
	 * 
	 * @param  mized  $color The color in question
	 * @return string        The color type as a string, returns 'error' if $color is invalid
	 */
	public static function get_type($color) {
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
	 * @param  array  $color The color in question
	 * @return string        The color type as a string, returns 'error' if $color is invalid
	 */
	protected static function _get_array_type($color) {
		$color = array_change_key_case($color);
		unset($color['a']); // ignore alpha channel
		ksort($color);
		$type  = implode('', array_keys($color));
		$types = array(
			'bgr'  => 'rgb',
			'hls'  => 'hsl',
			'bhs'  => 'hsb',
			'ckmy' => 'cmyk'
		);
		if (isset($types[$type])) {
			return $types[$type];
		}
		return 'error';
	}
	
	/**
	 * Get (and set) the alpha channel
	 * 
	 * @param  mixed $new_alpha If numeric, the alpha channel is set to this value
	 * @return float            The current alpha value
	 */
	public function alpha($new_alpha = NULL) {
		if (is_numeric($new_alpha)) {
			$this->alpha = (float) $new_alpha;
		}
		return $this->alpha;
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
		$this->import_rgb(array(0, 0, 0));
	}
	
	/**
	 * Import the alpha channel from a color array, or create one if it doesn't exist
	 * 
	 * @param  array $color The color array to check
	 * @return void
	 */
	protected function import_alpha($color) {
		if (isset($color['a'])) {
			$this->alpha = (float) $color['a'];
		} else {
			$this->alpha = 100.0;
		}
	}
	
	/**
	 * Handles importing of another instance of color
	 * 
	 * @return void
	 */
	protected function import_color($color) {
		$this->rgb   = $color->rgb;
		$this->hex   = $color->hex;
		$this->hsl   = clone $color->hsl;
		$this->alpha = $color->alpha;
	}
	
	/**
	 * Imports a RGB array.
	 * 
	 * @param  array $color Array with offsets 'r', 'g', 'b'
	 * @return void
	 */
	public function import_rgb($color) {
		regulate::rgb_array($color);
		$this->rgb = array_intersect_key($color, array('r' => 0, 'g' => 0, 'b' => 0));
		$this->hex = convert::rgb_to_hex($this->rgb['r'], $this->rgb['g'], $this->rgb['b']);
		$this->hsl = new hsl($this->rgb);
		$this->import_alpha($color);
	}
	
	/**
	 * Imports a hsl array.
	 * 
	 * @param  array $color Array with offsets 'h', 's', 'l'
	 * @return void
	 */
	public function import_hsl($color) {
		regulate::hsl_array($color);
		$this->rgb = convert::hsl_to_rgb($color['h'], $color['s'], $color['l']);
		$this->hsl = new hsl($this->rgb);
		$this->hex = convert::rgb_to_hex($this->rgb['r'], $this->rgb['g'], $this->rgb['b']);
		$this->import_alpha($color);
	}
	
	/**
	 * Imports a hsb array.
	 * 
	 * @param  array $color Array with offsets 'h', 's', 'b'
	 * @return void
	 */
	public function import_hsb($color) {
		regulate::hsb_array($color);
		$this->rgb = convert::hsb_to_rgb($color['h'], $color['s'], $color['b']);
		$this->hsl = new hsl($this->rgb);
		$this->hex = convert::rgb_to_hex($this->rgb['r'], $this->rgb['g'], $this->rgb['b']);
		$this->import_alpha($color);
	}
	
	/**
	 * Converts a hexadecimal string into an RGB array and imports it.
	 * 
	 * @param  string $color Hexadecimal string
	 * @return void
	 */
	public function import_hex($color) {
		regulate::hex($color);
		$this->import_rgb(convert::hex_to_rgb($color));
	}
	
	/**
	 * Converts an integer to a hexadecimal string and imports it.
	 * 
	 * @param  int $color An integer
	 * @return void
	 */
	public function import_int($color) {
		regulate::hex_int($color);
		$this->import_hex(str_pad(base_convert($color, 10, 16), 6, '0', STR_PAD_LEFT));
	}
	
	/**
	 * Imports a CMYK array
	 * 
	 * @param  array $color Array with offsets 'c', 'm', 'y', 'k'
	 * @return void
	 */
	public function import_cmyk($color) {
		regulate::cmyk_array($color);
		$this->import_rgb(convert::cmyk_to_rgb($color['c'], $color['m'], $color['y'], $color['k']));
		$this->import_alpha($color);
	}
}
