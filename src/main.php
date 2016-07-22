<?php


namespace projectcleverweb\color;


class main implements \Serializable {
	
	public $color;
	public $hsl_result_accuracy = 0;
	
	public function __construct($color) {
		$this->set($color);
	}
	
	public function __clone() {
		$rgb = $this->color->rgb + ['a' => $this->color->alpha()];
		unset($this->color);
		$this->set($rgb, 'rgb');
	}
	
	public function serialize() :string {
		return $this->color->serialize();
	}
	
	public function unserialize($serialized) {
		$unserialized = (array) json_decode((string) $serialized);
		regulate::rgb_array($unserialized);
		$this->set($unserialized, 'rgb');
	}
	
	protected function set($color, string $type = '') {
		if ($color instanceof color) {
			$this->color = $color;
		} else {
			$this->color = new color($color, $type);
		}
	}
	
	public function rgb() :array {
		return (array) $this->color->rgb + ['a' => $this->color->alpha()];
	}
	
	public function hsl() :array {
		$color = [];
		foreach($this->color->hsl() as $key => $value) {
			$color[$key] = round($value, abs($this->hsl_result_accuracy));
		}
		return $color + ['a' => $this->color->alpha()];
	}
	
	public function cmyk() :array {
		$rgb = $this->color->rgb;
		return generate::rgb_to_cmyk($rgb['r'], $rgb['g'], $rgb['b']) + ['a' => $this->color->alpha()];
	}
	
	public function hex() :string {
		return $this->color->hex;
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
		$rgb = $this->color->rgb;
		return check::is_dark($rgb['r'], $rgb['g'], $rgb['b'], $check_score);
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
	
	public function rgb_scheme(string $scheme_name) :array {
		return static::_scheme($scheme_name, 'rgb', $this->hsl());
	}
	
	public function hsl_scheme(string $scheme_name) :array {
		return static::_scheme($scheme_name, 'hsl', $this->hsl());
	}
	
	public function hex_scheme(string $scheme_name) :array {
		return static::_scheme($scheme_name, 'hex', $this->hsl());
	}
	
	public function cmyk_scheme(string $scheme_name) :array {
		return static::_scheme($scheme_name, 'cmyk', $this->hsl());
	}
	
	protected static function _scheme(string $scheme_name, string $callback, array $hsl) {
		print_r($hsl);
		if (is_callable($callable = [new scheme, $callback])) {
			return call_user_func($callable, $hsl['h'], $hsl['s'], $hsl['l'], $scheme_name);
		}
		error::call(sprintf(
			'The $callback "%s" is not a valid callback',
			$scheme_name,
			__CLASS__,
			__FUNCTION__
		));
		return [];
	}
	
	
}
