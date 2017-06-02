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
class scheme {
	
	/**
	 * A static reference to this class. (needed for child class late static binding)
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
	public static function analogous_set (float $h = 0.0, float $s = 0.0, float $l = 0.0, $is_dark = NULL) :array {
		static::is_dark($is_dark, $h, $s, $l);
		$al = static::alt_light($l);
		$as = static::alt_saturation($s);
		// No inverting saturation
		$delta = FALSE;
		if ($s < 50) {
			$delta = TRUE;
		}
		return static::_assign_keys([
			[$h, $s, $l],
			[static::mod($h, -36, TRUE, 360), $as, $al],
			[static::mod($h, -18, TRUE, 360), static::mod($as, 6, $delta), static::mod($al, 6, $is_dark)],
			[static::mod($h, 18, TRUE, 360), static::mod($as, 6, $delta), static::mod($al, 6, $is_dark)],
			[static::mod($h, 36, TRUE, 360), $as, $al]
		]);
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
	public static function complementary_set (float $h = 0.0, float $s = 0.0, float $l = 0.0, $is_dark = NULL) :array {
		static::is_dark($is_dark, $h, $s, $l);
		$al = static::alt_light($l);
		$as = static::alt_saturation($s);
		return static::_assign_keys([
			[$h, $s, $l],
			[$h, $as, static::mod($al, 20, $is_dark)],
			[$h, $as, static::mod($al, 10, $is_dark)],
			[static::mod($h, 185, TRUE, 360), $as, $al],
			[static::mod($h, 185, TRUE, 360), $as, static::mod($al, 10, $is_dark)]
		]);
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
	public static function compound_set (float $h = 0.0, float $s = 0.0, float $l = 0.0, $is_dark = NULL) :array {
		static::is_dark($is_dark, $h, $s, $l);
		$al = static::alt_light($l);
		$as = static::alt_saturation($s);
		// No inverting saturation
		$delta = FALSE;
		if ($s < 50) {
			$delta = TRUE;
		}
		return static::_assign_keys([
			[$h, $s, $l],
			[static::mod($h, 40, TRUE, 360), static::mod($as, 12, $delta), static::mod($al, 24, $is_dark)],
			[static::mod($h, 40, TRUE, 360), static::mod($as, 12, $delta), static::mod($al, 16, $is_dark)],
			[static::mod($h, 135, TRUE, 360), static::mod($as, 12, $delta), static::mod($al, 16, $is_dark)],
			[static::mod($h, 160, TRUE, 360), static::mod($as, 12, $delta), static::mod($al, 24, $is_dark)]
		]);
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
	public static function monochromatic_set (float $h = 0.0, float $s = 0.0, float $l = 0.0, $is_dark = NULL) :array {
		static::is_dark($is_dark, $h, $s, $l);
		$al = static::alt_light($l);
		// Avoid black & white
		$delta = 0;
		if ($l > 40 && $l < 60) {
			$delta = 30;
		}
		return static::_assign_keys([
			[$h, $s, $l],
			[$h, $s, static::mod($al, -8, $is_dark)],
			[$h, $s, static::mod($al, 8, $is_dark)],
			[$h, $s, static::mod($al, 55 + $delta, $is_dark)],
			[$h, $s, static::mod($al, 45 + $delta, $is_dark)]
		]);
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
	public static function shades_set (float $h = 0.0, float $s = 0.0, float $l = 0.0, $is_dark = NULL) :array {
		static::is_dark($is_dark, $h, $s, $l);
		$al = static::alt_light($l);
		// Avoid black & white
		$delta = 0;
		if ($l >= 80) {
			$delta = -76;
		} elseif ($l <= 20) {
			$delta = 24;
		}
		return static::_assign_keys([
			[$h, $s, $l],
			[$h, $s, static::mod($al, $delta - 20, $is_dark)],
			[$h, $s, static::mod($al, $delta - 10, $is_dark)],
			[$h, $s, static::mod($al, $delta + 8, $is_dark)],
			[$h, $s, static::mod($al, $delta + 16, $is_dark)]
		]);
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
	public static function tetrad_set (float $h = 0.0, float $s = 0.0, float $l = 0.0, $is_dark = NULL) :array {
		static::is_dark($is_dark, $h, $s, $l);
		$al = static::alt_light($l);
		$as = static::alt_saturation($s);
		return static::_assign_keys([
			[$h, $s, $l],
			[static::mod($h, 180, TRUE, 360), $as, $al],
			[static::mod($h, 120, TRUE, 360), $as, $al],
			[$h, $as, static::mod($al, 18, $is_dark)],
			[static::mod($h, -120, TRUE, 360), $as, $al]
		]);
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
	public static function weighted_tetrad_set (float $h = 0.0, float $s = 0.0, float $l = 0.0, $is_dark = NULL) :array {
		static::is_dark($is_dark, $h, $s, $l);
		$al = static::alt_light($l);
		$as = static::alt_saturation($s);
		return static::_assign_keys([
			[$h, $s, $l],
			[static::mod($h, 160, TRUE, 360), $as, $al],
			[static::mod($h, 80, TRUE, 360), $as, $al],
			[$h, $as, static::mod($al, 18, $is_dark)],
			[static::mod($h, -80, TRUE, 360), $as, $al]
		]);
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
	public static function triad_set (float $h = 0.0, float $s = 0.0, float $l = 0.0, $is_dark = NULL) :array {
		static::is_dark($is_dark, $h, $s, $l);
		$al = static::alt_light($l);
		$as = static::alt_saturation($s);
		return static::_assign_keys([
			[$h, $s, $l],
			[static::mod($h, 120, TRUE, 360), $as, $al],
			[$h, $as, static::mod($al, 18, $is_dark)],
			[static::mod($h, -120, TRUE, 360), $as, $al],
			[static::mod($h, -120, TRUE, 360), $as, static::mod($al, 18, $is_dark)]
		]);
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
	public static function weighted_triad_set (float $h = 0.0, float $s = 0.0, float $l = 0.0, $is_dark = NULL) :array {
		static::is_dark($is_dark, $h, $s, $l);
		$al = static::alt_light($l);
		$as = static::alt_saturation($s);
		return static::_assign_keys([
			[$h, $s, $l],
			[static::mod($h, 80, TRUE, 360), $as, $al],
			[$h, $as, static::mod($al, 18, $is_dark)],
			[static::mod($h, -80, TRUE, 360), $as, $al],
			[static::mod($h, -80, TRUE, 360), $as, static::mod($al, 18, $is_dark)]
		]);
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
	public static function rectangular_set (float $h = 0.0, float $s = 0.0, float $l = 0.0, $is_dark = NULL) :array {
		static::is_dark($is_dark, $h, $s, $l);
		$al = static::alt_light($l);
		$as = static::alt_saturation($s);
		return static::_assign_keys([
			[$h, $s, $l],
			[static::mod($h, 216, TRUE, 360), $as, $al],
			[static::mod($h, 180, TRUE, 360), $as, $al],
			[$h, $as, static::mod($al, 18, $is_dark)],
			[static::mod($h, 36, TRUE, 360), $as, $al]
		]);
	}
	
	/**
	 * Assigns keys to a hsl scheme array
	 * 
	 * @param  array $scheme The scheme to assign keys in
	 * @return array         The resulting scheme
	 */
	protected static function _assign_keys(array $scheme) :array {
		$keys = ['h', 's', 'l'];
		foreach ($scheme as &$color) {
			$color = array_combine($keys, $color);
		}
		return $scheme;
	}
	
