<?php
/**
 * Scheme Class
 * 
 * This class has all the predefined HSL scheme algorithms.
 */

namespace projectcleverweb\color;

/**
 * Scheme Class
 * 
 * This class has all the predefined HSL scheme algorithms.
 */
class yiq_scheme extends scheme {
	
	/**
	 * A static reference to this class. (important for late static binding)
	 * @var string
	 */
	protected static $this_class = __CLASS__;
	
	/**
	 * These colors are all close to each other on a color wheel.
	 * 
	 * @param  float     $h       The base color hue degree (0 - 359)
	 * @param  float     $s       The base color saturation percentage (0 - 100)
	 * @param  float     $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array              An array of 5 analogous colors where the first offset is the original input.
	 */
	public static function analogous_set ($h = 0.0, $s = 0.0, $l = 0.0, $is_dark = NULL) {
		return static::set_adjust(parent::analogous_set($h, $s, $l, $is_dark));
	}
	
	/**
	 * 2 of these colors are a different shade of the base color. The other 2 are
	 * a weighted opposite of the base color.
	 * 
	 * @param  float     $h       The base color hue degree (0 - 359)
	 * @param  float     $s       The base color saturation percentage (0 - 100)
	 * @param  float     $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array              An array of 5 complementary colors where the first offset is the original input.
	 */
	public static function complementary_set ($h = 0.0, $s = 0.0, $l = 0.0, $is_dark = NULL) {
		return static::set_adjust(parent::complementary_set($h, $s, $l, $is_dark));
	}
	
	/**
	 * These colors use mathematical offsets that usually complement each other
	 * well, and can highlight the base color.
	 * 
	 * @param  float     $h       The base color hue degree (0 - 359)
	 * @param  float     $s       The base color saturation percentage (0 - 100)
	 * @param  float     $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array              An array of 5 compounding colors where the first offset is the original input.
	 */
	public static function compound_set ($h = 0.0, $s = 0.0, $l = 0.0, $is_dark = NULL) {
		return static::set_adjust(parent::compound_set($h, $s, $l, $is_dark));
	}
	
	/**
	 * 5 complementary shades of one color.
	 * 
	 * @param  float     $h       The base color hue degree (0 - 359)
	 * @param  float     $s       The base color saturation percentage (0 - 100)
	 * @param  float     $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array              An array of 5 complementary shades of colors where the first offset is the original input.
	 */
	public static function monochromatic_set ($h = 0.0, $s = 0.0, $l = 0.0, $is_dark = NULL) {
		return static::set_adjust(parent::monochromatic_set($h, $s, $l, $is_dark));
	}
	
	/**
	 * 5 different shades of one color.
	 * 
	 * @param  float     $h       The base color hue degree (0 - 359)
	 * @param  float     $s       The base color saturation percentage (0 - 100)
	 * @param  float     $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array              An array of 5 shades of a color where the first offset is the original input.
	 */
	public static function shades_set ($h = 0.0, $s = 0.0, $l = 0.0, $is_dark = NULL) {
		return static::set_adjust(parent::shades_set($h, $s, $l, $is_dark));
	}
	
	/**
	 * 3 of these colors are all equally distanced from each other on a color
	 * wheel, plus 1 alternated shade for the base color and the 1 color that is
	 * opposite of the base color.
	 * 
	 * @param  float     $h       The base color hue degree (0 - 359)
	 * @param  float     $s       The base color saturation percentage (0 - 100)
	 * @param  float     $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array              An array of 5 triangular colors where the first offset is the original input.
	 */
	public static function tetrad_set ($h = 0.0, $s = 0.0, $l = 0.0, $is_dark = NULL) {
		return static::set_adjust(parent::tetrad_set($h, $s, $l, $is_dark));
	}
	
	/**
	 * 3 of these colors are all similarly distanced from each other on a color
	 * wheel, the base color has an alternate shade, and there is a weighted
	 * opposite color. These colors are all slightly closer to the base color
	 * than in a normal tetrad.
	 * 
	 * @param  float     $h       The base color hue degree (0 - 359)
	 * @param  float     $s       The base color saturation percentage (0 - 100)
	 * @param  float     $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array              An array of 5 triangular colors where the first offset is the original input.
	 */
	public static function weighted_tetrad_set ($h = 0.0, $s = 0.0, $l = 0.0, $is_dark = NULL) {
		return static::set_adjust(parent::weighted_tetrad_set($h, $s, $l, $is_dark));
	}
	
	/**
	 * These colors are all equally distanced from each other on a color wheel,
	 * 2 of which have an alternate shade.
	 * 
	 * @param  float     $h       The base color hue degree (0 - 359)
	 * @param  float     $s       The base color saturation percentage (0 - 100)
	 * @param  float     $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array              An array of 5 triangular colors where the first offset is the original input.
	 */
	public static function triad_set ($h = 0.0, $s = 0.0, $l = 0.0, $is_dark = NULL) {
		return static::set_adjust(parent::triad_set($h, $s, $l, $is_dark));
	}
	
	/**
	 * These colors are all similarly distanced from each other on a color wheel,
	 * 2 of which have an alternate shade. These colors are all slightly closer to
	 * the base color than in a normal triad.
	 * 
	 * @param  float     $h       The base color hue degree (0 - 359)
	 * @param  float     $s       The base color saturation percentage (0 - 100)
	 * @param  float     $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array              An array of 5 weighted triangular colors where the first offset is the original input.
	 */
	public static function weighted_triad_set ($h = 0.0, $s = 0.0, $l = 0.0, $is_dark = NULL) {
		return static::set_adjust(parent::weighted_triad_set($h, $s, $l, $is_dark));
	}
	
	/**
	 * 4 of these colors form a rectangle on a color wheel, and 1 color is an
	 * alternate shade for the base color.
	 * 
	 * @param  float     $h       The base color hue degree (0 - 359)
	 * @param  float     $s       The base color saturation percentage (0 - 100)
	 * @param  float     $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array              An array of 5 rectangular colors where the first offset is the original input.
	 */
	public static function rectangular_set ($h = 0.0, $s = 0.0, $l = 0.0, $is_dark = NULL) {
		return static::set_adjust(parent::rectangular_set($h, $s, $l, $is_dark));
	}
	
	/**
	 * Adjusts a hue in the YIQ spectrum
	 * 
	 * @param  float  $current The current hue
	 * @param  float  $mod     The desired amount of change (0 - 359; is converted to a percentage)
	 * @return int             The resulting hue
	 */
	protected static function yiq_adjust($current, $mod) {
		if ($mod == 0) {
			return $current;
		}
		$change      = regulate::div($mod, 360) * 1000;
		$current_yiq = generate::hue_to_yiq($current);
		$new_loc     = regulate::max(abs($current_yiq + $change), 1000);
		return round(generate::yiq_to_hue($new_loc));
	}
	
	/**
	 * Adjust a scheme array to use YIQ adjusted hues
	 * 
	 * @param  array $scheme The scheme to adjust
	 * @return array         The resulting $scheme
	 */
	protected static function set_adjust($scheme) {
		foreach($scheme as $i => &$hsl) {
			if ($i == 0) {
				$org = $hsl['h'];
				continue;
			}
			$hsl['h'] = static::yiq_adjust($org, $hsl['h'] - $org);
		}
		
		return $scheme;
	}
}
