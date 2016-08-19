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
	
	public $color;
	
	protected $cache;
	
	public function __construct($color, string $type = '') {
		$this->set($color, $type);
		$this->cache = new cache;
	}
	
	protected function set($color, string $type = '') {
		if (is_a($color, __CLASS__)) {
			$this->color = clone $color->color;
		} else {
			$this->color = new color($color, $type);
		}
	}
	
	public function rgb() :array {
		return (array) $this->color->rgb + ['a' => $this->color->alpha()];
	}
	
	public function hsl(int $accuracy = 0) :array {
		$color = [];
		foreach($this->color->hsl() as $key => $value) {
			$color[$key] = round($value, abs($accuracy));
		}
		return $color + ['a' => $this->color->alpha()];
	}
	
	public function cmyk() :array {
		if (!is_null($cached = $this->cache->get(__FUNCTION__, $this->hex()))) {
			return $cached;
		}
		$rgb    = $this->color->rgb;
		$result = convert::rgb_to_cmyk($rgb['r'], $rgb['g'], $rgb['b']) + ['a' => $this->color->alpha()];
		$this->cache->set(__FUNCTION__, $this->hex(), $result);
		return $result;
	}
	
	public function hsb(int $accuracy = 0) :array {
		if (!is_null($cached = $this->cache->get(__FUNCTION__, $this->hex()))) {
			return $cached;
		}
		$rgb    = $this->color->rgb;
		$result = convert::rgb_to_hsb($rgb['r'], $rgb['g'], $rgb['b'], $accuracy) + ['a' => $this->color->alpha()];
		$this->cache->set(__FUNCTION__, $this->hex(), $result);
		return $result;
	}
	
	public function hex() :string {
		return $this->color->hex;
	}
	
	public function web_safe() :string {
		if (!is_null($cached = $this->cache->get(__FUNCTION__, $this->hex()))) {
			return $cached;
		}
		$rgb    = $this->color->rgb;
		$result = generate::web_safe($rgb['r'], $rgb['g'], $rgb['b']);
		$this->cache->set(__FUNCTION__, $this->hex(), $result);
		return $result;
	}
	
	public function css() :string {
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
	
	public function is_dark(int $check_score = 128) :bool {
		if (!is_null($cached = $this->cache->get(__FUNCTION__, $this->hex()))) {
			return $cached;
		}
		$rgb    = $this->color->rgb;
		$result = check::is_dark($rgb['r'], $rgb['g'], $rgb['b'], $check_score);
		$this->cache->set(__FUNCTION__, $this->hex(), $result);
		return $result;
	}
	
	public function red(float $adjustment, bool $as_percentage = FALSE, bool $set_absolute = TRUE) {
		return modify::rgb($this->color, 'red', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function green(float $adjustment, bool $as_percentage = FALSE, bool $set_absolute = TRUE) {
		return modify::rgb($this->color, 'green', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function blue(float $adjustment, bool $as_percentage = FALSE, bool $set_absolute = TRUE) {
		return modify::rgb($this->color, 'blue', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function hue(float $adjustment, bool $as_percentage = FALSE, bool $set_absolute = TRUE) {
		return modify::hsl($this->color, 'hue', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function saturation(float $adjustment, bool $as_percentage = FALSE, bool $set_absolute = TRUE) {
		return modify::hsl($this->color, 'saturation', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function light(float $adjustment, bool $as_percentage = FALSE, bool $set_absolute = TRUE) {
		return modify::hsl($this->color, 'light', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function blend(main $color2, float $amount = 50.0) {
		$c1 = $this->rgb();
		$c2 = $color2->rgb();
		return new $this(generate::blend(
			$c1['r'], $c1['g'], $c1['b'], $c1['a'],
			$c2['r'], $c2['g'], $c2['b'], $c2['a'],
			$amount
		));
	}
	
	public function gradient(main $color2, int $steps = 0) {
		$c1 = $this->rgb();
		$c2 = $color2->rgb();
		return generate::gradient_range(
			$c1['r'], $c1['g'], $c1['b'],
			$c2['r'], $c2['g'], $c2['b'],
			$steps
		);
	}
	
	public function scheme(string $scheme_name, string $return_type = 'hex') :array {
		if (!is_null($cached = $this->cache->get(__FUNCTION__.'_'.$scheme_name.'_'.$return_type, $this->hex()))) {
			return $cached;
		}
		$result = static::_scheme($scheme_name, strtolower($return_type), $this->hsl(3));
		$this->cache->set(__FUNCTION__.'_'.$scheme_name.'_'.$return_type, $this->hex(), $result);
		return $result;
	}
	
	public function rgb_rand(int $min_r = 0, int $max_r = 255, int $min_g = 0, int $max_g = 255, int $min_b = 0, int $max_b = 255) :main {
		return new main(generate::rgb_rand($min_r, $max_r, $min_g, $max_g, $min_b, $max_b));
	}
	
	public function hsl_rand(int $min_h = 0, int $max_h = 255, int $min_s = 0, int $max_s = 255, int $min_l = 0, int $max_l = 255) :main {
		return new main(generate::hsl_rand($min_h, $max_h, $min_s, $max_s, $min_l, $max_l));
	}
}