	/**
	 * This prevents non-base colors from having either a too high or too low
	 * light value. If a value is too high or low, the resulting color sets will
	 * have many duplicate colors. This method doesn't prevent that, but it will
	 * reduce how often duplicate colors appear.
	 * 
	 * @param  float $light The light value to check
	 * @return float        The alternate light value to use
	 */
	protected static function alt_light(float $light = 0.0) {
		return (float) max(min($light, 93), 7);
	}
	
	/**
	 * This prevents non-base colors from having either a too low saturation value.
	 * If a value is too low, the resulting color sets will have many duplicate
	 * colors. This method doesn't prevent that, but it will reduce how often
	 * duplicate colors appear.
	 * 
	 * @param  float $saturation The saturation value to check
	 * @return float             The alternate saturation value to use
	 */
	protected static function alt_saturation(float $saturation = 0.0) {
		return (float) max($saturation, 7);
	}
	
	/**
	 * This allows easy modification of a number while forcing it to fall into a valid range.
	 * 
	 * @param  float   $number     The number to modify
	 * @param  float   $adjustment The amount of change to make to the $number
	 * @param  boolean $add        TRUE to add $adjustment to $number, FALSE to subtract $adjustment from $number
	 * @param  integer $max        The maximum value to allow. (Minimum is assumed to be 0)
	 * @return float               The resulting number.
	 */
	protected static function mod(float $number, float $adjustment, $add = TRUE, $max = 100) :float {
		if ($add) {
			return abs($number + $max + $adjustment) % $max;
		}
		return abs($number + $max - $adjustment) % $max;
	}
	
