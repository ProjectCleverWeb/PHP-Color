<?php
/**
 * Color Data Class
 * ================
 * Stores data about a particular color in multiple formats.
 */

namespace projectcleverweb\color\data;

use \projectcleverweb\color\regulate;
use \projectcleverweb\color\css;
use \projectcleverweb\color\hsl;
use \projectcleverweb\color\error;
use \projectcleverweb\color\convert; // namespace

/**
 * Color Data Class
 * ================
 * Stores data about a particular color in multiple formats.
 */
class store implements \Serializable, \JsonSerializable {
	
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
	public function __construct($color, string $type = '') {
		if (is_a($color, __CLASS__)) {
			$type = 'color';
		} elseif (empty($type) || !is_callable([__CLASS__, 'import_'.$type])) {
			$type = static::get_type($color);
		}
		call_user_func([__CLASS__, 'import_'.$type], $color);
	}
	
	/**
	 * Shortcut for invoking into an HSL array
	 * 
	 * @return array The HSL array
	 */
	public function hsl() {
		return ($this->hsl)();
	}
	
	/**
	 * Serializes this object.
	 * 
	 * @return string The serialized object
	 */
	public function serialize() :string {
		return json_encode($this->rgb + ['a' => $this->alpha]);
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
	public function jsonSerialize() :array {
		return $this->rgb + ['a' => $this->alpha];
	}
	
	/**
	 * Determine the type of color being used.
	 * 
	 * @param  mized  $color The color in question
	 * @return string        The color type as a string, returns 'error' if $color is invalid
	 */
	public static function get_type($color) :string {
		if (is_array($color)) {
			return static::_get_array_type($color);
		} elseif (is_string($color)) {
			// return static::_get_str_type($color);
			return 'str';
		} elseif (is_int($color)) {
			return 'int';
		}
		return 'error';
	}
	
	protected function _get_str_type(string $color) {
		$color = strtolower(str_replace(array(' ', "\t", "\n", "\r", "\0", "\x0B"), '', $color));
		if (regulate::_validate_hex_str($color, TRUE)) {
			return 'hex';
		} elseif (css::get($color, FALSE)) {
			return 'css';
		} elseif (x11::get($color)) {
			return 'x11';
		}
		return 'error';
	}
	
	/**
	 * Determine the type of color being used if it is an array.
	 * 
	 * @param  array  $color The color in question
	 * @return string        The color type as a string, returns 'error' if $color is invalid
	 */
	protected static function _get_array_type(array $color) :string {
		$color = array_change_key_case($color);
		unset($color['a']); // ignore alpha channel
		ksort($color);
		$type  = implode('', array_keys($color));
		$types = [
			'bgr'  => 'rgb',
			'hls'  => 'hsl',
			'bhs'  => 'hsb',
			'ckmy' => 'cmyk'
		];
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
	public function alpha($new_alpha = NULL) :float {
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
		error::trigger(error::INVALID_COLOR, sprintf(
			'The color supplied to %s\'s constructor was not valid',
			__CLASS__
		));
		$this->import_rgb([0, 0, 0]);
	}
	
	/**
	 * Import the alpha channel from a color array, or create one if it doesn't exist
	 * 
	 * @param  array $color The color array to check
	 * @return void
	 */
	protected function import_alpha(array $color) {
		if (isset($color['a'])) {
			$this->alpha = regulate::max((float) $color['a'], 100);
		} else {
			$this->alpha = 100.0;
		}
	}
	
	/**
	 * Handles importing of another instance of color
	 * 
	 * @return void
	 */
	protected function import_color(data $color) {
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
	public function import_rgb(array $color) {
		regulate::rgb_array($color);
		$this->rgb = array_intersect_key($color, ['r' => 0, 'g' => 0, 'b' => 0]);
		$this->hex = convert\rgb::to_hex($this->rgb);
		$this->hsl = new hsl($this->rgb);
		$this->import_alpha($color);
	}
	
	/**
	 * Imports a hsl array.
	 * 
	 * @param  array $color Array with offsets 'h', 's', 'l'
	 * @return void
	 */
	public function import_hsl(array $color) {
		regulate::hsl_array($color);
		$this->rgb = convert\hsl::to_rgb($color);
		$this->hsl = new hsl($this->rgb); // [todo] This should taken from input
		$this->hex = convert\rgb::to_hex($this->rgb);
		$this->import_alpha($color);
	}
	
	/**
	 * Imports a hsb array.
	 * 
	 * @param  array $color Array with offsets 'h', 's', 'b'
	 * @return void
	 */
	public function import_hsb(array $color) {
		regulate::hsb_array($color);
		$this->rgb = convert\hsb::to_rgb($color);
		$this->hsl = new hsl($this->rgb);
		$this->hex = convert\rgb::to_hex($this->rgb);
		$this->import_alpha($color);
	}
	
	/**
	 * Converts a hexadecimal string into an RGB array and imports it.
	 * 
	 * @param  string $color Hexadecimal string
	 * @return void
	 */
	public function import_hex(string $color) {
		regulate::hex($color);
		$this->import_rgb(convert\hex::to_rgb($color));
	}
	
	public function import_str(string $color) {
		$color = strtolower(str_replace(array(' ', "\t", "\n", "\r", "\0", "\x0B"), '', $color));
		if (regulate::_validate_hex_str($color, TRUE)) {
			$this->import_hex($color);
			return;
		} elseif (preg_match('/\A(rgb|hsl)a?\((\d+),(\d+),(\d+)(?:,(\d|\d\.\d?|\.\d+))?\)\Z/i', $color, $match)) {
			$this->import_regex($match);
			return;
		} elseif ($x11 = x11::get($color)) {
			$this->import_rgb($x11);
			return;
		}
		$this->import_error();
	}
	
	public function import_regex(array $match) {
		$alpha = 100;
		if (isset($match[5])) {
			$alpha = (float) $match[5] * 100;
		}
		$color = array_combine(str_split($match[1].'a'), [$match[2], $match[3], $match[4], $alpha]);
		call_user_func([__CLASS__, 'import_'.$match[1]], $color);
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
		$this->import_rgb(convert\cmyk::to_rgb($color['c'], $color['m'], $color['y'], $color['k']));
		$this->import_alpha($color);
	}
}
