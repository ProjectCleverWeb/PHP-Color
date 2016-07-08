<?php


namespace projectcleverweb\color;


class main {
	
	public $data;
	
	public function __construct($color) {
		$this->set($color);
	}
	
	public function set($color) {
		if ($color instanceof data) {
			$this->data = $color;
		} else {
			$this->data = new data($color);
		}
	}
	
	public function is_dark(int $check_score = 128) :bool {
		$rgb = $this->data->rgb;
		return check::is_dark($rgb['r'], $rgb['g'], $rgb['b'], $check_score);
	}
	
	public function mod_r(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::rgb($data, 'red', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_g(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::rgb($data, 'green', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_b(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::rgb($data, 'blue', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_h(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::hsl($data, 'hue', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_s(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::hsl($data, 'saturation', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_l(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::hsl($data, 'light', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function get_scheme(string $scheme_name = '') {
		if (is_callable(array(__NAMESPACE__.'\\scheme', $scheme_name))) {
			$hsl = $this->hsl->hsl;
			$scheme = call_user_func_array(array(__NAMESPACE__.'\\scheme', $scheme_name), $hsl['h'], $hsl['s'], $hsl['l']);
			foreach ($scheme as &$val) {
				$val = generate::hsl_to_rgb($val['h'], $val['s'], $val['l']);
			}
			return $scheme;
		}
	}
	
	public function get_hex_scheme(string $scheme_name = '') {
		
	}
}
