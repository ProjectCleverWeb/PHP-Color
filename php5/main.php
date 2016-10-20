<?php
/**
 * Main Interface For Library
 * ==========================
 * Provides a simplified interface so programming with colors can be relatively
 * quick & easy
 */

namespace projectcleverweb\color;

/**
 * Main Interface For Library
 * ==========================
 * Provides a simplified interface so programming with colors can be relatively
 * quick & easy
 */
class main extends main_peripheral {
	
	/**
	 * Instance of color for this object
	 * @var color
	 */
	public $color;
	
	/**
	 * Instance of cache for this object
	 * @var cache
	 */
	protected $cache;
	
	/**
	 * Setup color and cache for this object
	 * 
	 * @param mixed  $color A color described as Hex string or int, RGB array, HSL array, HSB array, CMYK array, or instance of color
	 * @param string $type  The type of color to process $color as
	 */
	public function __construct($color, $type = '') {
		$this->set($color, $type);
		$this->cache = new cache;
	}
	
	/**
	 * Configure the color instance for this object
	 * 
	 * @param mixed  $color A color described as Hex string or int, RGB array, HSL array, HSB array, CMYK array, or instance of color
	 * @param string $type  The type of color to process $color as
	 */
	protected function set($color, $type = '') {
		if (is_a($color, __CLASS__)) {
			$this->color = clone $color->color;
		} else {
			$this->color = new color($color, $type);
		}
	}
	
	/**
	 * Return the current color as an RGB array
	 * 
	 * @return array RGB array
	 */
	public function rgb() {
		return (array) $this->color->rgb + array('a' => $this->color->alpha());
	}
	
	/**
	 * Return the current color as an HSL array
	 * 
	 * @return array HSL array
	 */
	public function hsl($accuracy = 0) {
		$color = array();
		foreach($this->color->hsl() as $key => $value) {
			$color[$key] = round($value, abs($accuracy));
		}
		return $color + array('a' => $this->color->alpha());
	}
	
	/**
	 * Return the current color as an CMYK array
	 * 
	 * @return array CMYK array
	 */
	public function cmyk() {
		if (!is_null($cached = $this->cache->get(__FUNCTION__, $this->hex()))) {
			return $cached;
		}
		$rgb    = $this->color->rgb;
		$result = convert::rgb_to_cmyk($rgb['r'], $rgb['g'], $rgb['b']) + ['a' => $this->color->alpha()];
		$this->cache->set(__FUNCTION__, $this->hex(), $result);
		return $result;
	}
	
	/**
	 * Return the current color as an HSB array
	 * 
	 * @return array HSB array
	 */
	public function hsb($accuracy = 0) {
		if (!is_null($cached = $this->cache->get(__FUNCTION__, $this->hex()))) {
			return $cached;
		}
		$rgb    = $this->color->rgb;
		$result = convert::rgb_to_hsb($rgb['r'], $rgb['g'], $rgb['b'], $accuracy) + array('a' => $this->color->alpha());
		$this->cache->set(__FUNCTION__, $this->hex(), $result);
		return $result;
	}
	
	/**
	 * Return the current color as an hex string
	 * 
	 * @return string hex string
	 */
	public function hex() {
		return $this->color->hex;
	}
	
	/**
	 * Return the current color as an web-safe hex string
	 * 
	 * @return string web-safe hex string
	 */
	public function web_safe() {
		if (!is_null($cached = $this->cache->get(__FUNCTION__, $this->hex()))) {
			return $cached;
		}
		$rgb    = $this->color->rgb;
		$result = generate::web_safe($rgb['r'], $rgb['g'], $rgb['b']);
		$this->cache->set(__FUNCTION__, $this->hex(), $result);
		return $result;
	}
	
	/**
	 * Return the current color as an CSS value
	 * 
	 * @return string CSS value
	 */
	public function css() {
		return css::best($this->color);
	}
	
	/**
	 * Get (and set) the alpha channel
	 * 
	 * @param  mixed $new_alpha If numeric, the alpha channel is set to this value
	 * @return float            The current alpha value
	 */
	public function alpha($new_alpha) {
		return $this->color->alpha($new_alpha);
	}
	
