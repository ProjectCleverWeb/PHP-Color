<?php


namespace projectcleverweb\color;

/**
 * Scheme Class
 * 
 * This class has all the predefined HSL scheme algorithms.
 */
class scheme {
	
	/**
	 * These colors are all close to each other on a color wheel.
	 * 
	 * @param  float|integer $h       The base color hue degree (0 - 359)
	 * @param  float|integer $s       The base color saturation percentage (0 - 100)
	 * @param  float|integer $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null     $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array                  An array of 5 analogous colors where the first offset is the original input.
	 */
	public static function analogous (float $h = 0, float $s = 0, float $l = 0, $is_dark = NULL) :array {
		if (is_null($is_dark)) {
			$is_dark = static::is_dark($h, $s, $l);
		}
		// No inverting saturation
		$delta = FALSE;
		if ($s < 50) {
			$delta = TRUE;
		}
		return [
			[$h, $s, $l],
			[static::mod($h, -36, TRUE, 360), $s, $l],
			[static::mod($h, -18, TRUE, 360), static::mod($s, 6, $delta), static::mod($l, 6, $is_dark)],
			[static::mod($h, 18, TRUE, 360), static::mod($s, 6, $delta), static::mod($l, 6, $is_dark)],
			[static::mod($h, 36, TRUE, 360), $s, $l]
		];
	}
	
	/**
	 * 2 of these colors are a different shade of the base color. The other 2 are
	 * a weighted opposite of the base color.
	 * 
	 * @param  float|integer $h       The base color hue degree (0 - 359)
	 * @param  float|integer $s       The base color saturation percentage (0 - 100)
	 * @param  float|integer $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null     $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array                  An array of 5 complementary colors where the first offset is the original input.
	 */
	public static function complementary (float $h = 0, float $s = 0, float $l = 0, $is_dark = NULL) :array {
		if (is_null($is_dark)) {
			$is_dark = static::is_dark($h, $s, $l);
		}
		return [
			[$h, $s, $l],
			[$h, $s, static::mod($l, 20, $is_dark)],
			[$h, $s, static::mod($l, 10, $is_dark)],
			[static::mod($h, 185, TRUE, 360), $s, $l],
			[static::mod($h, 185, TRUE, 360), $s, static::mod($l, 10, $is_dark)]
		];
	}
	
	/**
	 * These colors use mathematical offsets that usually complement each other
	 * well, and can highlight the base color.
	 * 
	 * @param  float|integer $h       The base color hue degree (0 - 359)
	 * @param  float|integer $s       The base color saturation percentage (0 - 100)
	 * @param  float|integer $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null     $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array                  An array of 5 compounding colors where the first offset is the original input.
	 */
	public static function compound (float $h = 0, float $s = 0, float $l = 0, $is_dark = NULL) :array {
		if (is_null($is_dark)) {
			$is_dark = static::is_dark($h, $s, $l);
		}
		// No inverting saturation
		$delta = FALSE;
		if ($s < 50) {
			$delta = TRUE;
		}
		return [
			[$h, $s, $l],
			[static::mod($h, 40, TRUE, 360), static::mod($s, 12, $delta), static::mod($l, 24, $is_dark)],
			[static::mod($h, 40, TRUE, 360), static::mod($s, 12, $delta), static::mod($l, 16, $is_dark)],
			[static::mod($h, 135, TRUE, 360), static::mod($s, 12, $delta), static::mod($l, 16, $is_dark)],
			[static::mod($h, 160, TRUE, 360), static::mod($s, 12, $delta), static::mod($l, 24, $is_dark)]
		];
	}
	
	/**
	 * 5 complementary shades of one color.
	 * 
	 * @param  float|integer $h       The base color hue degree (0 - 359)
	 * @param  float|integer $s       The base color saturation percentage (0 - 100)
	 * @param  float|integer $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null     $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array                  An array of 5 complementary shades of colors where the first offset is the original input.
	 */
	public static function monochromatic (float $h = 0, float $s = 0, float $l = 0, $is_dark = NULL) :array {
		if (is_null($is_dark)) {
			$is_dark = static::is_dark($h, $s, $l);
		}
		// Avoid black & white
		$delta = 0;
		if ($l > 40 && $l < 60) {
			$delta = 30;
		}
		return [
			[$h, $s, $l],
			[$h, $s, static::mod($l, -8, $is_dark)],
			[$h, $s, static::mod($l, 8, $is_dark)],
			[$h, $s, static::mod($l, 55 + $delta, $is_dark)],
			[$h, $s, static::mod($l, 45 + $delta, $is_dark)]
		];
	}
	
	/**
	 * 5 different shades of one color.
	 * 
	 * @param  float|integer $h       The base color hue degree (0 - 359)
	 * @param  float|integer $s       The base color saturation percentage (0 - 100)
	 * @param  float|integer $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null     $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array                  An array of 5 shades of a color where the first offset is the original input.
	 */
	public static function shades (float $h = 0, float $s = 0, float $l = 0, $is_dark = NULL) :array {
		if (is_null($is_dark)) {
			$is_dark = static::is_dark($h, $s, $l);
		}
		// Avoid black & white
		$delta = 0;
		if ($l <= 10 && $l >= 90) {
			$delta = 50;
		}
		return [
			[$h, $s, $l],
			[$h, $s, max(min(static::mod($l, -20 - $delta, $is_dark), 97), 5)],
			[$h, $s, max(min(static::mod($l, -10 - $delta, $is_dark), 97), 5)],
			[$h, $s, max(min(static::mod($l, 8 + $delta, $is_dark), 97), 5)],
			[$h, $s, max(min(static::mod($l, 16 + $delta, $is_dark), 97), 5)]
		];
	}
	
