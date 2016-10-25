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
	
	public static $x11_map = array(
		'aliceblue'            => array(240, 248, 255),
		'antiquewhite'         => array(250, 235, 215),
		'aqua'                 => array(0, 255, 255),
		'aquamarine'           => array(127, 255, 212),
		'azure'                => array(240, 255, 255),
		'beige'                => array(245, 245, 220),
		'bisque'               => array(255, 228, 196),
		'black'                => array(0, 0, 0),
		'blanchedalmond'       => array(255, 235, 205),
		'blue'                 => array(0, 0, 255),
		'blueviolet'           => array(138, 43, 226),
		'brown'                => array(165, 42, 42),
		'burlywood'            => array(222, 184, 135),
		'cadetblue'            => array(95, 158, 160),
		'chartreuse'           => array(127, 255, 0),
		'chocolate'            => array(210, 105, 30),
		'coral'                => array(255, 127, 80),
		'cornflowerblue'       => array(100, 149, 237),
		'cornsilk'             => array(255, 248, 220),
		'crimson'              => array(220, 20, 60),
		'cyan'                 => array(0, 255, 255),
		'darkblue'             => array(0, 0, 139),
		'darkcyan'             => array(0, 139, 139),
		'darkgoldenrod'        => array(184, 134, 11),
		'darkgray'             => array(169, 169, 169),
		'darkgreen'            => array(0, 100, 0),
		'darkgrey'             => array(169, 169, 169),
		'darkkhaki'            => array(189, 183, 107),
		'darkmagenta'          => array(139, 0, 139),
		'darkolivegreen'       => array(85, 107, 47),
		'darkorange'           => array(255, 140, 0),
		'darkorchid'           => array(153, 50, 204),
		'darkred'              => array(139, 0, 0),
		'darksalmon'           => array(233, 150, 122),
		'darkseagreen'         => array(143, 188, 143),
		'darkslateblue'        => array(72, 61, 139),
		'darkslategray'        => array(47, 79, 79),
		'darkslategrey'        => array(47, 79, 79),
		'darkturquoise'        => array(0, 206, 209),
		'darkviolet'           => array(148, 0, 211),
		'deeppink'             => array(255, 20, 147),
		'deepskyblue'          => array(0, 191, 255),
		'dimgray'              => array(105, 105, 105),
		'dimgrey'              => array(105, 105, 105),
		'dodgerblue'           => array(30, 144, 255),
		'firebrick'            => array(178, 34, 34),
		'floralwhite'          => array(255, 250, 240),
		'forestgreen'          => array(34, 139, 34),
		'fuchsia'              => array(255, 0, 255),
		'gainsboro'            => array(220, 220, 220),
		'ghostwhite'           => array(248, 248, 255),
		'gold'                 => array(255, 215, 0),
		'goldenrod'            => array(218, 165, 32),
		'gray'                 => array(128, 128, 128),
		'green'                => array(0, 128, 0),
		'greenyellow'          => array(173, 255, 47),
		'grey'                 => array(128, 128, 128),
		'honeydew'             => array(240, 255, 240),
		'hotpink'              => array(255, 105, 180),
		'indianred'            => array(205, 92, 92),
		'indigo'               => array(75, 0, 130),
		'ivory'                => array(255, 255, 240),
		'khaki'                => array(240, 230, 140),
		'lavender'             => array(230, 230, 250),
		'lavenderblush'        => array(255, 240, 245),
		'lawngreen'            => array(124, 252, 0),
		'lemonchiffon'         => array(255, 250, 205),
		'lightblue'            => array(173, 216, 230),
		'lightcoral'           => array(240, 128, 128),
		'lightcyan'            => array(224, 255, 255),
		'lightgoldenrodyellow' => array(250, 250, 210),
		'lightgray'            => array(211, 211, 211),
		'lightgreen'           => array(144, 238, 144),
		'lightgrey'            => array(211, 211, 211),
		'lightpink'            => array(255, 182, 193),
		'lightsalmon'          => array(255, 160, 122),
		'lightseagreen'        => array(32, 178, 170),
		'lightskyblue'         => array(135, 206, 250),
		'lightslategray'       => array(119, 136, 153),
		'lightslategrey'       => array(119, 136, 153),
		'lightsteelblue'       => array(176, 196, 222),
		'lightyellow'          => array(255, 255, 224),
		'lime'                 => array(0, 255, 0),
		'limegreen'            => array(50, 205, 50),
		'linen'                => array(250, 240, 230),
		'magenta'              => array(255, 0, 255),
		'maroon'               => array(128, 0, 0),
		'mediumaquamarine'     => array(102, 205, 170),
		'mediumblue'           => array(0, 0, 205),
		'mediumorchid'         => array(186, 85, 211),
		'mediumpurple'         => array(147, 112, 219),
		'mediumseagreen'       => array(60, 179, 113),
		'mediumslateblue'      => array(123, 104, 238),
		'mediumspringgreen'    => array(0, 250, 154),
		'mediumturquoise'      => array(72, 209, 204),
		'mediumvioletred'      => array(199, 21, 133),
		'midnightblue'         => array(25, 25, 112),
		'mintcream'            => array(245, 255, 250),
		'mistyrose'            => array(255, 228, 225),
		'moccasin'             => array(255, 228, 181),
		'navajowhite'          => array(255, 222, 173),
		'navy'                 => array(0, 0, 128),
		'oldlace'              => array(253, 245, 230),
		'olive'                => array(128, 128, 0),
		'olivedrab'            => array(107, 142, 35),
		'orange'               => array(255, 165, 0),
		'orangered'            => array(255, 69, 0),
		'orchid'               => array(218, 112, 214),
		'palegoldenrod'        => array(238, 232, 170),
		'palegreen'            => array(152, 251, 152),
		'paleturquoise'        => array(175, 238, 238),
		'palevioletred'        => array(219, 112, 147),
		'papayawhip'           => array(255, 239, 213),
		'peachpuff'            => array(255, 218, 185),
		'peru'                 => array(205, 133, 63),
		'pink'                 => array(255, 192, 203),
		'plum'                 => array(221, 160, 221),
		'powderblue'           => array(176, 224, 230),
		'purple'               => array(128, 0, 128),
		'red'                  => array(255, 0, 0),
		'rosybrown'            => array(188, 143, 143),
		'royalblue'            => array(65, 105, 225),
		'saddlebrown'          => array(139, 69, 19),
		'salmon'               => array(250, 128, 114),
		'sandybrown'           => array(244, 164, 96),
		'seagreen'             => array(46, 139, 87),
		'seashell'             => array(255, 245, 238),
		'sienna'               => array(160, 82, 45),
		'silver'               => array(192, 192, 192),
		'skyblue'              => array(135, 206, 235),
		'slateblue'            => array(106, 90, 205),
		'slategray'            => array(112, 128, 144),
		'slategrey'            => array(112, 128, 144),
		'snow'                 => array(255, 250, 250),
		'springgreen'          => array(0, 255, 127),
		'steelblue'            => array(70, 130, 180),
		'tan'                  => array(210, 180, 140),
		'teal'                 => array(0, 128, 128),
		'thistle'              => array(216, 191, 216),
		'tomato'               => array(255, 99, 71),
		'turquoise'            => array(64, 224, 208),
		'violet'               => array(238, 130, 238),
		'wheat'                => array(245, 222, 179),
		'white'                => array(255, 255, 255),
		'whitesmoke'           => array(245, 245, 245),
		'yellow'               => array(255, 255, 0),
		'yellowgreen'          => array(154, 205, 50)
	);
	
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
			return 'str';
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
		error::call(sprintf(
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
	protected function import_color(color $color) {
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
	public function import_hsl(array $color) {
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
	public function import_hsb(array $color) {
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
	public function import_hex(string $color) {
		regulate::hex($color);
		$this->import_rgb(convert::hex_to_rgb($color));
	}
	
	public function import_str(string $color) {
		$color = strtolower(str_replace(array(' ', "\t", "\n", "\r", "\0", "\x0B"), '', $color));
		if (regulate::_validate_hex_str($color, TRUE)) {
			$this->import_hex($color);
			return;
		} elseif (preg_match('/\A(rgb|hsl)a?\((\d+),(\d+),(\d+)(?:,(\d|\d\.\d?|\.\d+))?\)\Z/i', $color, $match)) {
			$this->import_regex($match);
			return;
		} elseif (isset(static::$x11_map[$color])) {
			$this->import_rgb(static::$x11_map[$color]);
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
		$this->import_rgb(convert::cmyk_to_rgb($color['c'], $color['m'], $color['y'], $color['k']));
		$this->import_alpha($color);
	}
}