	/**
	 * Check if the current color would be considered visually dark
	 * 
	 * @param  int $check_score Minimum score to be considered light (0-255; defaults to 128)
	 * @return bool             
	 */
	public function is_dark($check_score = 128) {
		if (!is_null($cached = $this->cache->get(__FUNCTION__, $this->hex()))) {
			return $cached;
		}
		$rgb    = $this->color->rgb;
		$result = check::is_dark($rgb['r'], $rgb['g'], $rgb['b'], $check_score);
		$this->cache->set(__FUNCTION__, $this->hex(), $result);
		return $result;
	}
	
	/**
	 * Adjust the red value of the current color
	 * 
	 * @param  float $adjustment    The amount to adjust the color by
	 * @param  bool  $as_percentage Whether to treat $amount as a percentage
	 * @param  bool  $set_absolute  TRUE to use "set" mode, where the $adjustment is the absolute value you want for this attribute
	 * @return void
	 */
	public function red($adjustment, $as_percentage = FALSE, $set_absolute = FALSE) {
		return modify::rgb($this->color, 'red', $adjustment, $as_percentage, $set_absolute);
	}
	
	/**
	 * Adjust the green value of the current color
	 * 
	 * @param  float $adjustment    The amount to adjust the color by
	 * @param  bool  $as_percentage Whether to treat $amount as a percentage
	 * @param  bool  $set_absolute  TRUE to use "set" mode, where the $adjustment is the absolute value you want for this attribute
	 * @return void
	 */
	public function green($adjustment, $as_percentage = FALSE, $set_absolute = FALSE) {
		return modify::rgb($this->color, 'green', $adjustment, $as_percentage, $set_absolute);
	}
	
	/**
	 * Adjust the blue value of the current color
	 * 
	 * @param  float $adjustment    The amount to adjust the color by
	 * @param  bool  $as_percentage Whether to treat $amount as a percentage
	 * @param  bool  $set_absolute  TRUE to use "set" mode, where the $adjustment is the absolute value you want for this attribute
	 * @return void
	 */
	public function blue($adjustment, $as_percentage = FALSE, $set_absolute = FALSE) {
		return modify::rgb($this->color, 'blue', $adjustment, $as_percentage, $set_absolute);
	}
	
	/**
	 * Adjust the hue value of the current color
	 * 
	 * @param  float $adjustment    The amount to adjust the color by
	 * @param  bool  $as_percentage Whether to treat $amount as a percentage
	 * @param  bool  $set_absolute  TRUE to use "set" mode, where the $adjustment is the absolute value you want for this attribute
	 * @return void
	 */
	public function hue($adjustment, $as_percentage = FALSE, $set_absolute = FALSE) {
		return modify::hsl($this->color, 'hue', $adjustment, $as_percentage, $set_absolute);
	}
	
	/**
	 * Adjust the saturation value of the current color
	 * 
	 * @param  float $adjustment    The amount to adjust the color by
	 * @param  bool  $as_percentage Whether to treat $amount as a percentage
	 * @param  bool  $set_absolute  TRUE to use "set" mode, where the $adjustment is the absolute value you want for this attribute
	 * @return void
	 */
	public function saturation($adjustment, $as_percentage = FALSE, $set_absolute = FALSE) {
		return modify::hsl($this->color, 'saturation', $adjustment, $as_percentage, $set_absolute);
	}
	
	/**
	 * Adjust the light value of the current color
	 * 
	 * @param  float $adjustment    The amount to adjust the color by
	 * @param  bool  $as_percentage Whether to treat $amount as a percentage
	 * @param  bool  $set_absolute  TRUE to use "set" mode, where the $adjustment is the absolute value you want for this attribute
	 * @return void
	 */
	public function light($adjustment, $as_percentage = FALSE, $set_absolute = FALSE) {
		return modify::hsl($this->color, 'light', $adjustment, $as_percentage, $set_absolute);
	}
	