	/**
	 * 3 of these colors are all equally distanced from each other on a color
	 * wheel, plus 1 alternated shade for the base color and the 1 color that is
	 * opposite of the base color.
	 * 
	 * @param  float|integer $h       The base color hue degree (0 - 359)
	 * @param  float|integer $s       The base color saturation percentage (0 - 100)
	 * @param  float|integer $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null     $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array                  An array of 5 triangular colors where the first offset is the original input.
	 */
	public static function tetrad (float $h = 0, float $s = 0, float $l = 0, $is_dark = NULL) :array {
		if (is_null($is_dark)) {
			$is_dark = static::is_dark($h, $s, $l);
		}
		return [
			[$h, $s, $l],
			[static::mod($h, 180, TRUE, 360), $s, $l],
			[static::mod($h, 120, TRUE, 360), $s, $l],
			[$h, $s, static::mod($l, 18, $is_dark)],
			[static::mod($h, -120, TRUE, 360), $s, $l]
		];
	}
	
	/**
	 * 3 of these colors are all similarly distanced from each other on a color
	 * wheel, the base color has an alternate shade, and there is a weighted
	 * opposite color. These colors are all slightly closer to the base color
	 * than in a normal tetrad.
	 * 
	 * @param  float|integer $h       The base color hue degree (0 - 359)
	 * @param  float|integer $s       The base color saturation percentage (0 - 100)
	 * @param  float|integer $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null     $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array                  An array of 5 triangular colors where the first offset is the original input.
	 */
	public static function weighted_tetrad (float $h = 0, float $s = 0, float $l = 0, $is_dark = NULL) :array {
		if (is_null($is_dark)) {
			$is_dark = static::is_dark($h, $s, $l);
		}
		return [
			[$h, $s, $l],
			[static::mod($h, 160, TRUE, 360), $s, $l],
			[static::mod($h, 80, TRUE, 360), $s, $l],
			[$h, $s, static::mod($l, 18, $is_dark)],
			[static::mod($h, -80, TRUE, 360), $s, $l]
		];
	}
	
	/**
	 * These colors are all equally distanced from each other on a color wheel,
	 * 2 of which have an alternate shade.
	 * 
	 * @param  float|integer $h       The base color hue degree (0 - 359)
	 * @param  float|integer $s       The base color saturation percentage (0 - 100)
	 * @param  float|integer $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null     $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array                  An array of 5 triangular colors where the first offset is the original input.
	 */
	public static function triad (float $h = 0, float $s = 0, float $l = 0, $is_dark = NULL) :array {
		if (is_null($is_dark)) {
			$is_dark = static::is_dark($h, $s, $l);
		}
		return [
			[$h, $s, $l],
			[static::mod($h, 120, TRUE, 360), $s, $l],
			[$h, $s, static::mod($l, 18, $is_dark)],
			[static::mod($h, -120, TRUE, 360), $s, $l],
			[static::mod($h, -120, TRUE, 360), $s, static::mod($l, 18, $is_dark)]
		];
	}
	
	/**
	 * These colors are all similarly distanced from each other on a color wheel,
	 * 2 of which have an alternate shade. These colors are all slightly closer to
	 * the base color than in a normal triad.
	 * 
	 * @param  float|integer $h       The base color hue degree (0 - 359)
	 * @param  float|integer $s       The base color saturation percentage (0 - 100)
	 * @param  float|integer $l       The base color lighting percentage (0 - 100)
	 * @param  bool|null     $is_dark Whether or not to treat the base color as a dark color. Leave as null to dynamically generate this.
	 * @return array                  An array of 5 weighted triangular colors where the first offset is the original input.
	 */
	public static function weighted_triad (float $h = 0, float $s = 0, float $l = 0, $is_dark = NULL) :array {
		if (is_null($is_dark)) {
			$is_dark = static::is_dark($h, $s, $l);
		}
		return [
			[$h, $s, $l],
			[static::mod($h, 80, TRUE, 360), $s, $l],
			[$h, $s, static::mod($l, 18, $is_dark)],
			[static::mod($h, -80, TRUE, 360), $s, $l],
			[static::mod($h, -80, TRUE, 360), $s, static::mod($l, 18, $is_dark)]
		];
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
	 * @param  float|integer $h The hue degree (0 - 359)
	 * @param  float|integer $s The saturation percentage (0 - 100)
	 * @param  float|integer $l The lighting percentage (0 - 100)
	 * @return boolean          TRUE if the color is dark, FALSE otherwise.
	 */
	protected static function is_dark(float $h = 0, float $s = 0, float $l = 0) :bool {
		$rgb = hsl::hsl_to_rgb($h, $s, $l);
		return check::is_dark($rgb['r'], $rgb['g'], $rgb['b']);
	}
}
