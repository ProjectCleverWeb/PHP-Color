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
	
	protected $color_spaces = array();
	
	/**
	 * All the valid color spaces types
	 * @var array
	 */
	protected static $valid_color_spaces = array(
		'rgb',
		'hsl',
		'hsb',
		'cmyk'
	);
	
	/**
	 * All the valid importable types
	 * @var array
	 */
	protected static $valid_imports = array(
		'object',
		'hex',
		'int',
		'css'
	);
	
	/**
	 * All the valid types
	 * @var array
	 */
	protected static $valid_types = array(
		'rgb',
		'hsl',
		'hsb',
		'cmyk',
		'object',
		'hex',
		'int',
		'css'
	);
	
	private $current_space = 'rgb';
	
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
		if (empty($type)) {
			$type = type::get($color);
		}
		if (!in_array($type, static::$valid_types)) {
			error::trigger(error::INVALID_ARGUMENT, sprintf(
				'Invalid color type "%s"',
				$type
			));
			$type = 'rgb';
			$color = array(
				'r' => 0,
				'g' => 0,
				'b' => 0
			);
		}
		if (in_array($type, static::$valid_imports)) {
			call_user_func([__CLASS__, 'import_'.$type], $color);
		} else {
			$this->__set($type, $color);
		}
	}
	
	public function __get($key) {
		if (!in_array($key, static::$valid_color_spaces)) {
			error::trigger(error::INVALID_ARGUMENT, sprintf(
				'Cannot get color space "%s"',
				$key
			));
			return $this->__get($this->current_space);
		}
		if (!$this->__isset($key)) {
			$this->color_spaces[$key] = static::_get_convert($this->color_spaces, $this->current_space, $key);
		}
		return (array) $this->color_spaces[$key];
	}
	
	public function __set($key, $value) {
		if (in_array($key, static::$valid_color_spaces)) {
			$color_space = __NAMESPACE__.'\\color\\space\\'.$key;
			$this->color_spaces[$key] = new $color_space($value);
			$this->current_space = $key;
			return $this->__get($key);
		}
		error::trigger(error::INVALID_ARGUMENT, sprintf(
			'Cannot set color space "%s"',
			__CLASS__
		));
	}
	
	public function __isset($key) {
		return isset($this->color_spaces[$key]);
	}
	
	public function __unset($key) {
		if ($this->__isset($key) && count($this->color_spaces) > 1) {
			unset($this->color_spaces);
		} elseif ($this->__isset($key)) {
			$this->clear('rgb', array(
				'r' => 0,
				'g' => 0,
				'b' => 0
			));
		}
	}
	
	protected static function _get_convert(array $color_spaces, string $current, string $to) {
		if (isset($color_spaces[$current])) {
			$from = $current;
		} else {
			reset($color_spaces);
			$from = key($color_spaces);
			$this->current_space = $from; // Original space was unset
		}
		$convert = call_user_func(array('\\projectcleverweb\\color\\convert\\'.$from, 'to_'.$to), $color_spaces[$from]);
		$space   = __NAMESPACE__.'\\color\\space\\'.$to;
		return new $space($convert);
	}
	
	public function clear_cache() {
		
		if (is_callable([__CLASS__, 'import_'.$type])) {
			call_user_func([__CLASS__, 'import_'.$type], $color);
		} else {
			error::trigger();
		}
	}
	
	protected function _clear() {
		$this->color_spaces = array();
	}
	
	protected function get_space() {
		return $this->current_space;
	}
	
	protected function set_space(string $color_space) :string {
		if (in_array(static::$valid_color_spaces)) {
			$this->current_space = $color_space;
		}
		return $this->current_space;
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
		return $this->color_spaces + ['alpha' => $this->alpha];
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
	protected function import_object(store $color) {
		$this->_clear();
		foreach ($this->color_spaces as $space => $data) {
			$color_space = __NAMESPACE__.'\\space\\'.$space;
			$this->color_spaces[$space] = new $color_space($data);
		}
		$this->current_space        = $color->get_space();
		$this->alpha                = $color->alpha;
	}
	
	/**
	 * Imports a RGB array.
	 * 
	 * @param  array $color Array with offsets 'r', 'g', 'b'
	 * @return void
	 */
	public function import_rgb(array $color) {
		$this->_clear();
		$this->color_spaces['rgb'] = new color\space\rgb($color);
		$this->import_alpha($color);
	}
	
	/**
	 * Imports a hsl array.
	 * 
	 * @param  array $color Array with offsets 'h', 's', 'l'
	 * @return void
	 */
	public function import_hsl(array $color) {
		$this->_clear();
		$this->color_spaces['hsl'] = new color\space\hsl($color);
		$this->import_alpha($color);
	}
	
	/**
	 * Imports a hsb array.
	 * 
	 * @param  array $color Array with offsets 'h', 's', 'b'
	 * @return void
	 */
	public function import_hsb(array $color) {
		$this->_clear();
		$this->color_spaces['hsb'] = new color\space\hsb($color);
		$this->import_alpha($color);
	}
	
	/**
	 * Imports a CMYK array
	 * 
	 * @param  array $color Array with offsets 'c', 'm', 'y', 'k'
	 * @return void
	 */
	public function import_cmyk(array $color) {
		$this->_clear();
		$this->color_spaces['cmyk'] = new color\space\cmyk($color);
		$this->import_alpha($color);
	}
	
	/**
	 * Converts a hexadecimal string into an RGB array and imports it.
	 * 
	 * @param  string $color Hexadecimal string
	 * @return void
	 */
	public function import_hex(string $color) {
		$this->import_rgb(convert\hex::to_rgb($color));
	}
	
	/**
	 * Converts a hexadecimal string into an RGB array and imports it.
	 * 
	 * @param  string $color Hexadecimal string
	 * @return void
	 */
	public function import_css(string $color) {
		// result will either be an RGB or HSL array
		self::__construct(css::get($color));
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
}
