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
	public static function hex($r, $g, $b) {
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
	public static function rgb($r, $g, $b, $a = 1.0) {
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
	public static function hsl($h, $s, $l, $a = 1.0) {
		if ($a == 1.0 && !static::$force_alpha) {
			return sprintf('hsl(%s,%s%%,%s%%)', $h, $s, $l);
		}
		return sprintf('hsla(%s,%s%%,%s%%,%s)', $h, $s, $l, $a / 100);
	}
}
