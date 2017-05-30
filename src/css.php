<?php
/**
 * CSS Generator Class
 */

namespace projectcleverweb\color;

/**
 * CSS Generator Class
 */
class css {
	
	/**
	 * Force alpha value to be present where possible.
	 * @var boolean
	 */
	public static $force_alpha = FALSE;
	
	public static function get(string $input, $support_x11 = TRUE) {
		if (preg_match('/\A(?:(rgb|hsl)\((\d+|\d+\.(?:\d+)?|\.\d+),(\d+|\d+\.(?:\d+)?|\.\d+),(\d+|\d+\.(?:\d+)?|\.\d+)|(rgb|hsl)a\((\d+|\d+\.(?:\d+)?|\.\d+),(\d+|\d+\.(?:\d+)?|\.\d+),(\d+|\d+\.(?:\d+)?|\.\d+),((?:0|1)|(?:0|1)\.(?:\d+)?|\.\d+))\)\Z/i', $input, $matches)) {
			return static::format_matches($matches);
		} elseif ($support_x11 && $x11 = data\x11::get($input)) {
			return $x11;
		}
		return FALSE;
	}
	
	protected static function format_matches(array $matches) {
		$values = array_slice($watches, 1, 4);
		$keys   = array_slice(str_split($matches[0].'a'), 0, count($values));
		$color  = array_combine($keys, $values);
		foreach ($color as $key => &$val) {
			$val = (float) filter_var($val, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_THOUSAND | FILTER_FLAG_ALLOW_SCIENTIFIC | FILTER_FLAG_ALLOW_FRACTION);
			if ($key == 'a') {
				$val = $val * 100;
			}
		}
		return $color;
	}
	
	/**
	 * Choose the best way to represent the color as a CSS value. Will use either
	 * a hex or rgba value depending on the alpha value.
	 * 
	 * @param  mixed $color The color
	 * @return string       The CSS value
	 */
	public static function best($color) {
		static::_color_instance($color);
		if ($color->alpha() == 100 && !static::$force_alpha) {
			return static::hex($color->rgb['r'], $color->rgb['g'], $color->rgb['b']);
		}
		return static::rgb($color->rgb['r'], $color->rgb['g'], $color->rgb['b'], $color->alpha());
	}
	
	/**
	 * Force $color to be an instance of color
	 * 
	 * @param  mixed &$color The color
	 * @return void
	 */
	protected static function _color_instance(&$color) {
		if (!is_a($color, __CLASS__)) {
			$color = new color($color);
		}
	}
	
	/**
	 * Convert and RGB value to a CSS hex string
	 * 
	 * @param  float  $r The red value
	 * @param  float  $g The green value
	 * @param  float  $b The blue value
	 * @return string    The CSS string
	 */
	public static function hex(float $r, float $g, float $b) {
		return '#'.convert::rgb_to_hex($r, $g, $b);
	}
	
	/**
	 * Convert and RGB value to a CSS rgb or rgba string
	 * 
	 * @param  float  $r The red value
	 * @param  float  $g The green value
	 * @param  float  $b The blue value
	 * @return string    The CSS string
	 */
	public static function rgb(float $r, float $g, float $b, float $a = 1.0) {
		if ($a == 1.0 && !static::$force_alpha) {
			return sprintf('rgb(%s,%s,%s)', $r, $g, $b);
		}
		return sprintf('rgba(%s,%s,%s,%s)', $r, $g, $b, $a / 100);
	}
	
	/**
	 * Convert and HSL value to a CSS hsl or hsla string
	 * 
	 * @param  float  $h The hue value
	 * @param  float  $s The saturation value
	 * @param  float  $l The light value
	 * @return string    The CSS string
	 */
	public static function hsl(float $h, float $s, float $l, float $a = 1.0) {
		if ($a == 1.0 && !static::$force_alpha) {
			return sprintf('hsl(%s,%s%%,%s%%)', $h, $s, $l);
		}
		return sprintf('hsla(%s,%s%%,%s%%,%s)', $h, $s, $l, $a / 100);
	}
}
