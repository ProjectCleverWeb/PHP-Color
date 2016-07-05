<?php


namespace projectcleverweb\color;


class main {
	
	public $data;
	
	public function __construct($hex) {
		if ($hex instanceof data) {
			$this->data = $hex;
		} else {
			$this->data = new data($hex);
		}
	}
	
	public function is_dark(int $check_score = 128) :bool {
		$rgb = $this->data->rgb;
		return check::is_dark($rgb['r'], $rgb['g'], $rgb['b'], $check_score);
	}
	
	public function mod_r(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::red($this->data, $adjustment, $as_percentage, $set_absolute);
		return modify::rgb($data, 'red', $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_g(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::green($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_b(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::blue($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_h(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::hue($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_s(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::saturation($this->data, $adjustment, $as_percentage, $set_absolute);
	}
	
	public function mod_l(float $adjustment, bool $as_percentage = FALSE,  bool $set_absolute = FALSE) {
		return modify::light($this->data, $adjustment, $as_percentage, $set_absolute);
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