	/**
	 * Blend 2 colors together to generate a new color.
	 * 
	 * @param  main   $color2 The second color to blend with this color
	 * @param  float  $amount The amount as a percentage of the second color to add to the first
	 * @return main           The resulting color as an instance of main.
	 */
	public function blend($color2, $amount = 50.0) {
		$c1 = $this->rgb();
		$c2 = $color2->rgb();
		return new $this(generate::blend(
			$c1['r'], $c1['g'], $c1['b'], $c1['a'],
			$c2['r'], $c2['g'], $c2['b'], $c2['a'],
			$amount
		));
	}
	
	/**
	 * Create a gradient of colors as an array
	 * 
	 * @param  main  $color2 The "end" gradient. (The current color is the start)
	 * @param  int   $steps  The number of steps to have in the gradient. 0 will make it generate one step for every unique RGB color in the gradient.
	 * @return array         The resulting gradient as an array
	 */
	public function gradient($color2, $steps = 0) {
		$c1 = $this->rgb();
		$c2 = $color2->rgb();
		return generate::gradient_range(
			$c1['r'], $c1['g'], $c1['b'],
			$c2['r'], $c2['g'], $c2['b'],
			$steps
		);
	}
	
	/**
	 * Generate a color scheme based on the current color.
	 * 
	 * Available scheme algorithms:
	 *   - analogous
	 *   - complementary
	 *   - compound
	 *   - monochromatic
	 *   - shades
	 *   - tetrad
	 *   - weighted_tetrad
	 *   - triad
	 *   - weighted_triad
	 *   - rectangular
	 * 
	 * @param  string $scheme_name The scheme algorithm to use
	 * @param  string $return_type The type of values the scheme will have (hex, rgb, hsl, hsb, cmyk)
	 * @return array               The resulting scheme, where offset 0 is the original color
	 */
	public function scheme($scheme_name, $return_type = 'hex') {
		return static::get_scheme($scheme_name, $return_type, new scheme);
	}
	
	/**
	 * Generate a color scheme, with YIQ weights, based on the current color.
	 * 
	 * Available scheme algorithms:
	 *   - analogous
	 *   - complementary
	 *   - compound
	 *   - monochromatic
	 *   - shades
	 *   - tetrad
	 *   - weighted_tetrad
	 *   - triad
	 *   - weighted_triad
	 *   - rectangular
	 * 
	 * @param  string $scheme_name The scheme algorithm to use
	 * @param  string $return_type The type of values the scheme will have (hex, rgb, hsl, hsb, cmyk)
	 * @return array               The resulting YIQ scheme, where offset 0 is the original color
	 */
	public function yiq_scheme($scheme_name, $return_type = 'hex') {
		return parent::get_scheme($scheme_name, $return_type, new yiq_scheme);
	}
	
	/**
	 * Generate a new instance of main with a random RGB color
	 * 
	 * @param  int  $min_r Minimum red value allowed
	 * @param  int  $max_r Maximum red value allowed
	 * @param  int  $min_g Minimum green value allowed
	 * @param  int  $max_g Maximum green value allowed
	 * @param  int  $min_b Minimum blue value allowed
	 * @param  int  $max_b Maximum blue value allowed
	 * @return main        The resulting instance of main
	 */
	public function rgb_rand($min_r = 0, $max_r = 255, $min_g = 0, $max_g = 255, $min_b = 0, $max_b = 255) {
		return new main(generate::rgb_rand($min_r, $max_r, $min_g, $max_g, $min_b, $max_b));
	}
	
	/**
	 * Generate a new instance of main with a random HSL color
	 * 
	 * @param  int  $min_h Minimum hue value allowed
	 * @param  int  $max_h Maximum hue value allowed
	 * @param  int  $min_s Minimum saturation value allowed
	 * @param  int  $max_s Maximum saturation value allowed
	 * @param  int  $min_l Minimum light value allowed
	 * @param  int  $max_l Maximum light value allowed
	 * @return main        The resulting instance of main
	 */
	public function hsl_rand($min_h = 0, $max_h = 255, $min_s = 0, $max_s = 255, $min_l = 0, $max_l = 255) {
		return new main(generate::hsl_rand($min_h, $max_h, $min_s, $max_s, $min_l, $max_l));
	}
}