	/**
	 * Check if an HSL color is dark (YIQ)
	 * 
	 * @param  float $h The hue degree (0 - 359)
	 * @param  float $s The saturation percentage (0 - 100)
	 * @param  float $l The lighting percentage (0 - 100)
	 * @return void
	 */
	protected static function is_dark(&$is_dark, float $h = 0.0, float $s = 0.0, float $l = 0.0) {
		if (is_null($is_dark)) {
			$rgb     = convert\hsl::to_rgb($h, $s, $l);
			$is_dark = check::is_dark($rgb['r'], $rgb['g'], $rgb['b']);
		}
		settype($is_dark, 'bool');
	}
	
	/**
	 * Generate a array of 5 rgb colors using the $scheme algorithm
	 * 
	 * @param  float  $h      The hue value
	 * @param  float  $s      The saturation value
	 * @param  float  $l      The light value
	 * @param  string $scheme The scheme algorithm to use
	 * @return array          Array of RGB colors
	 */
	public static function rgb(float $h = 0.0, float $s = 0.0, float $l = 0.0, string $scheme = '') :array {
		return static::_convert(
			static::hsl($h, $s, $l, $scheme),
			[__NAMESPACE__.'\\convert\\hsl', 'to_rgb']
		);
	}
	
	/**
	 * Generate a array of 5 hsl colors using the $scheme algorithm
	 * 
	 * @param  float  $h      The hue value
	 * @param  float  $s      The saturation value
	 * @param  float  $l      The light value
	 * @param  string $scheme The scheme algorithm to use
	 * @return array          Array of HSL colors
	 */
	public static function hsl(float $h = 0.0, float $s = 0.0, float $l = 0.0, string $scheme = '') :array {
		if (is_callable($callable = [static::$this_class, $scheme.'_set'])) {
			return call_user_func($callable, $h, $s, $l);
		}
		error::call(sprintf(
			'The $scheme "%s" is not a valid scheme name',
			$scheme,
			__CLASS__,
			__FUNCTION__
		));
		return [];
	}
	
	/**
	 * Generate a array of 5 hsb colors using the $scheme algorithm
	 * 
	 * @param  float  $h      The hue value
	 * @param  float  $s      The saturation value
	 * @param  float  $l      The light value
	 * @param  string $scheme The scheme algorithm to use
	 * @return array          Array of hex colors
	 */
	public static function hsb(float $h = 0.0, float $s = 0.0, float $l = 0.0, string $scheme = '') :array {
		return static::_convert(
			static::rgb($h, $s, $l, $scheme),
			[__NAMESPACE__.'\\convert\\rgb', 'to_hsb']
		);
	}
	
	/**
	 * Generate a array of 5 hex colors using the $scheme algorithm
	 * 
	 * @param  float  $h      The hue value
	 * @param  float  $s      The saturation value
	 * @param  float  $l      The light value
	 * @param  string $scheme The scheme algorithm to use
	 * @return array          Array of hex colors
	 */
	public static function hex(float $h = 0.0, float $s = 0.0, float $l = 0.0, string $scheme = '') :array {
		return static::_convert(
			static::rgb($h, $s, $l, $scheme),
			[__NAMESPACE__.'\\convert\\rgb', 'to_hex']
		);
	}
	
	/**
	 * Generate a array of 5 cmyk colors using the $scheme algorithm
	 * 
	 * @param  float  $h      The hue value
	 * @param  float  $s      The saturation value
	 * @param  float  $l      The light value
	 * @param  string $scheme The scheme algorithm to use
	 * @return array          Array of CMYK colors
	 */
	public static function cmyk(float $h = 0.0, float $s = 0.0, float $l = 0.0, string $scheme = '') :array {
		return static::_convert(
			static::rgb($h, $s, $l, $scheme),
			[__NAMESPACE__.'\\convert\\rgb', 'to_cmyk']
		);
	}
	
	/**
	 * Convert a color scheme to another color space
	 * 
	 * @param  array    $scheme   The current color scheme
	 * @param  callable $callback The conversion callback to use
	 * @return array              The converted color scheme
	 */
	protected static function _convert(array $scheme, callable $callback) {
		$scheme = array_values($scheme);
		foreach ($scheme as &$color) {
			$color = call_user_func_array($callback, $color);
		}
		return $scheme;
	}
}
